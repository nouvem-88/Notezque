@extends('layouts.topnav-landing')

@section('title', 'Notezque V4 - Solusi Produktivitas Akademik')

@section('content')
    <div class="relative z-10">
        <!-- Bagian 1: Hero Section -->
        <section
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 md:pt-32 md:pb-24 flex flex-col md:flex-row items-center justify-between">

            <!-- Teks Hero -->
            <div class="md:w-3/5 text-center md:text-left animate-on-scroll fade-in-left">
                <p class="text-sm font-semibold text-v4-primary uppercase tracking-wider mb-2">Notezque, Asisten Akademik
                    Anda</p>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-tight mb-4 text-v4-text">
                    Kelola <span class="text-v4-primary">Tugas Kuliah</span> Tanpa Stres
                </h1>
                <p class="text-xl text-gray-500 max-w-xl mx-auto md:mx-0 mb-8">
                    Platform digital terpusat yang dirancang khusus untuk mahasiswa agar aktivitas akademik dan pribadi
                    menjadi terorganisir, fleksibel, dan terfokus.
                </p>

                <div class="flex justify-center md:justify-start space-x-4 mb-10">
                    <!-- ✅ tombol ke halaman register -->
                    <a href="{{ url('/register') }}"
                        class="px-8 py-3 text-lg font-semibold text-white primary-button-pastel rounded-xl shadow-lg hover:opacity-90 transition duration-300">
                        Mulai Sekarang (Gratis) &rarr;
                    </a>

                    <!-- tombol lihat fitur -->
                    <a href="#fitur"
                        class="px-8 py-3 text-lg font-semibold text-v4-primary border border-v4-primary rounded-xl hover:bg-v4-primary/10 transition duration-300">
                        Lihat Fitur
                    </a>
                </div>
            </div>

            <!-- Ilustrasi Hero -->
            <div class="md:w-2/5 mt-12 md:mt-0 flex justify-center relative animate-on-scroll fade-in-right">
                <div
                    class="w-full max-w-sm h-96 bg-v4-surface rounded-3xl p-6 border border-gray-200 flex flex-col items-center justify-center shadow-xl relative transition-transform duration-500 hover:scale-105 hover:shadow-2xl">
                    <!-- Ilustrasi Placeholder Gaya Pastel/Flat -->
                    <svg class="w-64 h-64" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="pastelGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#FFC0CB;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#8C9EFF;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <circle cx="100" cy="110" r="30" fill="#E0E7FF" />
                        <rect x="75" y="135" width="50" height="40" rx="10" fill="#8C9EFF" />
                        <path d="M 85 100 C 85 85, 115 85, 115 100" fill="#FFC0CB" />

                        <rect x="130" y="50" width="40" height="50" rx="5" fill="#FFFFFF" stroke="#A8A8E6"
                            stroke-width="2" />
                        <line x1="135" y1="60" x2="165" y2="60" stroke="#A8A8E6" stroke-width="1" />
                        <line x1="135" y1="70" x2="165" y2="70" stroke="#A8A8E6" stroke-width="1" />
                        <line x1="135" y1="80" x2="165" y2="80" stroke="#A8A8E6" stroke-width="1" />

                        <circle cx="100" cy="100" r="80" fill="url(#pastelGradient)" opacity="0.1" />
                    </svg>
                    <p class="text-xl font-bold text-v4-text mt-4">Fokus di Perkuliahan</p>
                    <p class="text-sm text-gray-500 mt-1">Dapatkan pengingat deadline yang akurat.</p>
                </div>

                <div
                    class="absolute top-0 right-0 w-16 h-16 bg-v4-primary/20 rounded-full transform translate-x-1/2 -translate-y-1/2">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-20 h-20 bg-v4-pink/20 rounded-full transform -translate-x-1/2 translate-y-1/2">
                </div>
            </div>
        </section>

        <!-- Bagian 2: Fitur Utama (Mengadaptasi "Our Services" dari image_ee6241.jpg) -->
        <section id="fitur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="text-4xl font-extrabold text-center mb-4 text-v4-text">
                    Layanan Kami: <span class="text-v4-primary">Fitur Inti</span> Notezque
                </h2>
                <p class="text-lg text-gray-500 text-center mb-16">
                    Kami menyediakan alat lengkap untuk mahasiswa agar produktivitas akademik Anda mencapai level tertinggi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Kartu 1: Kelola Tugas (Gaya kartu dengan warna pastel) -->
                <div
                    class="p-6 rounded-2xl bg-v4-pink/20 shadow-md hover:shadow-xl transition-all duration-500 border border-v4-pink/50 animate-on-scroll fade-in-up card-stagger-1 hover:scale-105 hover:-translate-y-2">
                    <div
                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-4 text-2xl shadow-inner text-v4-pink">
                        <!-- Icon Placeholder: Task List -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M10 16h.01">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-v4-text">Kelola Tugas</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Fitur CRUD lengkap untuk mencatat, mengatur deadline, dan memantau progress tugas kuliah Anda di
                        satu tempat.
                    </p>
                    <a href="#"
                        class="text-sm font-semibold text-v4-pink hover:text-v4-text transition duration-150 flex items-center">
                        Pelajari <span class="ml-1 text-lg leading-none">&rarr;</span>
                    </a>
                </div>

                <!-- Kartu 2: Kalender Aktivitas (Gaya kartu dengan warna pastel) -->
                <div
                    class="p-6 rounded-2xl bg-v4-primary/20 shadow-md hover:shadow-xl transition-all duration-500 border border-v4-primary/50 animate-on-scroll fade-in-up card-stagger-2 hover:scale-105 hover:-translate-y-2">
                    <div
                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-4 text-2xl shadow-inner text-v4-primary">
                        <!-- Icon Placeholder: Calendar -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-v4-text">Kalender Aktivitas</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Kalender interaktif untuk menambahkan, mengedit, dan melihat kegiatan harian, mingguan, atau bulanan
                        Anda secara intuitif.
                    </p>
                    <a href="#"
                        class="text-sm font-semibold text-v4-primary hover:text-v4-text transition duration-150 flex items-center">
                        Pelajari <span class="ml-1 text-lg leading-none">&rarr;</span>
                    </a>
                </div>

                <!-- Kartu 3: Manajemen File (Gaya kartu dengan warna pastel) -->
                <div
                    class="p-6 rounded-2xl bg-v4-secondary/20 shadow-md hover:shadow-xl transition-all duration-500 border border-v4-secondary/50 animate-on-scroll fade-in-up card-stagger-3 hover:scale-105 hover:-translate-y-2">
                    <div
                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-4 text-2xl shadow-inner text-v4-secondary">
                        <!-- Icon Placeholder: Folder File -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-v4-text">Manajemen File</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Menyimpan link/file tugas dan materi berdasarkan kategori untuk arsip sumber belajar yang rapi dan
                        mudah diakses.
                    </p>
                    <a href="#"
                        class="text-sm font-semibold text-v4-secondary hover:text-v4-text transition duration-150 flex items-center">
                        Pelajari <span class="ml-1 text-lg leading-none">&rarr;</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Bagian 3: Alur Kerja (Mengadaptasi "Our Process Workflow" dari image_ee6241.jpg) -->
        <section id="alur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="text-4xl font-extrabold text-center mb-4 text-v4-text">
                    <span class="text-v4-primary">Alur Kerja</span> Kami
                </h2>
                <p class="text-lg text-gray-500 text-center mb-16">
                    Tiga langkah sederhana untuk mengubah cara Anda mengatur tugas dan aktivitas akademik.
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Ilustrasi Alur Kerja (Sesuai image_ee6241.jpg - Lebih Sederhana) -->
                <div class="md:w-1/2 flex justify-center mb-12 md:mb-0 relative animate-on-scroll fade-in-left">
                    <!-- Placeholder Ilustrasi Workflow dengan Pastel Circle dan Line Art -->
                    <div class="w-full max-w-md h-72 rounded-2xl flex items-center justify-center relative">
                        <svg class="w-full h-full" viewBox="0 0 300 200" xmlns="http://www.w3.org/2000/svg">
                            <!-- Background Circles -->
                            <circle cx="250" cy="50" r="30" fill="#FFC0CB" opacity="0.3" />
                            <circle cx="50" cy="150" r="40" fill="#8C9EFF" opacity="0.3" />

                            <!-- Main Line Flow -->
                            <path d="M 70 50 C 150 0, 250 0, 230 50" fill="none" stroke="#A8A8E6" stroke-width="2"
                                stroke-dasharray="5,5" />
                            <path d="M 230 50 C 250 100, 150 100, 70 150" fill="none" stroke="#A8A8E6" stroke-width="2"
                                stroke-dasharray="5,5" />

                            <!-- Step Icons -->
                            <circle cx="70" cy="50" r="15" fill="#8C9EFF" />
                            <text x="70" y="55" text-anchor="middle" font-size="12" fill="white" font-weight="bold">1</text>

                            <circle cx="230" cy="50" r="15" fill="#FFC0CB" />
                            <text x="230" y="55" text-anchor="middle" font-size="12" fill="white"
                                font-weight="bold">2</text>

                            <circle cx="70" cy="150" r="15" fill="#A8A8E6" />
                            <text x="70" y="155" text-anchor="middle" font-size="12" fill="white"
                                font-weight="bold">3</text>

                            <!-- Line Art Elements (Illustrative objects) -->
                            <rect x="235" y="130" width="50" height="40" rx="5" fill="#FFFFFF" stroke="#8C9EFF"
                                stroke-width="1" />
                            <path d="M 235 150 L 285 150" stroke="#8C9EFF" stroke-width="1" />
                            <path d="M 250 130 V 170" stroke="#8C9EFF" stroke-width="1" />
                        </svg>
                    </div>
                </div>

                <!-- Daftar Alur Kerja -->
                <div class="md:w-1/2 space-y-8 md:pl-16 animate-on-scroll fade-in-right">
                    <!-- Step 1: Login & Setup -->
                    <div class="flex items-start transition-all duration-300 hover:translate-x-2">
                        <div
                            class="w-10 h-10 flex items-center justify-center text-lg font-bold rounded-full bg-v4-primary text-white flex-shrink-0 mr-4 shadow-md">
                            01</div>
                        <div>
                            <h3 class="text-xl font-bold text-v4-text mb-1">Daftar & Personalisasi</h3>
                            <p class="text-gray-600">Buat akun Anda, login, dan atur preferensi notifikasi serta kategori
                                mata kuliah Anda.</p>
                        </div>
                    </div>

                    <!-- Step 2: Input & Schedule -->
                    <div class="flex items-start transition-all duration-300 hover:translate-x-2">
                        <div
                            class="w-10 h-10 flex items-center justify-center text-lg font-bold rounded-full bg-v4-pink text-white flex-shrink-0 mr-4 shadow-md">
                            02</div>
                        <div>
                            <h3 class="text-xl font-bold text-v4-text mb-1">Input Tugas & Jadwal</h3>
                            <p class="text-gray-600">Masukkan semua tugas dan kegiatan ke Task Manager dan Kalender
                                Aktivitas dengan deadline yang jelas.</p>
                        </div>
                    </div>

                    <!-- Step 3: Monitor & Collaborate -->
                    <div class="flex items-start transition-all duration-300 hover:translate-x-2">
                        <div
                            class="w-10 h-10 flex items-center justify-center text-lg font-bold rounded-full bg-v4-secondary text-white flex-shrink-0 mr-4 shadow-md">
                            03</div>
                        <div>
                            <h3 class="text-xl font-bold text-v4-text mb-1">Monitor & Kolaborasi</h3>
                            <p class="text-gray-600">Pantau progres di Dashboard, dapatkan pengingat, dan undang teman untuk
                                tugas kelompok.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bagian 4: Call to Action -->
        <section class="mt-12 mb-20 animate-on-scroll fade-in-up">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center rounded-3xl bg-v4-primary/10 border border-v4-primary/20 transition-all duration-500 hover:bg-v4-primary/15 hover:shadow-xl">
                <h2 class="text-4xl font-extrabold mb-4 text-v4-text">
                    Siap Mengubah <span class="text-v4-primary">Gaya Belajar</span> Anda?
                </h2>
                <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                    Notezque adalah solusi terintegrasi, fleksibel, dan efisien yang dirancang untuk kebutuhan akademis
                    mahasiswa modern.
                </p>

                <!-- ✅ tombol CTA ke register -->
                <a href="{{ url('/register') }}" 
                   class="px-10 py-3 text-xl font-semibold text-white primary-button-pastel rounded-xl shadow-lg hover:opacity-90 transition">
                    Mulai Sekarang (Gratis) &rarr;
                </a>
            </div>
        </section>
    </div>
@endsection
