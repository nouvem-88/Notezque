<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Notezque V4 - Pastel Minimalist Productivity')</title>
    <!-- Memuat Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Konfigurasi Tailwind untuk warna dan font (Sesuai Gaya Pastel Minimalis) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Warna dasar pastel
                        'v4-background': '#F9F9F9', // Hampir Putih
                        'v4-surface': '#FFFFFF',    // Putih Murni
                        'v4-primary': '#0E7CF4',    // Blue Pastel (Aksen utama)
                        'v4-secondary': '#6ca9fa',  // Lavender Pastel (Aksen sekunder)
                        'v4-pink': '#FFC0CB',       // Pink Pastel
                        'v4-text': '#1F2937',       // Dark Gray (Teks utama)
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* Smooth scroll behavior untuk seluruh halaman */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9F9F9;
            color: #1F2937;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Fade-in animation untuk elemen yang masuk viewport */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Class untuk animasi */
        .animate-on-scroll {
            opacity: 0;
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .fade-in-left {
            animation: fadeInLeft 0.8s ease-out forwards;
        }

        .fade-in-right {
            animation: fadeInRight 0.8s ease-out forwards;
        }

        /* Stagger animation untuk cards */
        .card-stagger-1 { animation-delay: 0.1s; }
        .card-stagger-2 { animation-delay: 0.2s; }
        .card-stagger-3 { animation-delay: 0.3s; }

        /* Styling untuk Button Primary Pastel dengan smooth transition */
        .primary-button-pastel {
            background-color: #0aa0f6;
            color: white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .primary-button-pastel::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .primary-button-pastel:hover::before {
            width: 300px;
            height: 300px;
        }

        .primary-button-pastel:hover {
            background-color: #7A8CEB;
            box-shadow: 0 8px 25px rgba(140, 158, 255, 0.5);
            transform: translateY(-2px);
        }

        .primary-button-pastel:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(140, 158, 255, 0.4);
        }

        /* Efek blur pastel di latar belakang (seperti di image_fbfe23.png) */
        .abstract-blur-pastel {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            opacity: 0.2;
            filter: blur(150px);
            z-index: -1;
            mix-blend-mode: multiply;
        }
        .blur-pink-pastel { background-color: #FFC0CB; top: -100px; right: -100px; }
        .blur-blue-pastel { background-color: #0aa0f6; bottom: -100px; left: -100px; }
    </style>
</head>
<body class="antialiased">
    <!-- Abstract Blur Background Elements -->
    <div class="abstract-blur-pastel blur-pink-pastel"></div>
    <div class="abstract-blur-pastel blur-blue-pastel"></div>

    <!-- Navigasi Bar -->
    <header class="bg-v4-surface/80 backdrop-blur-sm sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            
            <!-- Logo Notezque (Menggunakan gambar yang diunggah) -->
            <a href="/" class="flex items-center space-x-2 text-xl font-bold text-v4-text">
                <img src="{{ url('logo.png') }}" alt="Notezque Logo" class="h-10 w-auto"/>
                <span class="text-v4-text hidden sm:inline">Notezque</span>
            </a>

            <div class="hidden md:flex space-x-8 items-center text-v4-text">
                <a href="#fitur" class="text-sm font-medium hover:text-v4-primary transition duration-150">Fitur Utama</a>
                <a href="#alur" class="text-sm font-medium hover:text-v4-primary transition duration-150">Alur Kerja</a>
                <a href="#pengembangan" class="text-sm font-medium hover:text-v4-primary transition duration-150">Roadmap</a>
                <a href="#" class="px-5 py-2 text-sm font-semibold primary-button-pastel rounded-full shadow-md">
                    Akses Sistem &rarr;
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-v4-text p-2 rounded-md hover:bg-gray-100 transition duration-150" id="mobile-menu-button-v4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-v4-surface border-t border-gray-100" id="mobile-menu-v4">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="#fitur" class="block px-3 py-2 rounded-md text-base font-medium text-v4-text hover:bg-gray-100">Fitur Utama</a>
                <a href="#alur" class="block px-3 py-2 rounded-md text-base font-medium text-v4-text hover:bg-gray-100">Alur Kerja</a>
                <a href="#pengembangan" class="block px-3 py-2 rounded-md text-base font-medium text-v4-text hover:bg-gray-100">Roadmap</a>
                <a href="#" class="block px-3 py-2 text-base font-semibold primary-button-pastel rounded-full text-center mt-2">
                    Akses Sistem &rarr;
                </a>
            </div>
        </div>
    </header>

    <!-- Konten Halaman -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-v4-surface pt-16 pb-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 border-b border-gray-200 pb-10 mb-8">
                <!-- Logo & Deskripsi -->
                <div class="col-span-2 md:col-span-2">
                     <div class="flex items-center space-x-2 mb-3 text-v4-text">
                        <!-- Logo Footer -->
                        <img src="{{ url('logo.png') }}" alt="Notezque Logo" class="h-10 w-auto"/>
                        <h3 class="text-3xl font-extrabold">Notezque</h3>
                    </div>
                    <p class="text-sm text-gray-500">
                        Platform Manajemen Tugas & Produktivitas Akademik Generasi Baru.
                    </p>
                </div>
                <!-- Navigasi Cepat -->
                <div>
                    <h4 class="text-lg font-bold mb-4 text-v4-text">Navigasi</h4>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><a href="#fitur" class="hover:text-v4-primary transition duration-150">Fitur Inti</a></li>
                        <li><a href="#alur" class="hover:text-v4-primary transition duration-150">Alur Kerja</a></li>
                        <li><a href="#pengembangan" class="hover:text-v4-primary transition duration-150">Roadmap</a></li>
                    </ul>
                </div>
                <!-- Layanan -->
                <div>
                    <h4 class="text-lg font-bold mb-4 text-v4-text">Produk</h4>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><a href="#" class="hover:text-v4-primary transition duration-150">Task Manager</a></li>
                        <li><a href="#" class="hover:text-v4-primary transition duration-150">Academic Calendar</a></li>
                        <li><a href="#" class="hover:text-v4-primary transition duration-150">Team Collaboration</a></li>
                    </ul>
                </div>
                <!-- Sosial & Kontak -->
                <div>
                    <h4 class="text-lg font-bold mb-4 text-v4-text">Sosial</h4>
                    <ul class="space-y-2 text-gray-500 text-sm">
                        <li><a href="#" class="hover:text-v4-primary transition duration-150">LinkedIn</a></li>
                        <li><a href="#" class="hover:text-v4-primary transition duration-150">Instagram</a></li>
                        <li><a href="#" class="hover:text-v4-primary transition duration-150">Support</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center text-sm text-gray-400 mt-8">
                &copy; 2025 Notezque. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        // ===== MOBILE MENU TOGGLE =====
        document.getElementById('mobile-menu-button-v4').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu-v4');
            mobileMenu.classList.toggle('hidden');
        });

        // Menutup menu mobile ketika salah satu link diklik
        document.querySelectorAll('#mobile-menu-v4 a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu-v4').classList.add('hidden');
            });
        });

        // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                
                // Skip jika link hanya "#" atau tidak ada target
                if (href === '#' || href === '#!') return;
                
                const target = document.querySelector(href);
                if (!target) return;
                
                e.preventDefault();
                
                // Smooth scroll dengan offset untuk fixed header
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                document.getElementById('mobile-menu-v4').classList.add('hidden');
            });
        });

        // ===== SCROLL ANIMATIONS (Intersection Observer) =====
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    // Optional: unobserve after animation
                    // observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.animate-on-scroll');
            animateElements.forEach(el => observer.observe(el));
        });

        // ===== HEADER SCROLL EFFECT =====
        let lastScroll = 0;
        const header = document.querySelector('header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            // Add shadow when scrolled
            if (currentScroll > 10) {
                header.classList.add('shadow-md');
            } else {
                header.classList.remove('shadow-md');
            }

            lastScroll = currentScroll;
        });

        // ===== PARALLAX EFFECT FOR BLUR BACKGROUNDS =====
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const blurElements = document.querySelectorAll('.abstract-blur-pastel');
            
            blurElements.forEach((element, index) => {
                const speed = index % 2 === 0 ? 0.5 : -0.3;
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
    </script>
</body>
</html>
