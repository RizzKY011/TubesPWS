@extends('layouts.app')

@section('title', 'Cari Pahlawan')
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

@section('content')
<div class="container" style="margin-top: 100px; position: relative;">
    <!-- Background Image -->
    <div class="background-img"></div>

    <h1 class="text-center mt-5" style="position: relative; z-index: 3; font-size: 30px;">Cari Pahlawan</h1>

    <!-- Kotak Pencarian -->
    <form method="GET" action="{{ route('hero.search') }}" class="my-4" style="position: relative; z-index: 3;">
        <div class="custom-search-box">
            <input type="text" name="keyword" class="form-control" placeholder="Masukkan nama pahlawan..." value="{{ request('keyword') }}">
            <button type="submit">Cari</button>
        </div>
    </form>
    

    <!-- Hasil Pencarian -->
    @if (!empty($heroes) && count($heroes) > 0)
        <div class="row justify-content-center">
            @foreach ($heroes as $hero)
            <div class="col-md-4 mb-4 position-relative custom-wrapper">
                <a href="{{ $hero['homepage'] }}" target="_blank" class="custom-card-link">
                    <div class="card custom-card">
                        <img src="{{ filter_var($hero['thumbnail'], FILTER_VALIDATE_URL) ? $hero['thumbnail'] : '' }}" class="card-img-top" alt="{{ $hero['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hero['name'] }}</h5>
                        </div>
                    </div>
                </a>
                <!-- Informasi tambahan sebagai card terpisah -->
                <div class="info-card">
                    <p><strong>Abstract:</strong> {{ $hero['abstract'] }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $hero['birthPlace'] }}</p>
                    <p><strong>Tahun Lahir:</strong> {{ $hero['birthYear'] }}</p>
                    <p><strong>Tempat Meninggal:</strong> {{ $hero['deathPlace'] }}</p>
                    <p><strong>Tahun Meninggal:</strong> {{ $hero['deathYear'] }}</p>
                    @if (!empty($hero['battle']))
                        <p><strong>Pertempuran:</strong> {{ $hero['battle'] }}</p>
                    @endif
                    @if (!empty($hero['island']))
                        <p><strong>Wilayah:</strong> {{ $hero['island'] }}</p>
                    @endif
                    <a href="{{ $hero['homepage'] }}" class="btn btn-primary" target="_blank" style="background: #cf0b0b; padding: 8px 355px; margin-top: 10px;">Lihat Selengkapnya</a>
                </div>
            </div>            
            @endforeach
        </div>
    @else
        <p class="text-center" style="position: relative; z-index: 3; font-size:30px; margin-top:20px;" >Tidak ada pahlawan ditemukan</p>
    @endif
</div>
@endsection

<style>
    body, html {
    overflow-x: hidden; 
    overflow-y: auto;
    margin: 0;
    padding: 0;
}
    /* Background image settings */
    .background-img {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('images/background.webp') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        z-index: -1;
    }

    /* Ensure content is above background */
    .container {
        position: relative;
        z-index: 3; /* Content above background */   
    }

    /* Styling for form and cards */
    h1, .input-group, .card, .card-body {
        font-family: 'Arial', sans-serif;
        font-size: 36px;
        font-weight: 700;
        color: #fff;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
    }

    .custom-search-box {
    max-width: 600px;
    margin: 0 auto;
    display: flex;
    border-radius: 50px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background-color: white; /* Menambahkan background untuk keseluruhan search box */
}

.custom-search-box input {
    flex-grow: 1; /* Input box mengisi ruang yang tersedia */
    border: none;
    border-radius: 50px;
    padding-left: 20px;
    font-size: 16px;
    height: 45px; /* Menambah tinggi input */
    outline: none;
    transition: all 0.3s ease;
}

.custom-search-box input:focus {
    border-color: #ff4800;
    box-shadow: 0 0 8px rgba(255, 4, 4, 0.5);
}

.custom-search-box button {
    border-radius: 50px;
    background-color: red;
    color: white;
    border: none;
    padding: 10px 20px;
    height: 45px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-search-box button:hover {
    background-color: rgb(255, 0, 0);
}

.custom-search-box button:focus {
    outline: none;
}

    /* Card image and content styling */
    .card-img-top {
        height: 200px; /* Ukuran gambar lebih kecil */
        object-fit: contain; /* Menjaga agar gambar tidak terpotong dan sesuai dengan ukuran kontainer */
        width: 100%; /* Pastikan gambar mengisi seluruh lebar kontainer */
        border-top-left-radius: 20px; /* Menambahkan kelengkungan pada bagian atas */
        border-top-right-radius: 20px; /* Menambahkan kelengkungan pada bagian atas */
        transition: transform 0.3s ease-in-out;
    }

    /* Hover effect on image */
    .custom-card:hover .card-img-top {
        transform: scale(1.05); /* Gambar sedikit diperbesar saat hover */
    }

    /* Custom card design */
    .custom-card {
        border-radius: 20px; /* Lebih melengkung */
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); /* Bayangan lebih besar */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out; /* Efek transisi */
        height: 100%;
        max-width: 350px; /* Resize the card */
        margin: 0 auto;
        overflow: hidden; /* Agar gambar tidak keluar dari sudut */
        background-color: #fff; /* Warna latar belakang card */
    }

    /* Hover effect for card */
    .custom-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Bayangan lebih dramatis */
        background-color: #b6b6b6; /* Warna latar belakang saat hover */
    }

    /* Card body styling */
    .custom-card .card-body {
        padding: 20px;
        background-color: #bfbfbf;
        position: relative;
        z-index: 2; /* Pastikan konten tetap di atas */
        border-top: 5px solid #c1140ee1;
    }

    /* Card description styling */
    .card-description {
        display: none; /* Sembunyikan deskripsi secara default */
    }

    /* Show description on hover */
    .custom-card:hover .card-description {
        display: block; /* Tampilkan deskripsi saat hover */
    }

    /* Styling for card title */
    .custom-card .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
        transition: color 0.3s ease;
    }

    .custom-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
    position: relative;
}

.custom-card-link:hover .custom-card {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    background-color: #b6b6b6;
}


    /* Hover effect for card title */
    .custom-card:hover .card-title {
        color: #ff0000 ; /* Ganti warna judul saat hover */
    }

    /* Button styling */
    .btn-primary {
        border-radius: 100px;
        padding: 12px 30px;
        background-color: #ff0000;
        border: none;
        font-size: 1rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* Hover effect for button */
    .btn-primary:hover {
        background-color: #ff0000;
        transform: translateY(-2px); /* Efek sedikit melayang saat hover */
    }

    /* Card Text Styling */
    .custom-card .card-text {
        font-size: 1rem;
        color: #555;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    /* Wrapper untuk memastikan posisi relatif */
    .custom-wrapper {
        position: relative; /* Dibutuhkan untuk memposisikan info-card dengan benar */
    }

    /* Menyesuaikan info-card untuk lebih mudah digeser */
.info-card {
    position: absolute;
    top: 0;
    left: 84%;  /* Mulai dari kanan card */
    width: 900px; /* Tentukan lebar info-card */
    padding: 20px;
    background-color: #ebebeb;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transition: all 0.3s ease-in-out;
    z-index: 10;
    height: auto;
    visibility: hidden; /* Pastikan info-card tidak terlihat secara default */
    overflow-y: auto; /* Allow scrolling if content exceeds height */
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.8); /* Glow effect */


}

/* Menambahkan efek geser info-card lebih halus saat hover */
.custom-wrapper:hover .info-card {
    position: absolute;
    padding: 20px;
    left:84.5%;  /* Mulai dari kanan card */
    position: absolute;
    width: 900px; /* Tentukan lebar info-card saat hover */
    opacity: 1;
    visibility: visible; /* Tampilkan saat wrapper di-hover */
    height: auto;


}

</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const wrappers = document.querySelectorAll('.custom-wrapper');

    wrappers.forEach(wrapper => {
        const card = wrapper.querySelector('.custom-card');
        const infoCard = wrapper.querySelector('.info-card');

        // Fungsi untuk memeriksa apakah info-card melebihi lebar tampilan
        function shouldSlideCard() {
            const infoCardRect = infoCard.getBoundingClientRect();
            const viewportWidth = window.innerWidth;
            return infoCardRect.right > viewportWidth; // Cek jika sisi kanan info-card melampaui viewport
        }

        const slideFactor = 2.3; // Ubah nilai ini untuk mengubah seberapa jauh menggeser

        // Saat mouse masuk ke dalam wrapper (hover)
        wrapper.addEventListener('mouseenter', function() {
            if (infoCard && shouldSlideCard()) {
                const offset = infoCard.getBoundingClientRect().right - window.innerWidth; // Hitung offset
                const translateValue = Math.min(offset, card.offsetWidth); // Pastikan kita tidak menggeser lebih dari lebar card

                const adjustedTranslateValue = translateValue * slideFactor; // Sesuaikan nilai pergeseran

                card.style.transform = `translateX(-${adjustedTranslateValue}px)`; // Geser card ke kiri
                infoCard.style.transform = `translateX(-${adjustedTranslateValue}px)`; // Geser info-card ke kiri
                card.style.transition = 'transform 0.3s ease'; // Transisi untuk smooth sliding
                infoCard.style.transition = 'transform 0.3s ease'; // Transisi untuk smooth sliding
            }
        });

        // Saat mouse keluar dari wrapper (hover off)
        wrapper.addEventListener('mouseleave', function() {
            if (infoCard) {
                // Kembalikan card dan info-card ke posisi semula
                card.style.transform = 'translateX(0)';
                infoCard.style.transform = 'translateX(0)';
                card.style.transition = 'transform 0.3s ease'; // Transisi untuk smooth reset
                infoCard.style.transition = 'transform 0.3s ease'; // Transisi untuk smooth reset
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll('.btn-primary');

    buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Mencegah klik tombol memicu klik pada card
        });
    });
});


</script>


