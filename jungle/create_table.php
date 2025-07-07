<?php
// Include koneksi database
include 'config.php'; // Menggunakan config.php yang sudah ada

// Data hewan dari website index2.html
$animals = [
    [
        'name' => 'Harimau Sumatera',
        'latin_name' => 'Panthera tigris sumatrae',
        'description' => 'Harimau Sumatera adalah subspesies harimau yang hanya ditemukan di pulau Sumatera, Indonesia. Mereka adalah kucing besar yang paling kecil di antara semua subspesies harimau yang masih hidup, namun tetap menjadi predator puncak di habitatnya. Dengan bulu oranye kemerahan yang khas dan loreng hitam yang unik, setiap individu memiliki pola yang berbeda seperti sidik jari manusia. Mereka memiliki kemampuan berenang yang luar biasa dan sering berburu di perairan. Sayangnya, populasi mereka terancam punah dengan hanya tersisa sekitar 400-500 individu di alam liar. Hilangnya habitat dan perburuan ilegal menjadi ancaman utama kelangsungan hidup mereka.',
        'quote' => 'Kekuatan sejati bukan tentang seberapa keras kita bisa mengaum, tetapi seberapa tenang kita bisa berjalan di hutan rimba kehidupan.',
        'location' => 'Sumatera',
        'population' => '400-500 individu',
        'status' => 'Terancam Punah',
        'image_url' => 'https://github.com/Afrizal236/kewan/blob/main/ferocious-tiger-nature.jpg?raw=true'
    ],
    [
        'name' => 'Orangutan',
        'latin_name' => 'Pongo pygmaeus & Pongo abelii',
        'description' => 'Orangutan adalah kera besar yang hanya ditemukan di hutan hujan tropis Borneo dan Sumatera. Mereka adalah salah satu kerabat terdekat manusia dengan DNA yang 97% sama. Orangutan dikenal karena kecerdasan luar biasa dan kemampuan menggunakan alat untuk mencari makanan. Sebagai "manusia hutan" (dari bahasa Melayu "orang hutan"), mereka menghabiskan sebagian besar waktu di atas pohon membangun sarang untuk tidur. Mereka memiliki lengan yang sangat panjang hingga 2,3 meter dari ujung ke ujung, memungkinkan mereka berayun dengan lincah di antara cabang-cabang pohon. Populasi orangutan terus menurun drastis akibat deforestasi untuk perkebunan kelapa sawit dan pemukiman. Saat ini hanya tersisa sekitar 104.000 orangutan Borneo dan 14.000 orangutan Sumatera di alam liar.',
        'quote' => 'Kebijaksanaan sejati terletak pada kemampuan untuk belajar dari alam, menggunakan alat dengan hati-hati, dan menjaga keseimbangan antara kebutuhan dan kelestarian.',
        'location' => 'Borneo dan Sumatera',
        'population' => '104.000 Borneo, 14.000 Sumatera',
        'status' => 'Terancam Punah',
        'image_url' => 'https://github.com/Afrizal236/kewan/blob/main/monkey-lifestyle-natural-view.jpg?raw=true'
    ],
    [
        'name' => 'Anoa',
        'latin_name' => 'Bubalus quarlesi & B. depressicornis',
        'description' => 'Anoa adalah kerbau kerdil endemik Pulau Sulawesi yang merupakan mamalia terbesar di pulau tersebut. Terdapat dua spesies: Anoa Pegunungan (B. quarlesi) dan Anoa Dataran Rendah (B. depressicornis). Mereka adalah kerabat terdekat kerbau air Asia dan memiliki ukuran tubuh yang jauh lebih kecil. Dengan tinggi hanya sekitar 75 cm dan berat 150-300 kg, anoa memiliki tanduk lurus yang runcing dan bulu berwarna coklat gelap hingga hitam. Mereka hidup soliter atau dalam kelompok kecil, aktif pada pagi dan sore hari, serta gemar bermandi lumpur untuk mendinginkan tubuh dan melindungi kulit dari serangga. Status konservasi anoa sangat mengkhawatirkan dengan populasi yang terus menurun. Diperkirakan hanya tersisa 2.500-5.000 individu di alam liar. Ancaman utama mereka adalah hilangnya habitat, perburuan ilegal, dan fragmentasi hutan akibat ekspansi pertanian dan pemukiman.',
        'quote' => 'Kekuatan tidak selalu terletak pada ukuran yang besar, tetapi pada kemampuan bertahan dan beradaptasi dengan lingkungan yang terus berubah.',
        'location' => 'Sulawesi',
        'population' => '2.500-5.000 individu',
        'status' => 'Sangat Terancam',
        'image_url' => 'https://github.com/Afrizal236/kewan/blob/main/istockphoto-481040158-612x612.jpg?raw=true'
    ],
    [
        'name' => 'Badak Jawa',
        'latin_name' => 'Rhinoceros sondaicus',
        'description' => 'Badak Jawa merupakan salah satu mamalia paling langka di dunia dan termasuk dalam daftar spesies kritis terancam punah. Mereka adalah satu-satunya populasi badak bercula satu yang tersisa di Asia, dengan habitat terbatas di Taman Nasional Ujung Kulon, Jawa Barat. Memiliki kulit tebal berwarna abu-abu gelap yang tampak seperti lembaran baja berlapis, badak jawa jantan memiliki cula tunggal sepanjang 20-27 cm. Mereka adalah hewan soliter yang aktif pada malam hari dan suka bermandi lumpur untuk melindungi kulit dari sengatan matahari dan serangga. Dengan populasi hanya sekitar 60-75 individu, badak jawa menghadapi ancaman kepunahan yang sangat serius. Kehilangan habitat, bencana alam, dan penyakit menjadi tantangan utama dalam upaya konservasi spesies yang sangat berharga ini.',
        'quote' => 'Ketangguhan sejati terukir dalam setiap langkah yang hati-hati, mempertahankan keberadaan di tengah dunia yang terus berubah.',
        'location' => 'Jawa Barat (Ujung Kulon)',
        'population' => '60-75 individu',
        'status' => 'Kritis Terancam Punah',
        'image_url' => 'https://github.com/Afrizal236/kewan/blob/main/cl4cz6rdy1.jpg?raw=true'
    ],
    [
        'name' => 'Cendrawasih',
        'latin_name' => 'Paradisaeidae',
        'description' => 'Cendrawasih atau burung surga adalah keluarga burung yang terkenal dengan keindahan bulu dan tarian kawinnya yang spektakuler. Terdapat 42 spesies cendrawasih di dunia, dengan sebagian besar hidup di Papua dan Papua Nugini. Mereka menjadi simbol keindahan dan kemegahan alam Papua. Burung jantan memiliki bulu berwarna-warni yang menawan dengan kombinasi kuning emas, merah menyala, hijau zamrud, dan biru metalik. Bulu-bulu hiasan yang panjang dan unik digunakan dalam ritual tarian kawin yang rumit untuk menarik perhatian betina. Setiap spesies memiliki gaya tarian dan pola bulu yang berbeda. Populasi cendrawasih mengalami tekanan akibat hilangnya habitat hutan dan perburuan untuk diambil bulunya. Beberapa spesies seperti Cendrawasih Raja dan Cendrawasih Botak sudah masuk dalam kategori rentan dan terancam punah.',
        'quote' => 'Keindahan sejati bukan hanya terletak pada penampilan, tetapi pada kemampuan untuk menciptakan harmoni dan kegembiraan di setiap gerakan kehidupan.',
        'location' => 'Papua dan Papua Nugini',
        'population' => 'Bervariasi per spesies',
        'status' => 'Rentan-Terancam',
        'image_url' => 'https://github.com/Afrizal236/kewan/blob/main/beatiful-bird-paradise-branch-cendrawasih-bird.jpg?raw=true'
    ],
    [
        'name' => 'Elang Jawa',
        'latin_name' => 'Nisaetus bartelsi',
        'description' => 'Elang Jawa adalah burung endemik Pulau Jawa dan merupakan maskot fauna nasional Indonesia. Sebagai raptor yang gagah dan perkasa, elang jawa memiliki tempat istimewa dalam budaya Indonesia dan menjadi simbol kekuatan serta kebebasan bangsa. Dengan panjang tubuh mencapai 60 cm dan rentang sayap hingga 120 cm, elang jawa memiliki bulu berwarna coklat gelap dengan pola bergaris pada bagian dada dan perut. Jambul di kepalanya yang khas menjadi ciri pembeda dari spesies elang lainnya. Mereka adalah pemburu ulung yang memangsa mamalia kecil, burung, dan reptil. Populasi elang jawa sangat terbatas dengan hanya sekitar 500-800 pasang yang tersisa di alam liar. Fragmentasi habitat akibat deforestasi dan perluasan pemukiman menjadi ancaman utama. Upaya konservasi terus dilakukan untuk melindungi spesies ikonik ini dari kepunahan.',
        'quote' => 'Kepemimpinan sejati seperti elang yang terbang tinggi: memiliki visi yang tajam, keberanian untuk menghadapi badai, dan kekuatan untuk melindungi yang dicintai.',
        'location' => 'Jawa',
        'population' => '500-800 pasang',
        'status' => 'Terancam Punah',
        'image_url' => 'https://github.com/Afrizal236/kewan/blob/main/elang-jawa-03_foto_BI_-Fahrul-Amama__EDIT-2.jpg?raw=true'
    ],
    [
        'name' => 'Penyu Belimbing',
        'latin_name' => 'Dermochelys coriacea',
        'description' => 'Penyu Belimbing adalah spesies penyu terbesar di dunia dan satu-satunya penyu yang tidak memiliki tempurung keras. Mereka memiliki karapas yang fleksibel seperti kulit dengan tujuh tonjolan memanjang yang menyerupai belimbing, sehingga mendapat nama penyu belimbing. Dengan panjang yang dapat mencapai 2 meter dan berat hingga 700 kg, penyu belimbing adalah perenang jarak jauh yang luar biasa. Mereka dapat menyelam hingga kedalaman 1.200 meter dan melakukan migrasi ribuan kilometer melintasi samudra. Makanan utama mereka adalah ubur-ubur, yang membantu menjaga keseimbangan ekosistem laut. Status konservasi penyu belimbing sangat mengkhawatirkan dengan populasi yang terus menurun drastis. Ancaman utama meliputi polusi plastik laut, perubahan iklim yang mempengaruhi pantai bertelur, dan penangkapan tidak sengaja dalam jaring nelayan. Indonesia memiliki beberapa pantai peneluran penting di Papua dan Jawa Barat.',
        'quote' => 'Seperti samudra yang luas, hidup membutuhkan kedalaman dan ketahanan untuk menjelajahi jarak yang tak terbatas menuju tujuan yang bermakna.',
        'location' => 'Perairan Indonesia (Papua, Jawa Barat)',
        'population' => 'Sangat menurun',
        'status' => 'Kritis Terancam Punah',
        'image_url' => 'https://github.com/Afrizal236/kewan/blob/main/penyu-belimbing-muncul-di-kalimantan-barat-dok-kkp_169.jpeg?raw=true'
    ]
];

// Prepare statement untuk insert data dengan image_url ke tabel kewan
$stmt = $conn->prepare("INSERT INTO kewan (name, latin_name, description, quote, location, population, status, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Insert setiap data hewan
foreach ($animals as $animal) {
    $stmt->bind_param("ssssssss", 
        $animal['name'], 
        $animal['latin_name'], 
        $animal['description'], 
        $animal['quote'], 
        $animal['location'], 
        $animal['population'], 
        $animal['status'],
        $animal['image_url']
    );
    
    if ($stmt->execute()) {
        echo "Data " . $animal['name'] . " berhasil dimasukkan ke tabel kewan<br>";
    } else {
        echo "Error inserting " . $animal['name'] . ": " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();

echo "<br>Proses insert data ke tabel kewan selesai!";
?>