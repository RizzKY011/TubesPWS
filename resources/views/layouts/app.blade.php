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
        background: url('{{ asset('images/background.webp') }}') no-repeat center center fixed;
        background-size: cover;

    }
    .background-img {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('images/background.webp') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Ensure the background image doesn't move */
        z-index: 1; /* Ensure it's behind content */
        
    }

    /* Ensure content is above background */
    .container {
        position: relative;
        z-index: 3; /* Content above background */
    }

    /* Styling for form and cards */
    h1, .input-group, .card, .card-body {
        z-index: 3; /* Content above background */
        position: relative;
        color: rgb(42, 42, 42);
        text-shadow: 2px 2px 5px rgb(254, 254, 254); /* Efek bayangan halus */  
        font-size: 4rem;
        font-weight: bold;
    }

.navbar-container {
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000; /* Agar navbar selalu di atas gambar */
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

/* Menghilangkan scrollbar di tampilan web */
::-webkit-scrollbar {
    display: none;
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
                    <li><a href="{{ route('hero.search', ['view' => 'map']) }}" class="navbar-link" id="find-hero-map-btn">Cari Pahlawan</a></li>

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
