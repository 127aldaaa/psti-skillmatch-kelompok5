<?php
// dashboard_mahasiswa.php
session_start();

// ---------------------------------------------------------
// FITUR ANTI-CACHE: Memaksa browser memuat tampilan terbaru
// ---------------------------------------------------------
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// PROTEKSI HALAMAN: 
// Karena file ini sekarang sejajar dengan login.php, kita tidak perlu pakai ../
if (!isset($_SESSION['id']) || $_SESSION['role'] == 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil username dari session
$nama_panggilan = isset($_SESSION['username']) ? $_SESSION['username'] : 'Alda';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Meta tags Anti-Cache untuk HTML -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>PSTI Skill Match - Dashboard Mahasiswa</title>
    
    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS & Chart.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        'admin-blue': '#2563eb',      
                        'admin-dark': '#1e3a8a',      
                        'admin-secondary': '#3b82f6', 
                        'surface': '#ffffff',
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #f8fafc; }
        .hero-admin-gradient { background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); }
        .floating-box { box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08); }
        .card-shadow { box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); }
        .bg-icon-decor { pointer-events: none; user-select: none; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="font-sans text-slate-800 antialiased">

    <!-- HERO SECTION & TOP NAVBAR -->
    <div class="hero-admin-gradient pb-32 relative overflow-hidden">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-4 relative z-50">
            <div class="flex justify-between items-center text-white">
                <div class="flex items-center gap-3">
                    <div class="bg-white/10 p-2 rounded-lg backdrop-blur-md border border-white/20">
                        <i class="fa-solid fa-layer-group text-xl text-blue-100"></i>
                    </div>
                    <span class="font-bold text-xl tracking-wide">PSTI Skill Match</span>
                </div>
                
                <div class="hidden md:flex space-x-8 items-center text-sm font-medium">
                    <a href="dashboard_mahasiswa.php" class="border-b-2 border-white pb-1">Beranda</a>
                    <a href="#" class="hover:text-blue-200 transition">Rekomendasi</a>
                    <a href="/psti-skillmatch-kelompok5-main/fitur_kursusmahasiswa/kursus_mahasiswa.php" class="hover:text-blue-200 transition">Kursus</a>                    
                    <!-- FITUR: LINK MENUJU PROFIL (Menggunakan rute folder langsung) -->
                    <a href="profil%20mahasiswa/index_profil.php" class="hover:text-blue-200 transition font-bold bg-white/10 px-4 py-2 rounded-full border border-white/30 hover:bg-white/20">Profil Mahasiswa</a>
                    
                    <div class="flex items-center gap-3 pl-6 border-l border-white/20">
                        <div class="text-right">
                            <div class="text-sm font-bold capitalize"><?php echo htmlspecialchars($nama_panggilan); ?></div>
                        </div>
                        <!-- FITUR: LOGOUT (Sudah sejajar, tidak perlu ../) -->
                        <a href="logout.php" class="w-9 h-9 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center transition-colors shadow-lg" title="Logout">
                            <i class="fa-solid fa-right-from-bracket text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-3xl md:text-4xl leading-tight font-extrabold text-white mb-3">
                Dashboard Pembelajaran,<br>Siap tingkatkan skillmu, <?php echo htmlspecialchars($nama_panggilan); ?>? 🚀
            </h1>
            <p class="text-blue-100 text-lg font-light mb-8 max-w-2xl">
                Lacak kemajuanmu, ikuti rekomendasi terbaru, dan persiapkan karir impianmu di bidang Sistem dan Teknologi Informasi.
            </p>
        </div>
        
        <div class="bg-icon-decor absolute top-10 right-20 opacity-10 text-9xl z-0"><i class="fa-solid fa-chart-pie"></i></div>
        <div class="bg-icon-decor absolute -bottom-10 left-10 opacity-10 text-9xl z-0"><i class="fa-solid fa-laptop-code"></i></div>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 mb-24">
        
        <!-- FITUR: QUICK ACCESS -->
        <div class="bg-surface rounded-2xl floating-box flex flex-col md:flex-row divide-y md:divide-y-0 md:divide-x divide-slate-100 mb-8 border border-slate-200">
            <a href="#" class="flex-1 p-6 flex items-center gap-4 hover:bg-blue-50/50 transition rounded-l-2xl group">
                <div class="w-12 h-12 rounded-full bg-blue-100 text-admin-blue flex items-center justify-center text-xl group-hover:scale-110 transition-transform"><i class="fa-regular fa-clipboard"></i></div>
                <div>
                    <h3 class="font-bold text-slate-800 text-base group-hover:text-admin-blue transition">Tes Minat & Bakat</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Evaluasi potensimu</p>
                </div>
            </a>
            <a href="#" class="flex-1 p-6 flex items-center gap-4 hover:bg-blue-50/50 transition group">
                <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl group-hover:scale-110 transition-transform"><i class="fa-solid fa-bullseye"></i></div>
                <div>
                    <h3 class="font-bold text-slate-800 text-base group-hover:text-admin-blue transition">Rekomendasi Peminatan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Lihat hasil analisis</p>
                </div>
            </a>
            <a href="#" class="flex-1 p-6 flex items-center gap-4 hover:bg-blue-50/50 transition group">
                <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xl group-hover:scale-110 transition-transform"><i class="fa-solid fa-laptop-file"></i></div>
                <div>
                    <h3 class="font-bold text-slate-800 text-base group-hover:text-admin-blue transition">Katalog Kursus</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Mulai pelatihan</p>
                </div>
            </a>
            <a href="profil%20mahasiswa/index_profil.php" class="flex-1 p-6 flex items-center gap-4 hover:bg-blue-50/50 transition rounded-r-2xl group">
                <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center text-xl group-hover:scale-110 transition-transform"><i class="fa-regular fa-user"></i></div>
                <div>
                    <h3 class="font-bold text-slate-800 text-base group-hover:text-admin-blue transition">Profile Mahasiswa</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola data dirimu</p>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- FITUR: RINGKASAN PROFIL -->
            <div class="bg-surface rounded-2xl p-6 border border-slate-200 card-shadow flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-admin-blue opacity-5 rounded-bl-full"></div>
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Ringkasan Profil</h3>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-full bg-admin-blue text-white flex items-center justify-center text-2xl font-bold border-4 border-blue-50 shadow-sm">
                        <?php echo strtoupper(substr($nama_panggilan, 0, 1)); ?>
                    </div>
                    <div>
                        <h2 class="text-xl font-extrabold text-admin-dark capitalize"><?php echo htmlspecialchars($nama_panggilan); ?></h2>
                        <p class="text-sm font-medium text-admin-secondary">Pendidikan Sistem & Teknologi Informasi</p>
                        <p class="text-xs text-slate-500 mt-1"><i class="fa-solid fa-building-columns mr-1"></i> Universitas Pendidikan Indonesia</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="block text-xs text-slate-400 font-semibold mb-1">Status Tes</span>
                        <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-1 rounded-md"><i class="fa-solid fa-check mr-1"></i> Selesai</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="block text-xs text-slate-400 font-semibold mb-1">Fokus Utama</span>
                        <span class="text-sm font-bold text-slate-700">Web Development</span>
                    </div>
                </div>
                
                <a href="profil%20mahasiswa/index_profil.php" class="mt-auto block w-full py-2.5 bg-admin-blue text-white text-center font-bold text-sm rounded-xl hover:bg-admin-dark transition-colors shadow-md">Lihat Profil Lengkap</a>
            </div>

            <!-- FITUR: STATISTIK HASIL TEST -->
            <div class="bg-surface rounded-2xl p-6 border border-slate-200 card-shadow">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-2 border-b border-slate-100 pb-2">Statistik Hasil Test</h3>
                <div class="h-[220px] w-full flex justify-center items-center mt-2">
                    <canvas id="radarTestChart"></canvas>
                </div>
            </div>

            <!-- FITUR: PROGRESS SKILL TRACKER -->
            <div class="bg-surface rounded-2xl p-6 border border-slate-200 card-shadow flex flex-col">
                <div class="flex justify-between items-end mb-4 border-b border-slate-100 pb-2">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider">Progress Skill</h3>
                    <span class="text-xs font-bold text-admin-blue bg-blue-50 px-2 py-1 rounded-md">12 Skill Aktif</span>
                </div>
                
                <div class="space-y-4 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                    <div>
                        <div class="flex justify-between text-sm mb-1.5"><span class="font-semibold text-slate-700"><i class="fa-brands fa-laravel text-red-500 mr-2"></i>Laravel Framework</span><span class="font-bold text-admin-blue">75%</span></div>
                        <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-admin-blue h-2 rounded-full" style="width: 75%"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1.5"><span class="font-semibold text-slate-700"><i class="fa-brands fa-html5 text-orange-500 mr-2"></i>Front-End (HTML/CSS)</span><span class="font-bold text-emerald-500">90%</span></div>
                        <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-emerald-500 h-2 rounded-full" style="width: 90%"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1.5"><span class="font-semibold text-slate-700"><i class="fa-brands fa-figma text-purple-500 mr-2"></i>UI/UX Design</span><span class="font-bold text-admin-secondary">60%</span></div>
                        <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-admin-secondary h-2 rounded-full" style="width: 60%"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-extrabold text-admin-dark mb-4 border-l-4 border-admin-blue pl-3">Rekomendasi Terbaru Untukmu</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- FITUR: REKOMENDASI PEMINATAN -->
                <div class="bg-surface rounded-2xl p-6 border border-slate-200 card-shadow flex gap-5 items-center hover:border-admin-blue transition-colors group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 text-admin-blue flex items-center justify-center text-3xl shrink-0 group-hover:scale-105 transition-transform"><i class="fa-solid fa-code"></i></div>
                    <div class="flex-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-admin-secondary bg-blue-50 px-2 py-1 rounded mb-1.5 inline-block">Rekomendasi Peminatan</span>
                        <h3 class="text-lg font-bold text-slate-800">Software Engineering</h3>
                        <p class="text-sm text-slate-500 mt-1">Sangat cocok dengan skor logika dan minat analisismu yang tinggi (88%).</p>
                    </div>
                </div>

                <!-- FITUR: REKOMENDASI SKILL -->
                <div class="bg-surface rounded-2xl p-6 border border-slate-200 card-shadow flex gap-5 items-center hover:border-admin-blue transition-colors group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600 flex items-center justify-center text-3xl shrink-0 group-hover:scale-105 transition-transform"><i class="fa-brands fa-php"></i></div>
                    <div class="flex-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2 py-1 rounded mb-1.5 inline-block">Rekomendasi Skill</span>
                        <h3 class="text-lg font-bold text-slate-800">Advanced PHP & Rest API</h3>
                        <p class="text-sm text-slate-500 mt-1">Skill lanjutan yang direkomendasikan setelah menguasai dasar framework.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- FITUR: KURSUS DAN PELATIHAN -->
            <div class="bg-surface rounded-2xl border border-slate-200 card-shadow overflow-hidden lg:col-span-2 flex flex-col">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider">Rekomendasi Kursus & Pelatihan</h3>
                    <a href="#" class="text-xs font-bold text-admin-blue hover:underline">Lihat Katalog</a>
                </div>
                <div class="overflow-x-auto p-2">
                    <table class="w-full text-left">
                        <thead class="text-xs text-slate-400 uppercase bg-surface border-b border-slate-100">
                            <tr>
                                <th class="py-3 px-4">Nama Modul</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr class="hover:bg-slate-50 border-b border-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-800"><i class="fa-brands fa-laravel text-red-500 mr-2 text-lg align-middle"></i> MVC Concept in Laravel</td>
                                <td class="py-3 px-4 text-slate-500">Web Dev</td>
                                <td class="py-3 px-4 text-right"><button class="bg-white border border-slate-200 hover:border-admin-blue text-admin-blue px-3 py-1.5 rounded-lg font-semibold text-xs shadow-sm transition-all">Enroll</button></td>
                            </tr>
                            <tr class="hover:bg-slate-50 border-b border-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-800"><i class="fa-solid fa-wand-magic-sparkles text-purple-500 mr-2 text-lg align-middle"></i> Glassmorphism UI Design</td>
                                <td class="py-3 px-4 text-slate-500">UI/UX</td>
                                <td class="py-3 px-4 text-right"><button class="bg-white border border-slate-200 hover:border-admin-blue text-admin-blue px-3 py-1.5 rounded-lg font-semibold text-xs shadow-sm transition-all">Enroll</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- FITUR: PENGUMUMAN DAN NOTIFIKASI -->
            <div class="bg-surface rounded-2xl p-6 border border-slate-200 card-shadow flex flex-col">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Pengumuman & Notifikasi</h3>
                <div class="space-y-4 flex-1">
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-admin-blue flex items-center justify-center shrink-0 border border-blue-100"><i class="fa-solid fa-bullhorn text-sm"></i></div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 hover:text-admin-blue cursor-pointer">Jadwal Mentoring HIMA</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Pertemuan divisi internal dijadwalkan ulang besok siang.</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100"><i class="fa-solid fa-check-double text-sm"></i></div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 hover:text-admin-blue cursor-pointer">Sertifikat Tersedia</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Sertifikat kursus "Dasar HTML/CSS" sudah bisa diunduh.</p>
                        </div>
                    </div>
                </div>
                <button class="w-full mt-4 py-2 bg-slate-50 border border-slate-200 text-admin-dark font-bold text-xs rounded-lg hover:bg-slate-100 transition-colors">Lihat Semua</button>
            </div>
        </div>
        
        <!-- FITUR: SKILL TRACKER DETAIL -->
        <div class="mt-8 bg-surface rounded-2xl p-6 border border-slate-200 card-shadow">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Skill Tracker Detail</h3>
            <div class="flex flex-wrap gap-3">
                <span class="px-3 py-1.5 border border-slate-200 rounded-lg text-sm font-semibold text-slate-700 bg-slate-50 flex items-center gap-2"><i class="fa-brands fa-html5 text-orange-500"></i> HTML5</span>
                <span class="px-3 py-1.5 border border-slate-200 rounded-lg text-sm font-semibold text-slate-700 bg-slate-50 flex items-center gap-2"><i class="fa-brands fa-css3-alt text-blue-500"></i> CSS3</span>
                <span class="px-3 py-1.5 border border-slate-200 rounded-lg text-sm font-semibold text-slate-700 bg-slate-50 flex items-center gap-2"><i class="fa-brands fa-js text-yellow-500"></i> JavaScript</span>
                <span class="px-3 py-1.5 border border-admin-blue rounded-lg text-sm font-semibold text-admin-blue bg-blue-50 flex items-center gap-2 shadow-sm"><i class="fa-brands fa-laravel text-red-500"></i> Laravel</span>
                <span class="px-3 py-1.5 border border-admin-blue rounded-lg text-sm font-semibold text-admin-blue bg-blue-50 flex items-center gap-2 shadow-sm"><i class="fa-brands fa-figma text-purple-500"></i> Figma UI/UX</span>
                <button class="px-3 py-1.5 border border-dashed border-slate-300 rounded-lg text-sm font-bold text-slate-400 hover:border-admin-blue hover:text-admin-blue transition-colors flex items-center gap-2"><i class="fa-solid fa-plus"></i> Tambah Log Skill</button>
            </div>
        </div>

    </main>

    <script>
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = "#64748b";

        const radarCtx = document.getElementById('radarTestChart').getContext('2d');
        new Chart(radarCtx, {
            type: 'radar',
            data: {
                labels: ['Logika', 'Kreativitas', 'Analisis Data', 'Manajemen', 'Problem Solving', 'Komunikasi'],
                datasets: [{
                    label: 'Skor Tes Minat Terakhir',
                    data: [88, 75, 60, 80, 85, 70],
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    borderColor: '#2563eb',
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointHoverBackgroundColor: '#2563eb',
                    pointHoverBorderColor: '#ffffff',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { color: '#f1f5f9' },
                        grid: { color: '#f1f5f9' },
                        pointLabels: { font: { size: 11, weight: '600' }, color: '#475569' },
                        ticks: { display: false, min: 0, max: 100 }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e3a8a',
                        padding: 10,
                        titleFont: { size: 12 },
                        bodyFont: { size: 13, weight: 'bold' },
                        displayColors: false
                    }
                }
            }
        });
    </script>
</body>
</html>