<?php
include 'config.php';

// Ambil data konservasi atau habitat
$sql = "SELECT * FROM wildlife_habitats ORDER BY name";
$result = $conn->query($sql);
$habitats = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $habitats[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Konservasi - Wildlife Indonesia</title>
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
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 1s ease-out;
        }

        .header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            background: linear-gradient(45deg, #ffd700, #ff6b35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .conservation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .conservation-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .conservation-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .conservation-card h3 {
            color: #ffd700;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .conservation-card p {
            line-height: 1.6;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .location-tag {
            background: rgba(255, 107, 53, 0.3);
            color: #ffd700;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 10px;
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

        /* Footer */
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

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .conservation-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2.5rem;
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

    <!-- Side Navigation -->
    <nav class="navbar" id="navbar">
        <div class="logo">Ramy</div>
        <ul class="nav-menu">
            <li><a href="index.html">🏠 Beranda</a></li>
            <li><a href="index2.php">🐾 Fauna</a></li>
            <li><a href="index3.html">🌳 Habitat</a></li>
            <li><a href="conservation.php" class="active">🛡️ Konservasi</a></li>
            <li><a href="index4.html">📞 Kontak</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="header">
            <h1>🛡️ Program Konservasi</h1>
            <p>Upaya Pelestarian Satwa Langka Indonesia</p>
        </div>

        <div class="conservation-grid">
            <?php foreach($habitats as $habitat): ?>
            <div class="conservation-card">
                <h3><?php echo htmlspecialchars($habitat['name']); ?></h3>
                <p><?php echo htmlspecialchars($habitat['description']); ?></p>
                <p><strong>Spesies Utama:</strong> <?php echo htmlspecialchars($habitat['species']); ?></p>
                <p><strong>Populasi:</strong> <?php echo htmlspecialchars($habitat['population']); ?></p>
                <p><strong>Luas Area:</strong> <?php echo htmlspecialchars($habitat['area']); ?></p>
                <div class="location-tag"><?php echo ucfirst($habitat['type']); ?></div>
            </div>
            <?php endforeach; ?>
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
    </script>
</body>
</html>