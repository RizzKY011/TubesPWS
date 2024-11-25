@extends('layouts.app')

@section('title', 'About - Pencarian Pahlawan')

@section('content')
    <div class="relative max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-16">
        <!-- Background Image -->
        <div class="background-img absolute top-0 left-0 w-full h-full bg-cover bg-center z-0"></div>

        <!-- Heading -->
        <h1 class="text-3xl font-semibold text-center mb-4 text-black relative z-10" style="margin-top: 35px;">Tentang Kami</h1>
        
        <!-- Description about the app -->
        <div class="text-center mb-8 relative z-10">
            <p class="text-lg text-black">
                Aplikasi Pencarian Pahlawan adalah solusi terbaik bagi Anda yang ingin menemukan pahlawan terbaik di Indonesia.
                Kami menyediakan pencarian berbasis wilayah dan kategori pahlawan, membantu Anda menemukan pahlawan yang sesuai dengan sejarah dan latar belakang Anda.
            </p>
        </div>
        
        <!-- Features Section -->
        <div class="mb-8 relative z-10">
            <h2 class="text-2xl font-semibold text-center mb-6 text-black">Fitur Utama</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-black">Pencarian Berdasarkan Nama Pahlawan</h3>
                    <p class="text-gray-800">Cari pahlawan di Indonesia dengan mudah dan cepat.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-black">Web Semantik & RDF</h3>
                    <p class="text-gray-800">Kami menggunakan teknologi web semantik dan RDF untuk menyediakan informasi yang lebih terstruktur dan mudah diakses.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-black">Rekomendasi Makanan</h3>
                    <p class="text-gray-800">Dapatkan rekomendasi makanan berdasarkan preferensi Anda, termasuk kategori dan tingkat kepedasan.</p>
                </div>
            </div>
        </div>

        <!-- How it works Section -->
        <div class="mb-8 relative z-10">
            <h2 class="text-2xl font-semibold text-center mb-6 text-black">Cara Kerja Aplikasi</h2>
            <div class="text-center text-lg text-black">
                <p class="mb-4">Pencarian pahlawan kami bekerja dengan menghubungkan data yang berdasarkan nama dan yang berasal dari beberapa daerah di Indonesia, memberikan Anda pilihan yang lebih luas.</p>
                <p>Langkah-langkah:</p>
                <ul class="list-disc list-inside space-y-2 text-left max-w-lg mx-auto mt-4">
                    <li>Cari nama pahlawan yang Anda inginkan.</li>
                    <li>Hasil dari pencarian anda akan muncul.</li>
                    <li>Dapatkan informasi detail tentang pahlawan tersebut, termasuk deskripsi dan gambar.</li>
                </ul>
            </div>
        </div>

        <!-- Team Section -->
        <div class="mb-8 relative z-10">
            <h2 class="text-2xl font-semibold text-center mb-6 text-black">Tim Pengembang</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Tim Member" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-center text-black">Nama Pengembang 1</h3>
                    <p class="text-center text-gray-800">Pengembang Backend</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Tim Member" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-center text-black">Nama Pengembang 2</h3>
                    <p class="text-center text-gray-800">Pengembang Frontend</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Tim Member" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-center text-black">Nama Pengembang 3</h3>
                    <p class="text-center text-gray-800">Pengembang UX/UI</p>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="text-center mt-8 relative z-10">
            <h2 class="text-2xl font-semibold mb-6 text-black">Hubungi Kami</h2>
            <p class="text-lg text-black mb-4">Jika Anda memiliki pertanyaan atau saran, jangan ragu untuk menghubungi kami melalui email atau media sosial kami.</p>
            <p class="text-lg font-semibold text-blue-500">Email: support@pencarianpahlawan.com</p>
        </div>
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
        background-image: url('{{ asset('images/2.png') }}') no-repeat center center fixed;;
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Ensure the background image doesn't move */
        z-index: -1; /* Ensure it's behind content */
    }

    /* Ensure content is above background */
    .container {
        position: relative;
        z-index: 3; /* Content above background */
    }
    /* Menambahkan efek shadow pada seluruh teks */
.text-black, .text-white, .text-gray-800, .text-lg, .text-xl, .text-2xl, .text-3xl, .font-semibold {
    text-shadow: 2px 2px 5px rgb(133, 133, 133); /* Efek bayangan halus */
}

</style>
