<?php
// File untuk mengecek data yang sudah dimasukkan
include 'config.php';

echo "<h2>Data Hewan dalam Database</h2>";
echo "<hr>";

// Query untuk mengambil semua data
$sql = "SELECT * FROM kewan ORDER BY id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<p><strong>Total data: " . $result->num_rows . " hewan</strong></p>";
    echo "<br>";
    
    while($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px;'>";
        echo "<h3>" . $row['id'] . ". " . htmlspecialchars($row['name']) . "</h3>";
        echo "<p><em>" . htmlspecialchars($row['latin_name']) . "</em></p>";
        echo "<p><strong>Lokasi:</strong> " . htmlspecialchars($row['location']) . "</p>";
        echo "<p><strong>Status:</strong> " . htmlspecialchars($row['status']) . "</p>";
        echo "<p><strong>Populasi:</strong> " . htmlspecialchars($row['population']) . "</p>";
        echo "<p><strong>Deskripsi:</strong> " . substr(htmlspecialchars($row['description']), 0, 200) . "...</p>";
        echo "<p><strong>Quote:</strong> <em>\"" . htmlspecialchars($row['quote']) . "\"</em></p>";
        echo "<p><strong>Gambar:</strong> <a href='" . htmlspecialchars($row['image_url']) . "' target='_blank'>Lihat Gambar</a></p>";
        echo "<p><strong>Dibuat:</strong> " . $row['created_at'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p style='color: red;'>Tidak ada data dalam tabel kewan.</p>";
    echo "<p>Silakan jalankan create_table.php terlebih dahulu.</p>";
}

$conn->close();
?>