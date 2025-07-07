<?php
// Include koneksi database
include 'config.php';

// Function untuk mengambil semua data hewan dari tabel kewan
function getAllAnimals() {
    global $conn;
    
    $sql = "SELECT * FROM kewan ORDER BY id ASC";
    $result = $conn->query($sql);
    
    $animals = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $animals[] = $row;
        }
    }
    
    return $animals;
}

// Function untuk mengambil data hewan berdasarkan ID dari tabel kewan
function getAnimalById($id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM kewan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}

// Function untuk mengambil data hewan berdasarkan nama dari tabel kewan
function getAnimalByName($name) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM kewan WHERE name LIKE ?");
    $searchName = "%" . $name . "%";
    $stmt->bind_param("s", $searchName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $animals = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $animals[] = $row;
        }
    }
    
    return $animals;
}

// Function untuk mengambil data hewan berdasarkan status konservasi
function getAnimalsByStatus($status) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM kewan WHERE status = ?");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $animals = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $animals[] = $row;
        }
    }
    
    return $animals;
}

// Function untuk menghitung total hewan dalam database
function getTotalAnimals() {
    global $conn;
    
    $sql = "SELECT COUNT(*) as total FROM kewan";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    return 0;
}

// Function untuk mengambil data hewan dengan pagination
function getAnimalsWithPagination($offset = 0, $limit = 10) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM kewan ORDER BY id ASC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $animals = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $animals[] = $row;
        }
    }
    
    return $animals;
}
?>