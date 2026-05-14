<?php
// dashboard_mahasiswa.php
session_start();

// PROTEKSI HALAMAN: Paksa kembali ke login jika tidak ada session 'id' 
// atau jika yang mencoba masuk adalah admin
if (!isset($_SESSION['id']) || $_SESSION['role'] == 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil username dari session yang dilempar oleh login.php
$nama_panggilan = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSTI Skill Match - Dashboard Mahasiswa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#2E7DED',
                        'brand-light-blue': '#4FA1F9',
                        'brand-dark': '#0B3A82',
                    }
                }
            }
        }
    </script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #2E7DED 0%, #68B4FB 100%);
        }
        .floating-box {
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] font-sans text-gray-800">

    <!-- HERO SECTION BESERTA NAVBAR -->
    <div class="hero-gradient pb-32 relative overflow-hidden">
        
        <!-- NAVBAR -->
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-4 relative z-20">
            <div class="flex justify-between items-center text-white">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-gear text-2xl"></i>
                    <span class="font-bold text-xl tracking-wide">PSTI Skill Match</span>
                </div>
                
                <!-- Menu -->
                <div class="hidden md:flex space-x-6 items-center text-sm font-medium">
                    <a href="dashboard_mahasiswa.php" class="border-b-2 border-white pb-1">Beranda</a>
                    <a href="#" class="hover:text-blue-200 transition">Rekomendasi Minat</a>
                    <a href="#" class="hover:text-blue-200 transition">Kursus & Pelatihan</a>                
                    <a href="profil_mahasiswa/index.php" class="hover:text-blue-200 transition">Profil Saya</a>
                    <a href="profil mahasiswa/index_profil.php" class="hover:text-blue-200 transition">Profil Saya</a>
                    
                    <!-- Sapaan User Mengambil dari $_SESSION['username'] -->
                    <span class="text-blue-100 border-l border-blue-400 pl-6 py-1 capitalize">
                        Halo, <strong><?php echo htmlspecialchars($nama_panggilan); ?>!</strong>
                    </span>

                    <!-- Tombol Logout -->
                    <a href="logout.php" class="bg-white text-blue-600 px-5 py-2 rounded-md font-bold hover:bg-gray-100 transition shadow ml-2">
                        Logout
                    </a>
                </div>
            </div>
        </nav>

        <!-- HERO CONTENT -->
        <div class="max-w-4xl mx-auto text-center mt-12 px-4 relative z-10">
            <h1 class="text-3xl md:text-[40px] leading-tight font-bold text-white mb-6">
                Sistem Rekomendasi Peminatan dan<br>Pengembangan Skill Mahasiswa PSTI
            </h1>
            <p class="text-blue-50 text-lg md:text-xl font-light max-w-2xl mx-auto">
                Temukan minat dan kembangkan keterampilanmu untuk sukses di dunia Teknologi Informasi!
            </p>
        </div>

        <!-- Dekorasi Background -->
        <div class="absolute top-20 left-10 opacity-10 text-8xl z-0"><i class="fa-solid fa-code"></i></div>
        <div class="absolute bottom-10 right-20 opacity-10 text-9xl z-0"><i class="fa-solid fa-laptop-code"></i></div>
    </div>

    <!-- QUICK ACCESS MENU -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">
        <div class="bg-white rounded-xl floating-box flex flex-col md:flex-row divide-y md:divide-y-0 md:divide-x divide-gray-100">
            
            <a href="#" class="flex-1 p-8 flex items-start gap-4 hover:bg-gray-50 transition rounded-l-xl group">
                <div class="text-blue-600 text-4xl mt-1 relative">
                    <i class="fa-regular fa-clipboard"></i>
                    <i class="fa-solid fa-check text-sm absolute bottom-0 right-0 bg-white rounded-full text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg group-hover:text-blue-600 transition">Tes Minat & Bakat</h3>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">Ikuti tes untuk mengetahui minat<br>dan bakatmu.</p>
                </div>
            </a>

            <a href="#" class="flex-1 p-8 flex items-start gap-4 hover:bg-gray-50 transition group">
                <div class="text-yellow-400 text-4xl mt-1 relative">
                    <i class="fa-regular fa-lightbulb"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg group-hover:text-blue-600 transition">Rekomendasi Peminatan</h3>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">Dapatkan saran peminatan yang sesuai<br>dengan profilmu.</p>
                </div>
            </a>

            <a href="#" class="flex-1 p-8 flex items-start gap-4 hover:bg-gray-50 transition rounded-r-xl group">
                <div class="text-blue-600 text-4xl mt-1">
                    <i class="fa-solid fa-display"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg group-hover:text-blue-600 transition">Kursus & Pelatihan</h3>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">Ikuti kursus untuk tingkatkan skill<br>dan kompetensimu.</p>
                </div>
            </a>

        </div>
    </div>

    <!-- REKOMENDASI PEMINATAN UNTUKMU SECTION -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-20">
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-[#0B3A82] mb-1">Rekomendasi Peminatan Untukmu</h2>
            <p class="text-gray-500 text-sm">Berikut adalah peminatan yang cocok untukmu.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col hover:shadow-md transition">
                <h3 class="font-bold text-[#0B3A82] text-lg mb-4">Pengembangan Web</h3>
                <div class="h-40 flex items-center justify-center mb-4 relative">
                    <div class="relative text-blue-500 text-7xl opacity-80">
                         <i class="fa-solid fa-laptop-code"></i>
                         <i class="fa-brands fa-html5 absolute -bottom-2 -left-4 text-3xl text-orange-500"></i>
                         <i class="fa-solid fa-gear absolute -top-2 -right-4 text-3xl text-gray-400"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-6 flex-grow">
                    Pelajari HTML, CSS, JavaScript, dan framework web modern.
                </p>
                <div class="flex justify-end">
                    <a href="#" class="bg-[#1864D3] hover:bg-blue-800 text-white text-sm font-medium py-2 px-4 rounded-md transition flex items-center gap-1">
                        Lihat Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col hover:shadow-md transition">
                <h3 class="font-bold text-[#0B3A82] text-lg mb-4">Analisis Data</h3>
                <div class="h-40 flex items-center justify-center mb-4 relative">
                    <div class="relative text-blue-500 text-7xl opacity-80">
                         <i class="fa-solid fa-chart-column"></i>
                         <i class="fa-solid fa-magnifying-glass absolute -bottom-2 -right-2 text-4xl text-[#0B3A82]"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-6 flex-grow">
                    Kuasai teknik analisis data, visualisasi, dan machine learning.
                </p>
                <div class="flex justify-end">
                    <a href="#" class="bg-[#1864D3] hover:bg-blue-800 text-white text-sm font-medium py-2 px-4 rounded-md transition flex items-center gap-1">
                        Lihat Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col hover:shadow-md transition">
                <h3 class="font-bold text-[#0B3A82] text-lg mb-4">Keamanan Jaringan</h3>
                <div class="h-40 flex items-center justify-center mb-4 relative">
                    <div class="relative text-blue-500 text-7xl opacity-80">
                         <i class="fa-solid fa-shield-halved"></i>
                         <i class="fa-solid fa-lock absolute bottom-0 right-[-10px] text-3xl text-[#0B3A82]"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-6 flex-grow">
                    Belajar tentang keamanan jaringan dan cyber security.
                </p>
                <div class="flex justify-end">
                    <a href="#" class="bg-[#1864D3] hover:bg-blue-800 text-white text-sm font-medium py-2 px-4 rounded-md transition flex items-center gap-1">
                        Lihat Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>