<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Pahlawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="main-container">
        <div id="foodCarousel" class="carousel slide mb-8" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="1500">
                    <img id="home-carousel-img" src="{{ asset('images/pahlawan.jpg') }}" alt="Indonesian Hero" class="carousel-img">        
                </div>
            </div>

            <!-- Navbar -->
            <div class="navbar-container">
                <nav id="home-navbar" class="navbar">
                    <ul class="navbar-menu">
                        <li><a href="{{ url('/') }}" class="navbar-link">Home</a></li>
                        <li><a href="{{ url('/map') }}" class="navbar-link" id="find-food-btn">Find a hero</a></li>
                        <li><a href="{{ url('/about') }}" class="navbar-link">About</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Dropdown Section -->
            <div class="dropdown-box">
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#pahlawan-nasional">Pahlawan Nasional</a></li>
                                <li><a class="dropdown-item" href="#pahlawan-revolusi">Pahlawan Revolusi</a></li>
                                <li><a class="dropdown-item" href="#tokoh-pemuda-pancasila">Tokoh Sumpah Pemuda</a></li>
                            </ul>
                        </li>
                    </ul>
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
            background-color: rgba(0, 0, 0, 0.95);
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
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .navbar-link:hover {
            background-color: #000000;
            color: #ffffff;
            transform: scale(1.1);
            box-shadow: 0px 4px 8px rgba(255, 255, 255, 0.8);
        }

        /* Dropdown */
        .dropdown-box {
            position: absolute;
            bottom: 25%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: transparent;
            padding: 10px;
        }

        .dropdown-menu {
            background: rgba(0, 0, 0, 0.9);
            border-radius: 10px;
            padding: 10px 0;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
        }

        .dropdown-item {
            color: white;
            font-size: 20px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #f9ab04;
            border-radius: 5px;
            transform: scale(1.05);
        }

        .pin-section {
            position: absolute;
            top: 40%;
            left: 10%;
            right: 10%;
            transform: translateY(-50%);
            color: white;
            text-shadow: 2px 2px 4px black;
        }

        .pin-title {
            text-align: center;
            font-size: 70px;
            font-weight: bold;
        }

        .pin-description {
            text-align: center;
            font-size:33px;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Trebuchet MS', sans-serif;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .pin-title {
                font-size: 30px;
            }

            .pin-description {
                font-size: 16px;
            }

            .dropdown-box {
                bottom: 20%;
            }
        }
    </style>

    <script>
        // Aktifkan submenu dropdown
        document.querySelectorAll('.dropdown-submenu > .dropdown-item').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const submenu = this.nextElementSibling;
                if (submenu) {
                    submenu.classList.toggle('show');
                }
            });
        });
    </script>
</body>
</html>
