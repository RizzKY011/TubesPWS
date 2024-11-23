@extends('layouts.app')

@section('title', 'About - Pencarian Pahlawan')

@section('content')
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-16 ">
        <!-- Heading -->
        <h1 class="text-3xl font-semibold text-center mb-4 text-white">Tentang Kami</h1>
        
        <!-- Description about the app -->
        <div class="text-center mb-8">
            <p class="text-lg text-white">
                Aplikasi Pencarian Makanan adalah solusi terbaik bagi Anda yang ingin menemukan makanan terbaik di Indonesia.
                Kami menyediakan pencarian berbasis wilayah dan kategori makanan, membantu Anda menemukan hidangan yang sesuai dengan selera Anda.
            </p>
        </div>
        
        <!--    Features Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-center mb-6 text-white">Fitur Utama</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-black">Pencarian Berdasarkan Nama Pahlawan</h3>
                    <p class="text-gray-600">Cari pahlawan di Indonesia dengan mudah dan cepat.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-black">Web Semantik & RDF</h3>
                    <p class="text-gray-600">Kami menggunakan teknologi web semantik dan RDF untuk menyediakan informasi yang lebih terstruktur dan mudah diakses.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-black">Rekomendasi Makanan</h3>
                    <p class="text-gray-600">Dapatkan rekomendasi makanan berdasarkan preferensi Anda, termasuk kategori dan tingkat kepedasan.</p>
                </div>
            </div>
        </div>

        <!-- How it works Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-center mb-6 text-white">Cara Kerja Aplikasi</h2>
            <div class="text-center text-lg text-white">
                <p class="mb-4">Pencarian pahlawan kami bekerja dengan menghubungkan data yang berdasarkan nama dan yang berasal dari beberapa pulau di Indonesia, memberikan Anda pilihan yang lebih luas.</p>
                <p>Langkah-langkah:</p>
                <ul class="list-disc list-inside space-y-2 text-left max-w-lg mx-auto mt-4">
                    <li>Cari nama pahlawan yang Anda inginkan.</li>
                    <li>Hasil dari pencarian anda akan muncul.</li>
                    <li>Dapatkan informasi detail tentang pahlawan tersebut, termasuk deskripsi dan gambar.</li>
                </ul>
            </div>
        </div>

        <!-- Team Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-center mb-6 text-white">Tim Pengembang</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Tim Member" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-center text-black">Nama Pengembang 1</h3>
                    <p class="text-center text-gray-600">Pengembang Backend</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Tim Member" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-center text-black">Nama Pengembang 2</h3>
                    <p class="text-center text-gray-600">Pengembang Frontend</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Tim Member" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-center text-black">Nama Pengembang 3</h3>
                    <p class="text-center text-gray-600">Pengembang UX/UI</p>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="text-center mt-8">
            <h2 class="text-2xl font-semibold mb-6 text-white">Hubungi Kami</h2>
            <p class="text-lg text-white mb-4">Jika Anda memiliki pertanyaan atau saran, jangan ragu untuk menghubungi kami melalui email atau media sosial kami.</p>
            <p class="text-lg font-semibold text-blue-500">Email:</p>
        </div>
    </div>
@endsection
