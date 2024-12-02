@extends('layouts.app')

@section('title', 'Cari Pahlawan')

<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

@section('content')
<div class="container" style="margin-top: 100px; position: relative;">
    <!-- Background Image -->
    <div class="background-img"></div>

    <h1 class="text-center mt-5" style="position: relative; z-index: 3; font-size: 30px;">Cari Pahlawan Berdasarkan Wilayah</h1>

    <form id="search-form" method="GET" action="{{ route('hero.search.island') }}" class="my-4" style="position: relative; z-index: 3;">
        <div class="custom-search-box">
            <input type="text" name="island" class="form-control" id="island-input" placeholder="Masukkan nama wilayah..." value="{{ request('island') }}">
            <button type="submit">Cari</button>
        </div>
    </form>
    
    <!-- Menambahkan JavaScript untuk AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#search-form').on('submit', function(e) {
    e.preventDefault();  // Mencegah reload halaman

    var island = $('#island-input').val();

    $.ajax({
        url: "{{ route('hero.search.island') }}",
        method: "GET",
        data: { island: island },
        success: function(response) {
            var heroes = response.heroes;
            var html = '';
            if (heroes.length > 0) {
                heroes.forEach(function(hero) {
                    html += '<div class="col-md-4 mb-4 position-relative custom-wrapper">' +
                            '<a href="' + hero.homepage + '" target="_blank" class="custom-card-link">' +
                                '<div class="card custom-card">' +
                                    '<img src="' + hero.thumbnail + '" class="card-img-top" alt="' + hero.name + '">' +
                                    '<div class="card-body">' +
                                        '<h5 class="card-title">' + hero.name + '</h5>' +
                                    '</div>' +
                                '</div>' +
                            '</a>' +
                            '<div class="info-card">' +
                                '<p><strong>Abstract:</strong> ' + hero.abstract + '</p>' +
                                '<p><strong>Tempat Lahir:</strong> ' + hero.birthPlace + '</p>' +
                                '<p><strong>Tahun Lahir:</strong> ' + hero.birthYear + '</p>' +
                                '<p><strong>Tempat Meninggal:</strong> ' + hero.deathPlace + '</p>' +
                                '<p><strong>Tahun Meninggal:</strong> ' + hero.deathYear + '</p>' +
                                (hero.battle ? '<p><strong>Pertempuran:</strong> ' + hero.battle + '</p>' : '') +
                                (hero.island ? '<p><strong>Wilayah:</strong> ' + hero.island + '</p>' : '') +
                                '<a href="' + hero.homepage + '" class="btn btn-primary" target="_blank" style="background: #cf0b0b; padding: 8px 110px; margin-top: 10px;">Lihat Selengkapnya</a>' +
                            '</div>' +
                        '</div>';
                });
                $('#heroes-results').html(html);  
            } else {
                $('#heroes-results').html('<p class="text-center" style="position: relative; z-index: 3; font-size:30px; margin-top:20px;">Tidak ada pahlawan ditemukan</p>');
            }
        }
    });
});

    </script>
</div>

<div class="container">

    <!-- Kontainer untuk Peta -->
    <div id="map-container">
        <object id="indonesia-map" type="image/svg+xml" data="{{ asset('images/indonesia.svg') }}"></object>
    </div>

    <!-- Kotak untuk menampilkan nama wilayah dan input pencarian -->
    <div id="info-box">
        <div id="info-text"></div>
        <input type="text" id="search-box" placeholder="Nama Wilayah..." readonly/>
    </div>
    <div id="heroes-results"></div>  <!-- Ini akan menampilkan hasil pencarian pahlawan -->


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const homeCarouselImg = parent.document.getElementById('home-carousel-img');
            
            if (homeCarouselImg) {
                homeCarouselImg.style.transition = 'transform 0.8s ease, opacity 0.8s ease';
                homeCarouselImg.style.transform = 'scale(0.6)';
                homeCarouselImg.style.opacity = '0.8';
            }
        });

        document.getElementById('indonesia-map').addEventListener('load', function () {
    const svgDoc = this.contentDocument;
    const paths = svgDoc.querySelectorAll('path');
    const searchBox = document.getElementById('search-box');
    const cityImage = document.getElementById('city-image');

    // Hover behavior
    paths.forEach(function (path) {
        path.addEventListener('mouseover', function () {
            path.setAttribute('fill', 'black');
            path.style.transform = 'scale(1.02)';

            paths.forEach(function (otherPath) {
                if (otherPath !== path) {
                    otherPath.style.opacity = '0.2';
                }
            });

            const title = path.getAttribute('title');
            searchBox.value = title; // Display the region name in the search box
        });

        path.addEventListener('mouseout', function () {
            path.removeAttribute('fill');
            path.style.transform = 'scale(1)';

            paths.forEach(function (otherPath) {
                otherPath.style.opacity = '1';
            });

            searchBox.value = ''; // Clear the search box
            cityImage.src = "{{ asset('images/default-city.jpg') }}";
        });

        path.addEventListener('click', function () {
            const title = path.getAttribute('title');
            searchBox.value = title; // Set the region name into the search box

            // Dynamically update the island input field for AJAX request
            $('#island-input').val(title);

            // Trigger the search after updating the input
            $('#search-form').submit();
        });
    });
});

    </script>
</div>
@endsection
<style>

    #heroes-results {
        margin-top:20px;    
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .custom-wrapper {
        margin: 10px;
        width: 30%;  /* Menampilkan 3 card dalam satu baris */
    }

    @media (max-width: 768px) {
        .custom-wrapper {
            width: 100%;  /* Card menyesuaikan ukuran layar lebih kecil */
        }
    }

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
/* Menyembunyikan info-card secara default */
/* Menyembunyikan info-card secara default */
/* Menyembunyikan info-card secara default */
/* Menyembunyikan info-card secara default */
.info-card {
    display: none; /* Elemen tidak ada di DOM */
    position: absolute;
    top: 100%; /* Posisi info-card tepat di bawah custom-card */
    left: 50%;
    transform: translateX(-50%) translateY(-20px); /* Mulai dari posisi sedikit lebih tinggi */
    opacity: 0; /* Tidak terlihat secara default */
    width: 400px;
    padding: 20px;
    background-color: #ebebeb;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: opacity 0.4s ease-out, transform 0.4s ease-out; /* Animasi opacity dan transform */
    z-index: 10; /* Pastikan info-card muncul di atas elemen lain */
}

/* Menampilkan info-card ketika custom-wrapper di hover */
.custom-wrapper:hover .info-card {
    display: block; /* Menampilkan info-card ketika dihover */
    opacity: 1; /* Membuat info-card tampak */
    pointer-events: auto; /* Mengaktifkan interaksi ketika muncul */
    transform: translateX(-50%) translateY(0); /* Geser info-card ke posisi normal */
}

/* Menghindari elemen lain terhalang info-card */
.custom-wrapper {
    position: relative; /* Menjaga posisi relatif agar info-card berada di atasnya */
}



/* Peta */
#map-container {
    text-align: center; /* Pusatkan peta di tengah */
    margin: 20px auto; /* Spasi dari atas dan bawah */
    width: 80%; /* Ukuran peta lebih besar */
    max-width: 1200px; /* Max-width agar tidak terlalu besar */
}

#indonesia-map {
    width: 100%; /* Peta mengisi seluruh lebar kontainer */
    height: 350px; /* Perbesar ukuran peta */
    border: none;
    margin-left: 200px;
}

/* Tampilan kotak pencarian */
#info-box {
    text-align: center;
    margin-top: 0px;
}

#search-box {
    width: 20%; /* Lebar input yang lebih besar */
    padding: 5px;
    font-size: 18px;
    border-radius: 15px; /* Memberikan sudut melengkung pada kotak pencarian */
    border: 2px solid #fcfafa; /* Garis border warna orange */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    outline: none;
}

#search-box:focus {
    border-color: #000000; /* Warna border saat fokus */
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.5); /* Efek glow saat fokus */
}

/* Tampilan gambar kota */

/* Menambahkan transisi untuk tampilan kotak pencarian */
#search-box {
    transition: all 0.3s ease;
}

#search-box:hover {
    background-color: #f4f4f4; /* Warna latar belakang berubah saat hover */
}




</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const wrappers = document.querySelectorAll('.custom-wrapper');

    wrappers.forEach(wrapper => {
        const card = wrapper.querySelector('.custom-card');
        const infoCard = wrapper.querySelector('.info-card');

        // Event saat mouse masuk ke area card
        card.addEventListener('mouseenter', function() {
            infoCard.style.opacity = '1';
            infoCard.style.visibility = 'visible';  // Menampilkan info-card
            infoCard.style.transform = 'translateY(10px)'; // Geser info-card sedikit ke bawah
        });

        // Event saat mouse keluar dari area card
        card.addEventListener('mouseleave', function() {
            infoCard.style.opacity = '0';
            infoCard.style.visibility = 'hidden';  // Menyembunyikan info-card
            infoCard.style.transform = 'translateY(0)'; // Kembali ke posisi semula
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

