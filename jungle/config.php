<?php
// Konfigurasi database yang lebih lengkap
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'wildlife_indonesia';

try {
    // Buat koneksi
    $conn = new mysqli($host, $username, $password, $database);
    
    // Cek koneksi
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset ke UTF-8
    if (!$conn->set_charset("utf8mb4")) {
        throw new Exception("Error setting charset: " . $conn->error);
    }
    
    // Optional: Set timezone
    $conn->query("SET time_zone = '+07:00'");
    
    // Untuk debugging (hapus di production)
    // echo "Database connected successfully!<br>";
    
} catch (Exception $e) {
    die("Database Error: " . $e->getMessage());
}
?>