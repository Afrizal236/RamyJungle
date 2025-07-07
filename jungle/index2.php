<?php
// Include functions untuk mengambil data dari database
include 'get-animal.php';

// Ambil semua data hewan dari database
$animals = getAllAnimals();

// Mapping untuk gambar (sesuai urutan data di database)
$animalImages = [
    'Harimau Sumatera' => 'https://github.com/Afrizal236/kewan/blob/main/ferocious-tiger-nature.jpg?raw=true',
    'Orangutan' => 'https://github.com/Afrizal236/kewan/blob/main/monkey-lifestyle-natural-view.jpg?raw=true',
    'Anoa' => 'https://github.com/Afrizal236/kewan/blob/main/istockphoto-481040158-612x612.jpg?raw=true',
    'Badak Jawa' => 'https://github.com/Afrizal236/kewan/blob/main/cl4cz6rdy1.jpg?raw=true',
    'Cendrawasih' => 'https://github.com/Afrizal236/kewan/blob/main/beatiful-bird-paradise-branch-cendrawasih-bird.jpg?raw=true',
    'Elang Jawa' => 'https://github.com/Afrizal236/kewan/blob/main/elang-jawa-03_foto_BI_-Fahrul-Amama__EDIT-2.jpg?raw=true',
    'Penyu Belimbing' => 'https://github.com/Afrizal236/kewan/blob/main/penyu-belimbing-muncul-di-kalimantan-barat-dok-kkp_169.jpeg?raw=true'
];

// Mapping untuk class CSS berdasarkan nama hewan
$animalClasses = [
    'Harimau Sumatera' => '',
    'Orangutan' => 'orangutan',
    'Anoa' => 'anoa',
    'Badak Jawa' => 'rhino',
    'Cendrawasih' => 'cendrawasih',
    'Elang Jawa' => 'eagle',
    'Penyu Belimbing' => 'turtle'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Binatang - Wildlife Indonesia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a4c3a, #2d6b57);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            gap: 40px;
            margin-bottom: 80px;
        }

        .animal-card {
            background: #00332C;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            max-width: 900px;
            width: 100%;
            display: flex;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 0 auto;
        }

        .animal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }

        .animal-card.reverse {
            flex-direction: row-reverse;
        }

        .card-image {
            flex: 1;
            position: relative;
            min-height: 400px;
        }

        .animal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            flex: 1;
            padding: 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .title-badge {
            background: #7ED321;
            color: #00332C;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 20px;
            width: fit-content;
        }

        .title-badge.orangutan {
            background: #FF8C42;
            color: white;
        }

        .title-badge.anoa {
            background: #8B4513;
            color: white;
        }

        .title-badge.rhino {
            background: #696969;
            color: white;
        }

        .title-badge.cendrawasih {
            background: linear-gradient(45deg, #FFD700, #FF6B35);
            color: white;
        }

        .title-badge.eagle {
            background: #8B4513;
            color: white;
        }

        .title-badge.turtle {
            background: #20B2AA;
            color: white;
        }

        .card-description {
            flex-grow: 1;
            margin-bottom: 30px;
        }

        .card-description h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #7ED321;
        }

        .card-description h2.orangutan {
            color: #FF8C42;
        }

        .card-description h2.anoa {
            color: #D2691E;
        }

        .card-description h2.rhino {
            color: #A9A9A9;
        }

        .card-description h2.cendrawasih {
            color: #FFD700;
        }

        .card-description h2.eagle {
            color: #CD853F;
        }

        .card-description h2.turtle {
            color: #20B2AA;
        }

        .latin-name {
            font-style: italic;
            font-size: 1.1rem;
            color: #ccc;
            margin-bottom: 15px;
        }

        .card-description p {
            line-height: 1.6;
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 15px;
            text-align: justify;
        }

        .quote-section {
            background: rgba(126, 211, 33, 0.1);
            padding: 20px;
            border-radius: 15px;
            border-left: 4px solid #7ED321;
            position: relative;
        }

        .quote-section.orangutan {
            background: rgba(255, 140, 66, 0.1);
            border-left: 4px solid #FF8C42;
        }

        .quote-section.anoa {
            background: rgba(139, 69, 19, 0.1);
            border-left: 4px solid #8B4513;
        }

        .quote-section.rhino {
            background: rgba(105, 105, 105, 0.1);
            border-left: 4px solid #696969;
        }

        .quote-section.cendrawasih {
            background: rgba(255, 215, 0, 0.1);
            border-left: 4px solid #FFD700;
        }

        .quote-section.eagle {
            background: rgba(139, 69, 19, 0.1);
            border-left: 4px solid #8B4513;
        }

        .quote-section.turtle {
            background: rgba(32, 178, 170, 0.1);
            border-left: 4px solid #20B2AA;
        }

        .quote-section::before {
            content: '"';
            font-size: 4rem;
            color: #7ED321;
            position: absolute;
            top: -10px;
            left: 15px;
            font-family: serif;
        }

        .quote-section.orangutan::before {
            color: #FF8C42;
        }

        .quote-section.anoa::before {
            color: #8B4513;
        }

        .quote-section.rhino::before {
            color: #696969;
        }

        .quote-section.cendrawasih::before {
            color: #FFD700;
        }

        .quote-section.eagle::before {
            color: #8B4513;
        }

        .quote-section.turtle::before {
            color: #20B2AA;
        }

        .quote-text {
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.5;
            margin-left: 30px;
        }

        .animal-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .info-item {
            text-align: center;
        }

        .info-label {
            font-weight: bold;
            color: #7ED321;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Footer Styles - Copied from index4.html */
        .footer {
            background: #0d2818;
            color: #ffffff;
            text-align: center;
            padding: 2rem 0;
            margin-top: 0;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            width: 100vw;
            border-top: 3px solid #2a6b62;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-divider {
            width: 80px;
            height: 2px;
            background: #4dd0e1;
            margin: 0 auto 1rem auto;
            border-radius: 1px;
        }

        .footer p {
            font-size: 0.9rem;
            color: #a0c4c7;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .footer .copyright {
            font-size: 1rem;
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.5rem;
        }

        .footer .heart {
            color: #ff6b6b;
            font-size: 1.1rem;
            margin: 0 0.3rem;
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @media (max-width: 768px) {
            .animal-card, .animal-card.reverse {
                flex-direction: column;
            }
            
            .card-image {
                min-height: 250px;
            }
            
            .card-content {
                padding: 30px 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }

            .footer {
                padding: 1.5rem 0;
            }

            .footer-content {
                padding: 0 1rem;
            }

            .footer p {
                font-size: 0.8rem;
            }

            .footer .copyright {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .footer p {
                font-size: 0.75rem;
            }

            .footer .copyright {
                font-size: 0.85rem;
            }
        }

        /* Hamburger Button */
        .hamburger {
            position: fixed;
            top: 30px;
            left: 30px;
            z-index: 1001;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 4px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .hamburger:hover {
            transform: scale(1.05);
        }

        .hamburger span {
            width: 20px;
            height: 2px;
            background: #2d5a3d;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Side Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 280px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            transition: left 0.3s ease;
            padding: 100px 0 50px 0;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
        }

        .navbar.open {
            left: 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2d5a3d;
            text-align: center;
            margin-bottom: 3rem;
            padding: 0 2rem;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 0 2rem;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #2d5a3d;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-radius: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.1rem;
        }

        .nav-menu a:hover {
            background: rgba(45, 90, 61, 0.1);
            transform: translateX(5px);
        }

        .nav-menu a.active {
            background: linear-gradient(45deg, #4a9d6f, #6bb585);
            color: white;
            box-shadow: 0 4px 15px rgba(74, 157, 111, 0.3);
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .overlay.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body>
    <!-- Hamburger Button -->
    <button class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <nav class="navbar" id="navbar">
        <div class="logo">Ramy</div>
        <ul class="nav-menu">
            <li><a href="index.html">🏠 Beranda</a></li>
            <li><a href="index2.php" class="active">🐾 Fauna</a></li>
            <li><a href="index3.html">🌳 Habitat</a></li>
            <li><a href="conservation.php">🛡️ Konservasi</a></li>
            <li><a href="index4.html">📞 Kontak</a></li> <!-- Diubah dari contact.php ke index4.html -->
        </ul>
    </nav>

    <div class="container">
        <div class="header">
            <h1>🐾 Fauna Langka Indonesia 🐾</h1>
            <p>Mengenal Keragaman Satwa Langka Nusantara</p>
        </div>

        <div class="card-container">
            <?php 
            $cardIndex = 0;
            foreach ($animals as $animal): 
                $animalClass = $animalClasses[$animal['name']] ?? '';
                // Gunakan image_url dari database jika ada, jika tidak gunakan dari mapping
                $imageSrc = !empty($animal['image_url']) ? $animal['image_url'] : ($animalImages[$animal['name']] ?? 'https://via.placeholder.com/400x300?text=Gambar+Tidak+Tersedia');
                $isReverse = $cardIndex % 2 === 1;
            ?>
            <div class="animal-card <?php echo $isReverse ? 'reverse' : ''; ?>">
                <div class="card-image">
                    <img src="<?php echo htmlspecialchars($imageSrc); ?>" 
                         alt="<?php echo htmlspecialchars($animal['name']); ?>" 
                         class="animal-image"
                         onerror="this.src='https://via.placeholder.com/400x300?text=Gambar+Tidak+Tersedia'">
                </div>
                
                <div class="card-content">
                    <div class="title-badge <?php echo $animalClass; ?>">
                        <?php echo htmlspecialchars($animal['category'] ?? 'Fauna Langka'); ?>
                    </div>
                    
                    <div class="card-description">
                        <h2 class="<?php echo $animalClass; ?>">
                            <?php echo htmlspecialchars($animal['name']); ?>
                        </h2>
                        <?php if (!empty($animal['latin_name'])): ?>
                        <div class="latin-name"><?php echo htmlspecialchars($animal['latin_name']); ?></div>
                        <?php endif; ?>
                        <p><?php echo nl2br(htmlspecialchars($animal['description'])); ?></p>
                        
                        <div class="animal-info">
                            <?php if (!empty($animal['location'])): ?>
                            <div class="info-item">
                                <div class="info-label">Lokasi</div>
                                <div class="info-value"><?php echo htmlspecialchars($animal['location']); ?></div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($animal['status'])): ?>
                            <div class="info-item">
                                <div class="info-label">Status</div>
                                <div class="info-value"><?php echo htmlspecialchars($animal['status']); ?></div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($animal['population'])): ?>
                            <div class="info-item">
                                <div class="info-label">Populasi</div>
                                <div class="info-value"><?php echo htmlspecialchars($animal['population']); ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if (!empty($animal['quote'])): ?>
                    <div class="quote-section <?php echo $animalClass; ?>">
                        <div class="quote-text">
                            <?php echo htmlspecialchars($animal['quote']); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php 
            $cardIndex++;
            endforeach; 
            ?>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-divider"></div>
            <p>Dibuat dengan <span class="heart">❤️</span> untuk pelestarian satwa langka Indonesia</p>
            <p class="copyright">© 2025 RamyFurry. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Hamburger Menu Functionality
        const hamburger = document.getElementById('hamburger');
        const navbar = document.getElementById('navbar');
        const overlay = document.getElementById('overlay');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navbar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navbar.classList.remove('open');
            overlay.classList.remove('show');
        });

        // Close menu when clicking nav links
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navbar.classList.remove('open');
                overlay.classList.remove('show');
            });
        });

        // Smooth scrolling untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animal-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>