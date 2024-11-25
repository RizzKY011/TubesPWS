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
    @if (!empty($heroesPaginated) && count($heroesPaginated) > 0)
        <div class="row" style="position: relative; z-index: 3;">
            @foreach ($heroesPaginated as $hero)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ $hero['thumbnail'] }}" class="card-img-top" alt="{{ $hero['name'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $hero['name'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <ul class="pagination">
                @for ($i = 1; $i <= $totalPages; $i++)
                    <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('hero.search', ['keyword' => request('keyword'), 'page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    @else
        <p class="text-center">Tidak ada pahlawan yang ditemukan.</p>
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

    .input-group {
        margin-top: 20px;
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
        height: 200px;
        object-fit: cover;
    }

    /* Styling for pagination */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
