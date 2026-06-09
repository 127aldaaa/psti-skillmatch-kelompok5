<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PSTI Skill Match</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo url('assets/css/admin.css'); ?>">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fa-solid fa-layer-group"></i>
                <div>
                    <span class="title">PSTI Skill Match</span>
                    <span class="subtitle">Admin Dashboard</span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <a href="../../views/dashboard/admin.php" class="menu-item active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            
            <div class="menu-label">Manajemen Data</div>
            <a href="../../manajemen data peminatan/index.php" class="menu-item"><i class="fa-solid fa-bullseye"></i> Data Peminatan</a>
            <a href="../../views/skill/index.php" class="menu-item"><i class="fa-solid fa-code"></i> Data Skill</a>
            <a href="../../views/rekomendasi/index.php" class="menu-item"><i class="fa-solid fa-star"></i> Rekomendasi Skill</a>
            <a href="../../views/skill_tracker/index.php" class="menu-item"><i class="fa-solid fa-chart-line"></i> Manajemen Skill Tracker</a>
            <a href="../../views/progress_skill_tracker/index.php" class="menu-item"><i class="fa-solid fa-spinner"></i> Manajemen Progress Skill</a>
            <a href="../../fitur_tesminatbakat/data_soal.php" class="menu-item"><i class="fa-solid fa-file-lines"></i> Soal Tes Minat & Bakat</a>
            <a href="../../views/manajemen_kursuspelatihan/kursus.php" class="menu-item"><i class="fa-solid fa-graduation-cap"></i> Kursus / Pelatihan</a>
            
            <div class="menu-label">Komunikasi</div>
            <a href="../../notifikasi_pengumuman/notifikasi.php" class="menu-item"><i class="fa-solid fa-bell"></i> Notifikasi / Pengumuman</a>
            
            <div class="menu-label">Lainnya</div>
            <a href="#" class="menu-item"><i class="fa-solid fa-users"></i> Pengguna</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-chart-bar"></i> Laporan</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-gear"></i> Pengaturan</a>
        </div>
        
        <div class="sidebar-footer">
            <a href="#" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        
        <!-- Navbar -->
        <nav class="navbar">
            <div class="nav-title">Dashboard</div>
            <div class="nav-right">
                <div class="nav-date"><i class="fa-regular fa-calendar" style="margin-right: 6px;"></i> <?php echo getDummyDateRange(); ?></div>
                <div class="nav-notification">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge">3</span>
                </div>
                <div style="width: 40px; height: 40px; background: var(--primary-dark); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid #e2e8f0; cursor: pointer;">
                    <?php echo isset($_SESSION['user']) ? substr($_SESSION['user'], 0, 1) : 'A'; ?>
                </div>
            </div>
        </nav>
