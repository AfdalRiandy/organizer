<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventMaster - Aplikasi Pengelolaan Event Organizer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#4361ee',
                            DEFAULT: '#3a56e4',
                            dark: '#3a0ca3',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-gray-50">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="EventMaster Logo" class="h-10 w-auto">
                        <span class="ml-2 text-xl font-bold text-primary">Event<span class="text-gray-800">Master</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition duration-300">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300">Daftar</a>
                </div>
                <div class="flex md:hidden items-center">
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none" id="mobile-menu-button">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile menu -->
            <div class="hidden md:hidden pb-3" id="mobile-menu">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-center text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition duration-300">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-center bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-gray-50 to-gray-100 py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                        Kelola Event Anda dengan <span class="text-primary">Mudah</span>
                    </h1>
                    <p class="text-lg text-gray-600">
                        EventMaster adalah aplikasi pengelolaan event organizer yang membantu Anda merencanakan, mengatur, dan melaksanakan event dengan efisien dan profesional.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-primary text-white font-medium rounded-lg shadow-lg hover:bg-primary-dark transform hover:-translate-y-1 transition duration-300">
                            Mulai Sekarang
                        </a>
                    </div>
                    <div class="flex items-center space-x-4 pt-6">
                        <div class="flex -space-x-2">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" class="w-10 h-10 rounded-full border-2 border-white" alt="User">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-10 h-10 rounded-full border-2 border-white" alt="User">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" class="w-10 h-10 rounded-full border-2 border-white" alt="User">
                        </div>
                        <p class="text-sm text-gray-600">Bergabung dengan <span class="font-medium">3,000+</span> event organizer</p>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-24 h-24 bg-primary-light rounded-full opacity-20 blur-xl"></div>
                        <div class="absolute -bottom-8 -right-8 w-40 h-40 bg-primary-dark rounded-full opacity-20 blur-xl"></div>
                        <img src="{{ asset('assets/img/hero.png') }}" alt="EventMaster Hero" class="relative z-10 rounded-2xl shadow-2xl w-full">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Fitur Utama EventMaster</h2>
                <p class="text-xl text-gray-600">Solusi lengkap untuk pengelolaan event organizer Anda</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-8 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Manajemen Event</h3>
                    <p class="text-gray-600">Kelola jadwal, anggaran, dan detail event secara terintegrasi dalam satu platform.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-6">
                        <i class="fas fa-users-cog text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tim & Vendor</h3>
                    <p class="text-gray-600">Koordinasikan tim dan vendor dengan mudah, buat penugasan dan pantau progresnya.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Laporan & Analitik</h3>
                    <p class="text-gray-600">Dapatkan insight dan laporan detail untuk mengoptimalkan kinerja event Anda.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-6">
                        <i class="fas fa-tasks text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Manajemen Tugas</h3>
                    <p class="text-gray-600">Buat, atur, dan pantau tugas untuk seluruh tim event organizer Anda.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-6">
                        <i class="fas fa-file-invoice-dollar text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pengelolaan Anggaran</h3>
                    <p class="text-gray-600">Rencanakan dan lacak anggaran event dengan mudah untuk memastikan efisiensi biaya.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Akses Mobile</h3>
                    <p class="text-gray-600">Akses dan kelola event Anda dari mana saja dan kapan saja melalui aplikasi mobile.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Apa Kata Pelanggan Kami</h2>
                <p class="text-xl text-gray-600">Mereka telah berhasil menggunakan EventMaster untuk meningkatkan performa bisnis event mereka</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"EventMaster telah membantu perusahaan kami mengorganisir puluhan event korporat dengan sangat efisien. Sangat direkomendasikan!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/23.jpg" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Siti Nurhaliza</h4>
                            <p class="text-gray-500 text-sm">CEO, Kreasi Event Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"Fitur kolaborasi tim membuat koordinasi menjadi jauh lebih mudah. Semua tim saya bisa terhubung dengan baik meski berbeda lokasi."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Budi Hartono</h4>
                            <p class="text-gray-500 text-sm">Event Manager, Spectacular Events</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"Sistem laporan analitik sangat membantu kami mengoptimalkan strategi event berikutnya. Data yang disajikan sangat komprehensif."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Anita Wijaya</h4>
                            <p class="text-gray-500 text-sm">Direktur, Global Events Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-primary to-primary-dark text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Mengelola Event Secara Profesional?</h2>
                <p class="text-xl mb-8 text-white text-opacity-90">Bergabunglah dengan ribuan event organizer yang telah menggunakan EventMaster</p>
                <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-white text-primary font-bold rounded-lg shadow-lg hover:bg-gray-100 transform hover:-translate-y-1 transition duration-300">
                    Daftar Gratis Sekarang
                </a>
                <p class="mt-6 text-white text-opacity-80">Tanpa kartu kredit. Akses fitur premium gratis selama 14 hari.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-primary mb-4">EventMaster</h3>
                    <p class="mb-4 text-gray-400">Platform pengelolaan event organizer terdepan di Indonesia.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Beranda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Fitur</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Harga</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Manajemen Event</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Pengelolaan Tim</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Manajemen Klien</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Pelaporan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-gray-400"></i>
                            <span class="text-gray-400">info@eventmaster.id</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3 text-gray-400"></i>
                            <span class="text-gray-400">+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-gray-400"></i>
                            <span class="text-gray-400">Jl. Gatot Subroto No. 123, Jakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} EventMaster. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>