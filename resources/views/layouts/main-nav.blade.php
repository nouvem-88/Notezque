<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Interaktif | Notezque V6</title>
    <!-- Memuat Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Konfigurasi Tailwind untuk warna dan font (Sesuai Gaya Pastel Minimalis) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Warna dasar pastel dari app-v4.blade.php
                        'v4-background': '#F9F9F9', // Hampir Putih (Background utama)
                        'v4-surface': '#FFFFFF', // Putih Murni (Card/Surface)
                        'v4-primary': '#3385ff', // Blue Pastel (Aksen utama)
                        'v4-secondary': '#A8A8E6', // Lavender Pastel (Aksen sekunder)
                        'v4-pink': '#FFC0CB', // Pink Pastel
                        'v4-text': '#1F2937', // Dark Gray (Teks utama)
                        'v4-light': '#EDEFFF', // Sangat terang untuk hover sidebar
                        'v4-subtle': '#E5E7EB',
                        'v4-custom': '#33adff' // Abu-abu terang
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    keyframes: {
                        'ping-slow': {
                            '75%, 100%': { transform: 'scale(1.5)', opacity: '0' },
                        }
                    },
                    animation: {
                        'ping-slow': 'ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite',
                    }
                }
            }
        }
    </script>
    <!-- Tambahkan Lucide Icons untuk kebutuhan Dashboard -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--tw-colors-v4-background);
            color: var(--tw-colors-v4-text);
            line-height: 1.6;
        }

        /* --- Sidebar Collapsible (Desktop Only) --- */
        .sidebar-expanded {
            width: 16rem;
            /* w-64 */
            padding-right: 1.5rem;
            /* p-6 */
            padding-left: 1.5rem;
            /* p-6 */
        }

        .sidebar-collapsed {
            width: 5rem;
            /* 80px */
            padding-right: 0.5rem;
            /* p-2 */
            padding-left: 0.5rem;
            /* p-2 */
        }

        .sidebar-collapsed .nav-text,
        .sidebar-collapsed .logo-text,
        .sidebar-collapsed .logo-img-expanded,
        .sidebar-collapsed .logo-header-expanded {
            display: none !important;
        }

        .sidebar-collapsed .sidebar-item {
            justify-content: center;
        }

        .sidebar-collapsed .logo-img-collapsed {
            display: block !important;
        }

        .sidebar-collapsed .logo-header-collapsed {
            display: flex !important;
            justify-content: center;
        }

        /* Menghapus border saat collapsed untuk tampilan minimalis */
        .sidebar-collapsed .border-b,
        .sidebar-collapsed .border-t {
            border-color: transparent !important;
        }


        /* --- Styling Sidebar Item --- */
        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-radius: 0.75rem;
            /* rounded-xl */
            color: #6B7280;
            /* gray-500 */
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            /* Ensure text wraps correctly in expanded mode */
            white-space: nowrap;
        }

        .sidebar-item:hover {
            background-color: var(--tw-colors-v4-light);
            color: var(--tw-colors-v4-primary);
            box-shadow: 0 4px 6px -1px rgba(140, 158, 255, 0.1), 0 2px 4px -2px rgba(140, 158, 255, 0.06);
            transform: translateY(-1px);
        }

        /* Styling Sidebar item aktif */
        .sidebar-active {
            background-color: rgb(239 246 255);
            color: var(--tw-colors-v4-primary) !important;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(140, 158, 255, 0.3), 0 4px 6px -4px rgba(140, 158, 255, 0.1);
        }

        .sidebar-active svg {
            color: var(--tw-colors-v4-primary) !important;
        }

        /* Force color of icon when active, but match text color */
        .sidebar-active i[data-lucide] {
            color: var(--tw-colors-v4-primary) !important;
        }

        /* --- Styling Top Nav Icons --- */
        .top-nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 9999px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        .top-nav-icon:hover {
            background-color: var(--tw-colors-v4-subtle);
            transform: scale(1.05);
        }

        /* --- Scrollbar Minimalis (Aesthetic Scrollbar) --- */
        #main-content::-webkit-scrollbar {
            width: 6px;
            background: transparent;
        }

        #main-content::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            /* gray-300 */
            border-radius: 10px;
        }

        #main-content::-webkit-scrollbar-thumb:hover {
            background-color: #9ca3af;
            /* gray-400 */
        }

        /* --- Dark Mode Styles --- */
        .dark body {
            background-color: #1a1a1a;
            color: #e5e7eb;
        }

        .dark .bg-v4-surface {
            background-color: #2d2d2d !important;
        }

        .dark .bg-v4-background {
            background-color: #1a1a1a !important;
        }

        .dark .text-v4-text {
            color: #e5e7eb !important;
        }

        .dark .border-gray-100,
        .dark .border-gray-200 {
            border-color: #374151 !important;
        }

        .dark .text-gray-500 {
            color: #9ca3af !important;
        }

        .dark .text-gray-400 {
            color: #6b7280 !important;
        }

        .dark .hover\:bg-v4-subtle:hover {
            background-color: #374151 !important;
        }

        .dark .sidebar-item:hover {
            background-color: #374151 !important;
        }

        .dark .top-nav-icon:hover {
            background-color: #374151 !important;
        }

        .dark #profile-dropdown-menu,
        .dark #notif-dropdown {
            background-color: #2d2d2d !important;
            border-color: #374151 !important;
        }

        .dark .hover\:bg-v4-light:hover {
            background-color: #374151 !important;
        }

        /* Smooth transition untuk dark mode */
        body,
        aside,
        header,
        main,
        footer,
        .bg-v4-surface,
        .bg-v4-background,
        .sidebar-item,
        .top-nav-icon {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    </style>
</head>

<body class="antialiased flex flex-col h-screen">

    <div class="flex flex-1 overflow-hidden">
        <!-- 1. Sidebar (Navigasi Kiri) -->
        <aside id="sidebar"
            class="bg-v4-surface p-4 shadow-xl z-20 transition-[width,transform,padding] duration-300 ease-in-out transform -translate-x-full fixed md:relative md:translate-x-0 h-full border-r border-gray-100 flex flex-col sidebar-collapsed">
            <!-- CATATAN: Status awal diubah ke 'sidebar-collapsed' -->

            <!-- Logo Header -->
            <div id="logo-toggle-area"
                class="mb-6 flex flex-col cursor-pointer group md:hover:bg-v4-light md:p-1 md:-mx-1 md:rounded-xl transition duration-200">

                <!-- Expanded Header -->
                <div id="logo-header-expanded"
                    class="flex items-center space-x-2 p-4 border-b border-gray-100 logo-header-expanded">
                    <!-- Gunakan placeholder image karena asset('logo.png') tidak tersedia di sini -->
                    <img src="{{ 'logo.png' }}" alt="Notezque Logo"
                        class="h-10 w-auto transition-transform duration-500 group-hover:scale-[1.05] logo-img-expanded" />
                    <span class="text-xl font-bold text-v4-primary logo-text">NotezQue</span>
                </div>

                <!-- Collapsed Header (Hidden by default, hanya menampilkan ikon) -->
                <div id="logo-header-collapsed" class="hidden justify-center logo-header-collapsed">
                    <img src="{{ 'logo.png' }}" alt="Notezque Logo Collapsed"
                        class="h-10 w-10 rounded-lg logo-img-collapsed transition-transform duration-500 group-hover:scale-110" />
                </div>

            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-grow space-y-2">

                <!-- Dashboard (Aktif) -->
                <a href="{{url('/dashboard')}}" id="nav-dashboard" class="sidebar-item sidebar-active ">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 transition-colors shrink-0"></i>
                    <span class="nav-text ml-2 h-5 ">Dashboard</span>
                </a>

                <!-- Jadwal Acara -->
                <a href="{{ url('/kalender') }}" id="nav-courses" class="sidebar-item ">
                    <i data-lucide="calendar" class="w-5 h-5 transition-colors shrink-0"></i>
                    <span class="nav-text ml-2 h-5">Kalender Acara</span>
                </a>

                <!-- Kolaborasi -->
                <a href="{{ url('/tugas') }}" id="nav-chats" class="sidebar-item ">
                    <i data-lucide="file-check-2" class="w-5 h-5 transition-colors shrink-0"></i>
                    <span class="nav-text ml-2 h-5">Kelola Tugas</span>
                </a>

                <!-- Nilai -->
                <a href="{{ url('/materi') }}" id="nav-grades" class="sidebar-item ">
                    <i data-lucide="brain-circuit" class="w-5 h-5 transition-colors shrink-0"></i>
                    <span class="nav-text ml-2 h-5">File Materi</span>
                </a>

                <!-- Jadwal -->
                <a href="{{ url('/catatan') }}" id="nav-schedule" class="sidebar-item ">
                    <i data-lucide="notebook-pen" class="w-5 h-5 transition-colors shrink-0"></i>
                    <span class="nav-text ml-2 h-5">Catatan</span>
                </a>
            </nav>

            <!-- Menu Pengaturan Bawah -->
            <div class="mt-auto pt-6 border-t border-gray-100">
                <!-- Dark Mode Toggle -->
                <button id="dark-mode-toggle" class="sidebar-item w-full">
                    <i data-lucide="moon" id="dark-icon" class="w-5 h-5 transition-colors shrink-0"></i>
                    <i data-lucide="sun" id="light-icon" class="w-5 h-5 transition-colors shrink-0 hidden"></i>
                    <span class="nav-text ml-2 h-5">Mode Gelap</span>
                </button>
                
                <a href="{{ url('/') }}" class="sidebar-item mt-2">
                    <i data-lucide="log-out" class="w-5 h-5 transition-colors shrink-0"></i>
                    <span class="nav-text ml-2 h-5">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Konten Utama (Top Nav + Main Content) -->
        <div id="main-container" class="flex-1 flex flex-col overflow-hidden transition-[margin-left] duration-300">

            <!-- 2. Top Navigation Bar (Nav Atas) -->
            <header class="bg-v4-surface shadow-sm sticky top-0 z-10 p-4 border-b border-gray-100">
                <div class="flex items-center justify-between">

                    <!-- Tombol Toggle Sidebar (Hanya di Mobile) -->
                    <button id="sidebar-toggle-mobile"
                        class="md:hidden text-v4-text mr-4 p-2 rounded-lg hover:bg-v4-subtle transition">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    <!-- Nama Halaman -->
                    <h1 class="text-2xl font-extrabold text-v4-text mr-auto">@yield('title', 'Ganti ini')</h1>

                    <!-- Search Bar (Pusat) -->
                    <div
                        class="hidden sm:flex flex-1 max-w-lg mx-8 items-center bg-v4-background border border-v4-subtle rounded-xl px-4 py-2 shadow-inner transition duration-300 focus-within:border-v4-primary focus-within:ring-1 focus-within:ring-v4-primary">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 mr-2"></i>
                        <input type="text" placeholder="Cari Tugas, Materi, atau Jadwal..."
                            class="bg-transparent w-full focus:outline-none text-sm placeholder-gray-400">
                    </div>

                    <!-- Ikon Notifikasi, Profil, dan Edit (Kanan) -->
                    <div class="flex items-center space-x-3">

                        <!-- 🔔 Notifikasi -->
                        <div id="notif-trigger" class="relative">
                            <div class="top-nav-icon group">
                                <i data-lucide="bell" class="w-5 h-5 text-gray-500 transition duration-200 group-hover:text-v4-primary"></i>
                                <span
                                    class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-v4-pink animate-ping-slow"></span>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-v4-pink"></span>
                            </div>
                        
                            <!-- 🔽 Dropdown Notifikasi -->
                            <div id="notif-dropdown"
                                class="absolute right-0 mt-3 w-72 bg-v4-surface rounded-xl shadow-xl border border-gray-100 py-2 opacity-0 pointer-events-none transition-all duration-200 transform origin-top-right scale-95">
                                <div class="px-4 py-2 border-b border-gray-100 font-semibold text-v4-text">
                                    Notifikasi
                                </div>
                        
                                <!-- 🧾 Data Dummy -->
                                <div class="max-h-60 overflow-y-auto">
                                    <div class="px-4 py-3 flex items-start gap-3 hover:bg-v4-light transition cursor-pointer">
                                        <i data-lucide="clock" class="w-5 h-5 text-v4-primary mt-0.5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-v4-text">Deadline tugas “Web Design Dasar” sebentar lagi</p>
                                            <span class="text-xs text-gray-400">2 jam yang lalu</span>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 flex items-start gap-3 hover:bg-v4-light transition cursor-pointer">
                                        <i data-lucide="edit-3" class="w-5 h-5 text-v4-secondary mt-0.5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-v4-text">Kamu membuat catatan baru</p>
                                            <span class="text-xs text-gray-400">Kemarin</span>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 flex items-start gap-3 hover:bg-v4-light transition cursor-pointer">
                                        <i data-lucide="calendar" class="w-5 h-5 text-v4-pink mt-0.5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-v4-text">Ada acara baru di kalender: “Presentasi Kelompok”</p>
                                            <span class="text-xs text-gray-400">3 hari yang lalu</span>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="border-t border-gray-100 mt-2 pt-2 text-center">
                                    <a href="#" class="text-xs text-v4-primary font-semibold hover:underline">Lihat semua notifikasi</a>
                                </div>
                            </div>
                        </div>

                        <!-- Edit/Quick Action -->
                        <!-- <div class="top-nav-icon group">
                            <i data-lucide="edit"
                                class="w-5 h-5 text-gray-500 transition duration-200 group-hover:text-v4-secondary"></i>
                        </div> -->

                        <!-- Profile Dropdown Trigger -->
                        <div id="profile-dropdown-trigger" class="relative">
                            <div class="flex items-center space-x-2 ml-4 cursor-pointer p-1 rounded-full hover:bg-v4-subtle transition duration-200"
                                aria-expanded="false" aria-controls="profile-dropdown-menu">
                                <img src="https://placehold.co/40x40/A8A8E6/FFFFFF?text=B" alt="Profile"
                                    class="h-10 w-10 rounded-full object-cover border-2 border-v4-secondary shadow-md">
                                <span class="text-sm font-medium text-v4-text hidden lg:inline">Halo, Pengguna!</span>
                                <i data-lucide="chevron-down"
                                    class="w-4 h-4 text-gray-500 hidden lg:inline transition-transform duration-200"
                                    id="profile-arrow"></i>
                            </div>

                            <!-- Profile Dropdown Menu -->
                            <div id="profile-dropdown-menu"
                                class="absolute right-0 mt-3 w-48 bg-v4-surface rounded-xl shadow-xl border border-gray-100 py-1 opacity-0 pointer-events-none transition-opacity duration-200 transform origin-top-right scale-95"
                                role="menu" aria-orientation="vertical">
                                <a href="{{ url('/profile') }}"
                                    class="px-4 py-2 text-sm text-gray-700 hover:bg-v4-light hover:text-v4-primary flex items-center transition duration-150">
                                    <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profil Saya
                                </a>
                                <a href="#"
                                    class="px-4 py-2 text-sm text-gray-700 hover:bg-v4-light hover:text-v4-primary flex items-center transition duration-150">
                                    <i data-lucide="life-buoy" class="w-4 h-4 mr-2"></i> Bantuan
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ url('/') }}"
                                    class="px-4 py-2 text-sm text-red-500 hover:bg-red-50 flex items-center transition duration-150">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Keluar
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- Main Content Area (Overflow-y for content) -->
            <main id="main-content" class="flex-1 overflow-x-hidden overflow-y-auto  bg-v4-background">
                <!-- Tambahkan Konten Dashboard di sini -->
                    @yield('content')
                    
            </main>

            <!-- 3. Footer-->
            <footer class="bg-v4-surface py-3 border-t border-gray-200 w-full"
                style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Copyright -->
                    <div class="text-center text-xs text-gray-400">
                        &copy; 2025 Notezque. All Rights Reserved. Platform Manajemen Tugas dan Produktivitas Akademik.
                    </div>
                </div>
            </footer>

        </div>
    </div>


    <!-- Overlay untuk mobile, menutup sidebar saat diklik -->
    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black opacity-0 md:hidden z-10 transition-opacity duration-300 pointer-events-none">
    </div>


    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        // Elemen Utama
        const sidebar = document.getElementById('sidebar');
        const mainContainer = document.getElementById('main-container');
        const toggleButtonMobile = document.getElementById('sidebar-toggle-mobile');
        const overlay = document.getElementById('sidebar-overlay');
        const logoToggleArea = document.getElementById('logo-toggle-area');

        // State Global Baru
        let isSidebarExpanded = false; // Status visual saat ini (collapsed/expanded)
        let isSidebarLocked = false; // Status permanen (true jika diklik/link aktif)


        // --- FUNGSI UTAMA UNTUK MENGATUR TAMPILAN DESKTOP ---
        function setDesktopLayout(expanded) {
            if (expanded) {
                // Expanded: Tampilkan teks, pakai kelas expanded
                sidebar.classList.replace('sidebar-collapsed', 'sidebar-expanded');
            } else {
                // Collapsed: Sembunyikan teks, pakai kelas collapsed
                sidebar.classList.replace('sidebar-expanded', 'sidebar-collapsed');
            }
            isSidebarExpanded = expanded;
        }

        // --- 1. Logika Toggle Sidebar untuk Mobile (Overlay Mode) ---
        function toggleMobileSidebar(open) {
            if (open) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('opacity-50', 'pointer-events-auto');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-50', 'pointer-events-auto');
            }
        }

        toggleButtonMobile.addEventListener('click', () => toggleMobileSidebar(sidebar.classList.contains('-translate-x-full')));
        overlay.addEventListener('click', () => toggleMobileSidebar(false));

        // Menutup sidebar saat link di mobile diklik
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleMobileSidebar(false);
                }
            });
        });


        // --- 2. Logika Toggle Sidebar untuk Desktop (Klik Logo -> Permanent Toggle) ---
        function toggleDesktopSidebar() {
            // Hanya aktifkan toggle di mode desktop
            if (window.innerWidth >= 768) {
                isSidebarLocked = !isSidebarLocked;
                // Terapkan layout berdasarkan status Lock yang baru
                setDesktopLayout(isSidebarLocked);
            }
        }

        // Event Listener: Klik pada area logo untuk Toggle Permanen
        logoToggleArea.addEventListener('click', toggleDesktopSidebar);


        // --- 3. Logika Hover Sidebar (Temporary Expand) ---
        sidebar.addEventListener('mouseover', () => {
            // Hanya aktifkan hover jika tidak sedang dikunci (locked) dan di mode desktop
            if (!isSidebarLocked && window.innerWidth >= 768) {
                setDesktopLayout(true); // Temporary expand
            }
        });

        sidebar.addEventListener('mouseleave', () => {
            // Hanya aktifkan mouseleave jika tidak sedang dikunci (locked) dan di mode desktop
            if (!isSidebarLocked && window.innerWidth >= 768) {
                setDesktopLayout(false); // Collapse back
            }
        });


        // --- 4. Logika Dropdown Profil (Tidak berubah) ---
        const profileTrigger = document.querySelector('#profile-dropdown-trigger > div');
        const profileMenu = document.getElementById('profile-dropdown-menu');
        const profileArrow = document.getElementById('profile-arrow');
        let isDropdownOpen = false;

        function toggleDropdown(open) {
            isDropdownOpen = open;
            if (open) {
                profileMenu.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
                profileMenu.classList.add('opacity-100', 'scale-100');
                profileArrow.classList.add('rotate-180');
                profileTrigger.setAttribute('aria-expanded', 'true');
            } else {
                profileMenu.classList.remove('opacity-100', 'scale-100');
                profileMenu.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
                profileArrow.classList.remove('rotate-180');
                profileTrigger.setAttribute('aria-expanded', 'false');
            }
        }

        profileTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown(!isDropdownOpen);
        });

        document.addEventListener('click', (e) => {
            if (isDropdownOpen && !profileMenu.contains(e.target) && !profileTrigger.contains(e.target)) {
                toggleDropdown(false);
            }
        });

        // --- 5. Logika Navigasi & Active State (Berdasarkan URL) ---
        function setActiveLink() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-item').forEach(item => {
                const itemPath = new URL(item.href).pathname;

                // Hapus state aktif dari semua item terlebih dahulu
                item.classList.remove('sidebar-active');

                // Tambahkan state aktif jika path cocok
                // Logika khusus untuk dashboard ('/')
                if (item.id === 'nav-dashboard' && (currentPath === '/dashboard' || currentPath === '/')) {
                    item.classList.add('sidebar-active');
                }
                // Untuk link lainnya
                else if (item.id !== 'nav-dashboard' && currentPath.startsWith(itemPath)) {
                    item.classList.add('sidebar-active');
                }
            });

            // Jika ada item yang aktif, pastikan sidebar expanded (jika di desktop)
            const hasActiveItem = document.querySelector('.sidebar-item.sidebar-active');
            if (hasActiveItem && window.innerWidth >= 768) {
                isSidebarLocked = true;
                setDesktopLayout(true);
            }
        }

        // Hapus event listener lama yang menggunakan preventDefault
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function() {
                // Saat item diklik, kita hanya perlu memastikan sidebar terkunci jika di desktop
                if (window.innerWidth >= 768) {
                    isSidebarLocked = true;
                    setDesktopLayout(true);
                }
                // Navigasi akan berjalan normal karena tidak ada preventDefault
            });
        });


        // --- 6. Inisialisasi awal (Desktop Default Collapsed, kecuali ada item aktif) ---
        function initSidebar() {
            if (window.innerWidth >= 768) {
                // Desktop mode
                sidebar.classList.remove('fixed', '-translate-x-full');
                sidebar.classList.add('relative');

                // Atur layout sesuai status lock awal (biasanya false)
                setDesktopLayout(isSidebarLocked);

            } else {
                // Mobile mode
                sidebar.classList.add('fixed', '-translate-x-full');
                sidebar.classList.remove('relative', 'sidebar-expanded', 'sidebar-collapsed');
            }
            // Panggil fungsi untuk set link aktif setelah inisialisasi
            setActiveLink();
        }

        window.addEventListener('load', initSidebar);
        window.addEventListener('resize', initSidebar);
        // 🔔 Logika Dropdown Notifikasi
        const notifTrigger = document.getElementById('notif-trigger');
        const notifDropdown = document.getElementById('notif-dropdown');
        let isNotifOpen = false;

        notifTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            isNotifOpen = !isNotifOpen;
            if (isNotifOpen) {
                notifDropdown.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
                notifDropdown.classList.add('opacity-100', 'scale-100');
            } else {
                notifDropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
                notifDropdown.classList.remove('opacity-100', 'scale-100');
            }
        });

        // Tutup dropdown notifikasi kalau klik di luar
        document.addEventListener('click', (e) => {
            if (isNotifOpen && !notifTrigger.contains(e.target)) {
                notifDropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
                notifDropdown.classList.remove('opacity-100', 'scale-100');
                isNotifOpen = false;
            }
        });

        // --- Dark Mode Toggle Logic ---
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const darkIcon = document.getElementById('dark-icon');
        const lightIcon = document.getElementById('light-icon');
        const html = document.documentElement;

        // Check for saved theme preference or default to 'light'
        const currentTheme = localStorage.getItem('theme') || 'light';
        
        // Apply saved theme on page load
        if (currentTheme === 'dark') {
            html.classList.add('dark');
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
            // Update text jika sidebar expanded
            const navText = darkModeToggle.querySelector('.nav-text');
            if (navText) navText.textContent = 'Mode Terang';
        }

        // Toggle dark mode on button click
        darkModeToggle.addEventListener('click', function() {
            html.classList.toggle('dark');
            
            // Toggle icons
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');
            
            // Update text
            const navText = this.querySelector('.nav-text');
            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                if (navText) navText.textContent = 'Mode Terang';
            } else {
                localStorage.setItem('theme', 'light');
                if (navText) navText.textContent = 'Mode Gelap';
            }
            
            // Recreate Lucide icons after toggle
            lucide.createIcons();
        });
    </script>
</body>

</html>