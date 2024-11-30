<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pencarian Pahlawan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="main-container">
        <!-- Carousel Section -->
        <div id="pahlawan" class="carousel slide mb-8" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="1500">
                    <img id="home-carousel-img" src="{{ asset('images/background.png') }}" alt="Pahlawan" class="carousel-img">
                </div>
            </div>            

            <!-- Navbar -->
            <div class="navbar-container">
                <nav id="home-navbar" class="navbar">
                    <ul class="navbar-menu">
                        <li><a href="{{ url('/') }}" class="navbar-link">Home</a></li>
                        <li><a href="{{ route('hero.search', ['view' => 'map']) }}" class="navbar-link" id="find-hero-map-btn">Cari Pahlawan</a></li>
                        <li><a href="{{ url('/about') }}" class="navbar-link">About</a></li>
                    </ul>
                </nav>
            </div>
            
            <!-- Categories Section -->
            <div class="category-box">
                <div class="category-item" data-category="kemerdekaan">
                    <a href="{{ route('hero.category', ['category' => 'kemerdekaan']) }}" class="category-link">
                        <span class="category-text">Kemerdekaan</span>
                    </a>
                </div>
                <div class="category-item" data-category="revolusi">
                    <a href="{{ route('hero.category', ['category' => 'revolusi']) }}" class="category-link">
                        <span class="category-text">Revolusi</span>
                    </a>
                </div>
                <div class="category-item" data-category="nasional">
                    <a href="{{ route('hero.category', ['category' => 'nasional']) }}" class="category-link">
                        <span class="category-text">Nasional</span>
                    </a>
                </div>
                <div class="category-item" data-category="sumpahpemuda">
                    <a href="{{ route('hero.category', ['category' => 'sumpahpemuda']) }}" class="category-link">
                        <span class="category-text">Sumpah Pemuda</span>
                    </a>
                </div>
            </div>
            

            <!-- pin Section -->
            <div class="pin-section">
                <h2 class="pin-title">PIN</h2>
                <p id="pin-description" class="pin-description">
                    PIN adalah situs web yang dirancang untuk menyediakan informasi terperinci tentang pahlawan Indonesia. Melalui "PIN", pengguna dapat menemukan data tentang para pahlawan yang telah berjuang untuk kemerdekaan dan pembangunan bangsa indonesia.
                </p>
                <div id="animation-line" class="animation-line"></div>
            </div>
        </div>
    </div>

    <script>
        // Menambahkan event listener untuk hover kategori
        document.querySelectorAll('.category-item').forEach(item => {
            item.addEventListener('mouseover', function () {
                const category = item.getAttribute('data-category');
                const description = {
  'revolusi': 'Revolusi Indonesia adalah perjuangan besar yang dilakukan oleh bangsa Indonesia untuk mengusir penjajahan, terutama dari Belanda dan Jepang. Pahlawan seperti Soekarno, Hatta, dan Pattimura berperan penting dalam menggerakkan semangat perlawanan demi kemerdekaan.',
  'kemerdekaan': 'Kemerdekaan Indonesia dicapai setelah perjuangan panjang melawan penjajahan selama ratusan tahun. Proklamasi kemerdekaan pada 17 Agustus 1945, yang dipimpin oleh Soekarno dan Mohammad Hatta, adalah tonggak sejarah penting bagi bangsa Indonesia.',
  'nasional': 'Pahlawan nasional adalah tokoh-tokoh yang diakui karena peran besar mereka dalam perjuangan kemerdekaan Indonesia. Mereka dihormati atas pengorbanan jiwa dan raganya demi kebebasan bangsa, seperti Tirto Adhi Soerjo, Sartono, dan Dewi Sartika.',
  'sumpahpemuda': 'Sumpah Pemuda adalah ikrar yang diucapkan pada 28 Oktober 1928 oleh pemuda Indonesia yang menegaskan tekad untuk bersatu dalam perjuangan untuk kemerdekaan. Hal ini menginspirasi perjuangan kemerdekaan dan mempererat persatuan bangsa Indonesia.'
}


                // Mengubah deskripsi teks
                document.getElementById('pin-description').innerText = description[category];
                
                // Animasi garis
                document.getElementById('animation-line').style.width = '100%'; // Garis animasi muncul
            });

            item.addEventListener('mouseout', function () {
                // Kembali ke deskripsi awal
                document.getElementById('pin-description').innerText = 'PIN adalah situs web yang dirancang untuk menyediakan informasi terperinci tentang pahlawan Indonesia. Melalui "PIN", pengguna dapat menemukan data tentang para pahlawan yang telah berjuang untuk kemerdekaan dan pembangunan bangsa indonesia.';
                
                // Menyembunyikan garis animasi
                document.getElementById('animation-line').style.width = '0';
            });
        });
    </script>

    <style>
        /* Disable Scroll */
        body, html {
            overflow: hidden;
            height: 100%;

        }

        .main-container {
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .carousel-inner {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .carousel-img {
            width: 100%;
            height: 100vh;
            object-fit: cover;

        }

        .navbar-container {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
        }

        .navbar {
            background: linear-gradient(90deg, rgba(255, 0, 0, 0.8), rgba(255, 255, 255, 0.8), rgba(255, 0, 0, 0.8));
            background-size: 300% 300%; 
            animation: movingGradient 6s infinite ease-in-out;
            border-radius: 20px;
            padding: 15px 30px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);
        }

        .navbar-menu {
            list-style: none;
            display: flex;
            gap: 40px;
            margin: 0;
            padding: 0;
            justify-content: center;
        }

        .navbar-link {
            text-decoration: none;
            color: #000000;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .navbar-link:hover {
            background-color: #fff;
            color: #000;
            transform: scale(1.1);
            box-shadow: 0px 4px 8px rgba(0, 0, 0 , 0.3);
        }

        @keyframes movingGradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .category-box {
            display: flex;
            justify-content: center;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: 60px;
            padding: 20px 40px;
            gap: 20px;
            background: linear-gradient(90deg, rgba(255, 0, 0, 0.8), rgba(255, 255, 255, 0.8), rgba(255, 0, 0, 0.8));
            background-size: 300% 300%; 
            animation: movingGradient 6s infinite ease-in-out; 
        }

        /* Membuat link kategori mencakup seluruh box */
.category-link {
    display: block; /* Membuat link mencakup seluruh elemen kategori */
    width: 100%;    /* Pastikan lebar link sama dengan elemen kategori */
    height: 100%;   /* Pastikan tinggi link sama dengan elemen kategori */
    text-decoration: none; /* Menghapus garis bawah pada link */
    color: inherit; /* Pewarnaan teks mengikuti elemen induk */
}

/* Penyesuaian untuk memastikan kotak kategori mencakup seluruh area */
.category-item {
    display: flex;
    align-items: center;
    justify-content: center; /* Memastikan teks berada di tengah box */
    transition: transform 0.3s, color 0.3s, box-shadow 0.3s;
    cursor: pointer;
    padding: 15px 20px;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.901), rgba(0, 0, 0, 0.875));
    color: white;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.3);
    width: auto;
    height: 100%; /* Pastikan kategori memiliki tinggi */
}

/* Hover efek yang sudah ada */
.category-item:hover {
    transform: scale(1.05);
    box-shadow: 0px 4px 16px rgb(252, 252, 252);
    background-color: #ffffff;
    color: #ffffff;
}

.category-text {
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 1.2px;
    margin-left: 10px;
}


        .pin-section {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            color: rgb(255, 255, 255);
            padding: 50px;
        }

        .pin-title {
            text-align: center;
            font-size: 80px;
            font-weight: bold;
            margin-bottom: 45px;
            color: rgb(206, 6, 6);
            text-shadow: 2px 2px 4px rgb(199, 199, 199);
            
        }

        .pin-description {
            text-align: center;
            font-size: 20px;
            line-height: 1.5;
            text-shadow: 2px 2px 4px rgb(255, 255, 255);
            color: black;
            margin-bottom: 60px;
            font-weight: 600;

        }

        .animation-line {
            height: 2px;
            width: 0;
            background-color: #ff0000;
            transition: width 0.5s ease-in-out;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.8); /* Glow effect */

        }

        @media (max-width: 768px) {
            .category-box {
                gap: 15px;
                padding: 10px 20px;
            }

            .category-item {
                font-size: 16px;
            }

            .pin-section {
                padding: 15px;
            }

            .pin-title {
                font-size: 20px;
            }

            .pin-description {
                font-size: 14px;
            }
        }
    </style>
</body>
</html>
