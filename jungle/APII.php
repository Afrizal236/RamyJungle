<?php
// API untuk mengambil data kewan
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Include database configuration dan functions
include 'config.php';
include 'get-animal.php';

// Get action parameter
$action = isset($_GET['action']) ? $_GET['action'] : 'get_all';

switch ($action) {
    case 'get_all':
        // Ambil semua data kewan
        $animals = getAllAnimals();
        echo json_encode([
            'success' => true,
            'data' => $animals,
            'total' => count($animals)
        ]);
        break;
        
    case 'get_by_id':
        // Ambil data berdasarkan ID
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $animal = getAnimalById($id);
        
        if ($animal) {
            echo json_encode([
                'success' => true,
                'data' => $animal
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Animal not found'
            ]);
        }
        break;
        
    case 'get_by_name':
        // Ambil data berdasarkan nama
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $animals = getAnimalByName($name);
        
        echo json_encode([
            'success' => true,
            'data' => $animals,
            'total' => count($animals)
        ]);
        break;
        
    case 'get_by_status':
        // Ambil data berdasarkan status konservasi
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $animals = getAnimalsByStatus($status);
        
        echo json_encode([
            'success' => true,
            'data' => $animals,
            'total' => count($animals)
        ]);
        break;
        
    case 'get_paginated':
        // Ambil data dengan pagination
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $offset = ($page - 1) * $limit;
        
        $animals = getAnimalsWithPagination($offset, $limit);
        $total = getTotalAnimals();
        
        echo json_encode([
            'success' => true,
            'data' => $animals,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $limit,
                'total' => $total,
                'total_pages' => ceil($total / $limit)
            ]
        ]);
        break;
        
    case 'get_statistics':
        // Ambil statistik data kewan
        $sql = "SELECT 
                COUNT(*) as total_animals,
                COUNT(DISTINCT status) as total_status_types,
                GROUP_CONCAT(DISTINCT status) as status_list
                FROM kewan";
        
        $result = $conn->query($sql);
        $stats = $result->fetch_assoc();
        
        // Hitung jumlah per status
        $sql_by_status = "SELECT status, COUNT(*) as count FROM kewan GROUP BY status";
        $result_status = $conn->query($sql_by_status);
        
        $status_counts = [];
        while($row = $result_status->fetch_assoc()) {
            $status_counts[] = $row;
        }
        
        echo json_encode([
            'success' => true,
            'statistics' => [
                'total_animals' => intval($stats['total_animals']),
                'total_status_types' => intval($stats['total_status_types']),
                'status_list' => explode(',', $stats['status_list']),
                'animals_by_status' => $status_counts
            ]
        ]);
        break;
        
    default:
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action'
        ]);
        break;
}

$conn->close();
?>