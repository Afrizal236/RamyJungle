<?php
//api php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Include database configuration
include 'config.php';

// Get action parameter
$action = isset($_GET['action']) ? $_GET['action'] : 'get_all';

switch ($action) {
    case 'get_all':
        getAllHabitats($conn);
        break;
    case 'get_by_type':
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        getHabitatsByType($conn, $type);
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

function getAllHabitats($conn) {
    // HAPUS field icon dari query karena sudah tidak ada di database
    $sql = "SELECT name, latitude, longitude, description, species, population, area, type FROM wildlife_habitats ORDER BY name";
    $result = $conn->query($sql);
    
    $habitats = array();
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $habitats[] = array(
                'name' => $row['name'],
                'lat' => floatval($row['latitude']),
                'lng' => floatval($row['longitude']),
                'description' => $row['description'],
                'species' => $row['species'],
                'population' => $row['population'],
                'area' => $row['area'],
                'type' => $row['type']
                // HAPUS icon dari sini - biar JavaScript yang handle
            );
        }
    } else {
        // Data sample tanpa icon
        $habitats = [
            [
                'name' => 'Taman Nasional Gunung Leuser',
                'lat' => 3.5000000,
                'lng' => 97.5000000,
                'description' => 'Habitat orangutan Sumatera, harimau Sumatera, dan gajah Sumatera',
                'species' => 'Orangutan, Harimau, Gajah Sumatera',
                'population' => '14,000 orangutan',
                'area' => '7,927 km²',
                'type' => 'mamalia'
            ],
            [
                'name' => 'Taman Nasional Ujung Kulon',
                'lat' => -6.7500000,
                'lng' => 105.3500000,
                'description' => 'Habitat terakhir badak Jawa dengan populasi sangat kritis',
                'species' => 'Badak Jawa',
                'population' => '60-70 ekor',
                'area' => '1,206 km²',
                'type' => 'mamalia'
            ],
            [
                'name' => 'Taman Nasional Komodo',
                'lat' => -8.5500000,
                'lng' => 119.5000000,
                'description' => 'Habitat asli komodo, kadal terbesar di dunia yang terancam punah',
                'species' => 'Komodo',
                'population' => '3,000 ekor',
                'area' => '1,733 km²',
                'type' => 'reptil'
            ]
        ];
    }
    
    echo json_encode($habitats);
}

function getHabitatsByType($conn, $type) {
    // HAPUS field icon dari query
    $sql = "SELECT name, latitude, longitude, description, species, population, area, type FROM wildlife_habitats WHERE type = ? ORDER BY name";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $habitats = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $habitats[] = array(
                    'name' => $row['name'],
                    'lat' => floatval($row['latitude']),
                    'lng' => floatval($row['longitude']),
                    'description' => $row['description'],
                    'species' => $row['species'],
                    'population' => $row['population'],
                    'area' => $row['area'],
                    'type' => $row['type']
                    // HAPUS icon dari sini
                );
            }
        }
        
        echo json_encode($habitats);
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Database query failed']);
    }
}

$conn->close();
?>