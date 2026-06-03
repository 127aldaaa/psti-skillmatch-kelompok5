<?php
session_start();

// Panggil koneksi database (Sesuaikan path-nya jika perlu)
require_once '../../config/koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

$id_mahasiswa = $_SESSION['id'];

// Query untuk menggabungkan data dari tabel users dan hasil_tes
$query = "SELECT u.nama_lengkap, u.program_studi, u.universitas, 
                 h.status_tes, h.fokus_utama 
          FROM users u 
          LEFT JOIN hasil_tes h ON u.id = h.id_mahasiswa 
          WHERE u.id = '$id_mahasiswa'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Jika data kosong/null, berikan nilai default
$nama_lengkap = $data['nama_lengkap'] ?? 'Mahasiswa';
$prodi        = $data['program_studi'] ?? 'Pendidikan Sistem & Teknologi Informasi';
$univ         = $data['universitas'] ?? 'Universitas Pendidikan Indonesia Purwakarta';
$status_tes   = $data['status_tes'] ?? 'Belum';
$fokus_utama  = $data['fokus_utama'] ?? 'Belum Ditentukan';

// Set warna badge dinamis berdasarkan status tes
$badge_bg   = ($status_tes == 'Selesai') ? 'bg-emerald-100' : 'bg-red-100';
$badge_text = ($status_tes == 'Selesai') ? 'text-emerald-700' : 'text-red-700';
$badge_icon = ($status_tes == 'Selesai') ? 'fa-check' : 'fa-xmark';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: transparent; }
        .card-shadow { box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <div class="bg-white rounded-2xl p-6 border border-slate-200 card-shadow flex flex-col relative overflow-hidden w-full max-w-sm">
        
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 opacity-5 rounded-bl-full pointer-events-none"></div>
        
        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">
            Ringkasan Profil
        </h3>
        
        <div class="flex items-center gap-4 mb-6 relative z-10">
            <div class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center text-2xl font-bold border-4 border-blue-50 shadow-sm shrink-0">
                <?php echo strtoupper(substr($nama_lengkap, 0, 1)); ?>
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-blue-900 capitalize leading-tight">
                    <?php echo htmlspecialchars($nama_lengkap); ?>
                </h2>
                <p class="text-sm font-medium text-blue-500 mt-0.5">
                    <?php echo htmlspecialchars($prodi); ?>
                </p>
                <p class="text-xs text-slate-500 mt-1 flex items-start gap-1">
                    <i class="fa-solid fa-building-columns mt-0.5"></i> 
                    <?php echo htmlspecialchars($univ); ?>
                </p>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-3 mb-6 relative z-10">
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="block text-xs text-slate-400 font-semibold mb-1">Status Tes</span>
                <span class="inline-block <?php echo $badge_bg . ' ' . $badge_text; ?> text-xs font-bold px-2 py-1 rounded-md">
                    <i class="fa-solid <?php echo $badge_icon; ?> mr-1"></i> <?php echo $status_tes; ?>
                </span>
            </div>
            
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="block text-xs text-slate-400 font-semibold mb-1">Fokus Utama</span>
                <span class="text-sm font-bold text-slate-700">
                    <?php echo htmlspecialchars($fokus_utama); ?>
                </span>
            </div>
        </div>
        
        <a href="../profil_mahasiswa/index_profil.php" target="_parent" class="mt-auto block w-full py-2.5 bg-blue-600 text-white text-center font-bold text-sm rounded-xl hover:bg-blue-900 transition-colors shadow-md relative z-10">
            Kelola Profil Lengkap
        </a>
    </div>

</body>
</html>