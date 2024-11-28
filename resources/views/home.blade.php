<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pencarian Pahlawan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<body>
      <div class="main-container">
        <!-- Carousel Section -->
        <div id="pahlawan" class="carousel slide mb-8" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="1500">
                    <img id="home-carousel-img" src="{{ asset('images/2.png') }}" alt="Pahlawan" class="carousel-img">
                </div>
            </div>            

            <!-- Navbar -->
            <div class="navbar-container">
                <nav id="home-navbar" class="navbar">
                    <ul class="navbar-menu">
                        <li><a href="{{ url('/') }}" class="navbar-link">Home</a></li>
                        <li><a href="{{ url('/map') }}" class="navbar-link" id="find-food-btn">Cari Pahlawan</a></li>
                        <li><a href="{{ url('/about') }}" class="navbar-link">About</a></li>
                    </ul>
                </nav>
            </div>
            

            <!-- Categories Section -->
            <div class="category-box">
                <div class="category-item">
                    <span class="category-text">Revolusi</span>
                </div>
                <div class="category-item">
                    <span class="category-text">kemerdekaan</span>
                </div>
                <div class="category-item">
                    <span class="category-text">Proklamator</span>
                </div>
                <div class="category-item">
                    <span class="category-text">Nasional</span>
                </div>
            </div>

            <!-- pin Section -->
            <div class="pin-section">
                <h2 class="pin-title">PIN</h2>
                <p class="pin-description">
                    PIN adalah situs web yang dirancang untuk menyediakan informasi terperinci tentang pahlawan Indonesia. Melalui "PIN", pengguna dapat menemukan data tentang para pahlawan yang telah berjuang untuk kemerdekaan dan pembangunan bangsa indonesia. Situs ini menyajikan berbagai informasi seperti abstrak singkat tentang perjalanan hidup dan kontribusi pahlawan, serta identitas diri dari setiap pahlawan. Dengan antarmuka yang sederhana dan informatif, "PIN" hadir untuk menginspirasi generasi muda dan meningkatkan apresiasi terhadap sejarah serta perjuangan para pahlawan Indonesia.
                </p>
            </div>
        </div>
    </div>
</body>
    <style>
        /* Disable Scroll */
        body, html {
            overflow: hidden; /* Menghilangkan scroll */
            height: 100%;
        }

        .main-container {
            height: 100vh; /* Menjaga agar container mengambil seluruh layar */
            position: relative;
            overflow: hidden; /* Menghindari scroll */
        }

        .carousel-inner {
            width: 100%;
            height: 100vh; /* Tinggi penuh layar */
            position: relative;
        }

        .carousel-img {
            width: 100%;
            height: 100vh;
            object-fit: cover; /* Menjaga gambar memenuhi area tanpa terdistorsi */

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
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5); /* Tambahkan bayangan agar navbar lebih pop-up */
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
            padding: 8px 16px; /* Memberikan sedikit padding untuk kotak */
            border-radius: 5px; /* Agar kotak sedikit melengkung */
            transition: all 0.3s ease; /* Efek transisi untuk perubahan */
        }

        .navbar-link:hover {
            background-color: #fff; /* Ubah latar belakang menjadi putih */
            color: #000; /* Ubah warna teks menjadi hitam */
            transform: scale(1.1); /* Efek membesar saat hover */
            box-shadow: 0px 4px 8px rgba(0, 0, 0 , 0.3); /* Tambahkan bayangan untuk kesan tombol */
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

        .category-item {
            display: flex;
            align-items: center;
            transition: transform 0.3s, color 0.3s, box-shadow 0.3s; /* Tambahkan transisi untuk bayangan */
            cursor: pointer;
            padding: 15px 20px; /* Tambahkan padding untuk kategori */
            border-radius: 10px; /* Sudut membulat */
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.901), rgba(0, 0, 0, 0.875)); /* Gradien latar belakang */
            color: white; /* Warna teks */
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.3); /* Bayangan untuk kategori */
        }

        .category-item:hover {
            transform: scale(1.05); /* Efek membesar saat hover */
            box-shadow: 0px 4px 16px rgb(252, 252, 252); /* Tambahkan bayangan saat hover */
            background-color: #ffffff; /* Mengubah background menjadi putih saat hover */
            color: #ffffff; /* Mengubah warna teks menjadi hitam agar kontras dengan background putih */
        }


        .category-text {
            font-weight: 700;
            font-size: 18px; /* Ukuran font lebih besar */
            letter-spacing: 1.2px;
            margin-left: 10px; /* Jarak antara ikon dan teks */
        }

        .pin-section {
            position: absolute;
            top: 45%;
            left: 400px; /* Jarak dari sisi kiri */
            right: 400px;
            transform: translateY(-50%); /* Memusatkan secara vertikal */
            color: rgb(255, 255, 255); /* Warna teks */
            padding: 50px;
            margin-top: 10px;
            /* background-color: rgba(0, 0, 0, 0.246); 
            border-radius: 60px; 
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0);  */
        }

        .pin-title {
            text-align: center;
            font-size: 80px; /* Ukuran font untuk judul */
            font-weight: bold; /* Membuat judul lebih tebal */
            margin-bottom: 45px; /* Jarak antara judul dan deskripsi */
            color: rgb(206, 6, 6); /* or any color that contrasts */
            text-shadow: 2px 2px 4px rgb(255, 255, 255);
        }

        .pin-description {
            text-align: center;
            font-size: 20px; /* Ukuran font untuk deskripsi */
            line-height: 1.5; /* Jarak antar baris */
            text-shadow: 2px 2px 4px rgb(255, 255, 255);
            color: black; /* or any color that contrasts */
            margin-bottom: 60px; /* Jarak antara judul dan deskripsi */


        }

        /* Responsif untuk ukuran layar kecil */
        @media (max-width: 768px) {
            .navbar-menu {
                gap: 20px;
            }

            .category-box {
                gap: 15px;
                padding: 10px 20px;
            }

            .category-item {
                font-size: 16px; /* Ukuran font lebih kecil untuk layar kecil */
            }

            .navbar-link {
                font-size: 16px;
            }

            .pin-section {
                left: 10px; /* Mengurangi jarak dari sisi kiri untuk layar kecil */
                padding: 15px; /* Mengurangi padding untuk layar kecil */
            }

            .pin-title {
                font-size: 20px; /* Ukuran font lebih kecil untuk judul */
            }

            .pin-description {
                font-size: 14px; /* Ukuran font lebih kecil untuk deskripsi */
            }
        }
    </style>
</html>