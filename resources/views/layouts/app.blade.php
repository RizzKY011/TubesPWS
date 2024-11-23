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
<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
        background: url('{{ asset('images/pahlawan.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }

    nav {
        background: linear-gradient(45deg, #797676d3, #b7b7b7c5);
        padding: 15px 0;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        position: fixed;
        width: 100%;
        z-index: 1000;
    }

    /* nav .logo {
        color: white;
        font-size: 24px;
        font-weight: bold;
        margin-left: 20px;
    } */
     .navbar {
        background-color: rgba(0, 0, 0, 0); /* Warna latar belakang lebih gelap untuk navbar */
        padding: 15px 30px; /* Padding di dalam navbar */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5); /* Bayangan untuk navbar */
        position: fixed; /* Memperbaiki posisi navbar di atas */
        width: 100%; /* Lebar penuh */
        top: 0; /* Menempel di bagian atas */
        z-index: 1000; /* Pastikan navbar berada di atas konten lainnya */
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
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 1px;
        padding: 8px 16px;
        border-radius: 5px;
        transition: all 0.3s ease;
        margin-left: 300px;
    }

    .navbar-link:hover {
        background-color: #a39f9f;
        color: hsl(0, 0%, 100%);
        transform: scale(1.1);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    }

    .navbar-link.active {
        background-color: #fff;
        color: #000;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    }

</style>
<body class="bg-gray-100 font-sans">

    {{-- <!-- Navbar -->
    <nav class="bg-blue-500 p-4">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 focus:text-white">
                        <!-- Mobile menu button-->
                    </button>
                </div>
                <div class="flex items-center justify-start space-x-4">
                    <a href="/" class="text-white text-xl">Home</a>
                    <a href="/cari" class="text-white text-xl">Cari</a>
                    <a href="/about" class="text-white text-xl">About</a>
                </div>
                <div class="ml-6 flex items-center space-x-4">
                    <a href="/login" class="text-white text-xl">Login</a>
                </div>
            </div>
        </div>
    </nav> --}}

    <!-- Navbar -->
    <div class="navbar-container">
        <nav class="navbar">
            <ul class="navbar-menu">
                <li>
                    <a href="{{ url('/') }}" 
                       class="navbar-link {{ Request::is('/home') ? 'active' : '' }}">
                       Home
                    </a>
                </li>
                <li>
                    <a href="{{ url('/map') }}" 
                       class="navbar-link {{ Request::is('map') ? 'active' : '' }}">
                       Find a hero
                    </a>
                </li>
                <li>
                    <a href="{{ url('/about') }}" 
                       class="navbar-link {{ Request::is('about') ? 'active' : '' }}">
                       About
                    </a>
                </li>
            </ul>
        </nav>
        
    </div>


    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
</body>
</html>
