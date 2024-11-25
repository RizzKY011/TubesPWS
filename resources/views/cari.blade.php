@extends('layouts.app')

@section('title', 'Cari Pahlawan')

@section('content')
<div class="container" style="margin-top: 100px; position: relative;">
    <!-- Background Image -->
    <div class="background-img"></div>

    <h1 class="text-center mt-5" style="position: relative; z-index: 3;">Cari Pahlawan</h1>

    <!-- Kotak Pencarian -->
    <form method="GET" action="{{ route('hero.search') }}" class="my-4" style="position: relative; z-index: 3;">
        <div class="input-group custom-search-box">
            <input type="text" name="keyword" class="form-control" placeholder="Masukkan nama pahlawan..." value="{{ request('keyword') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </div>
    </form>

    <!-- Hasil Pencarian -->
    @if (!empty($heroes) && count($heroes) > 0)
        <div class="row justify-content-center">
            @foreach ($heroes as $hero)
                <div class="col-md-4 mb-4">
                    <div class="card custom-card">
                        <img src="{{ filter_var($hero['thumbnail'], FILTER_VALIDATE_URL) ? $hero['thumbnail'] : asset('images/1.jpg') }}" class="card-img-top" alt="{{ $hero['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hero['name'] }}</h5>
                            <p class="card-text">{{ $hero['abstract'] }}</p>
                            <p><strong>Tempat Lahir:</strong> {{ $hero['birthPlace'] }}</p>
                            <p><strong>Tahun Lahir:</strong> {{ $hero['birthYear'] }}</p>
                            <p><strong>Tempat Meninggal:</strong> {{ $hero['deathPlace'] }}</p>
                            <p><strong>Tahun Meninggal:</strong> {{ $hero['deathYear'] }}</p>
                            <a href="{{ $hero['homepage'] }}" class="btn btn-primary" target="_blank">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center" style="position: relative; z-index: 3;">Tidak ada pahlawan ditemukan.</p>
    @endif
</div>
@endsection

<style>
    /* Background image settings */
    .background-img {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('images/2.png') }}');
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
    }

    /* Custom style for the search box */
    .custom-search-box {
        max-width: 600px;
        margin: 0 auto;
        border-radius: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-search-box input {
        border-radius: 50px;
        padding-left: 20px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .custom-search-box input:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    .custom-search-box .input-group-append {
        border-radius: 50px;
        background-color: #007bff;
    }

    .custom-search-box .btn {
        border-radius: 50px;
        padding: 10px 20px;
    }

    /* Card image and content styling */
    .card-img-top {
        height: 300px; /* Reduced size */
        object-fit: cover;
    }

    /* Custom card design */
    .custom-card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        height: 100%;
        max-width: 400px; /* Resize the card */
        margin: 0 auto; /* Center the card */
    }

    .custom-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .custom-card .card-body {
        padding: 20px;
    }

    /* Additional space and style for each card */
    .row {
        margin-top: 30px;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #555;
    }

    .btn-primary {
        border-radius: 50px;
        padding: 10px 25px;
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
