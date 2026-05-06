<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';

session_start();

// Inisialisasi session admin
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'Admin';
}
$adminName = $_SESSION['user'];

// Tanggal Dummy
$dateRange = "25 Mei - 1 Juni 2025";
?>
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

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e3a8a;
            --secondary: #3b82f6;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --sidebar-w: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo i {
            font-size: 28px;
            color: #93c5fd;
        }

        .logo .title {
            display: block;
            font-weight: 800;
            font-size: 1.15rem;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .logo .subtitle {
            display: block;
            font-size: 0.8rem;
            opacity: 0.8;
            font-weight: 500;
        }

        .sidebar-menu {
            padding: 20px 16px;
            flex: 1;
            overflow-y: auto;
        }

        /* Custom Scrollbar for Sidebar */
        .sidebar-menu::-webkit-scrollbar { width: 6px; }
        .sidebar-menu::-webkit-scrollbar-track { background: transparent; }
        .sidebar-menu::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }

        .menu-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #93c5fd;
            margin: 24px 0 8px 12px;
            font-weight: 700;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255,255,255,0.85);
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .menu-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(4px);
        }

        .menu-item.active {
            background: rgba(255,255,255,0.2);
            color: white;
            font-weight: 600;
            box-shadow: inset 4px 0 0 white;
        }

        .sidebar-footer {
            padding: 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 10px;
            transition: 0.3s;
            justify-content: center;
            font-weight: 600;
        }

        .logout-btn:hover {
            background: var(--danger);
            color: white;
        }

        /* --- Main Wrapper --- */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar --- */
        .navbar {
            height: 76px;
            background: var(--surface);
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .nav-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .nav-date {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 600;
            background: var(--bg);
            padding: 8px 16px;
            border-radius: 20px;
        }

        .nav-notification {
            position: relative;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 1.35rem;
            transition: 0.3s;
        }

        .nav-notification:hover { color: var(--primary); }

        .badge {
            position: absolute;
            top: -4px;
            right: -6px;
            background: var(--danger);
            color: white;
            font-size: 0.65rem;
            font-weight: 800;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid var(--surface);
        }

        /* --- Content Area --- */
        .content-area {
            padding: 32px;
            flex: 1;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-header h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 1rem;
        }

        /* --- Grids & Cards --- */
        .card {
            background: var(--surface);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid var(--border);
            padding: 24px;
            height: 100%;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .btn-sm {
            padding: 8px 14px;
            background: #eff6ff;
            color: var(--primary);
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-sm:hover {
            background: var(--primary);
            color: white;
        }

        /* 1. Stats Grid (6 Cards) */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-title {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
            line-height: 1.3;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .icon-blue { background: #eff6ff; color: var(--primary); }
        .icon-purple { background: #f5f3ff; color: #8b5cf6; }
        .icon-teal { background: #f0fdfa; color: #14b8a6; }
        .icon-orange { background: #fff7ed; color: #f97316; }
        .icon-green { background: #ecfdf5; color: var(--success); }
        .icon-red { background: #fef2f2; color: var(--danger); }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .stat-trend {
            font-size: 0.85rem;
            color: var(--success);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .stat-trend.down { color: var(--danger); }
        .stat-trend.neutral { color: var(--primary); }

        /* Dashboard Main Layout Grids */
        .dashboard-grid-2-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .dashboard-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 24px;
        }

        /* --- Charts Container --- */
        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }

        /* --- Content Stats List --- */
        .content-list {
            list-style: none;
        }
        .content-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }
        .content-list li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .content-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .content-name {
            font-weight: 600;
            color: var(--text-main);
            font-size: 0.95rem;
        }
        .content-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* --- Table Kursus Terpopuler --- */
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        .table th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            font-weight: 700;
            background: var(--bg);
        }
        .table td {
            font-size: 0.9rem;
            color: var(--text-main);
            font-weight: 500;
        }
        .table tr:last-child td { border-bottom: none; }
        .text-warning { color: var(--warning); }
        .badge-status {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-status.active { background: #dcfce3; color: #166534; }

        /* --- Recent Activity --- */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .activity-item {
            display: flex;
            gap: 16px;
        }
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #eff6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .activity-icon.green { background: #ecfdf5; color: var(--success); }
        .activity-icon.purple { background: #f5f3ff; color: #8b5cf6; }
        .activity-content { flex: 1; }
        .activity-text { font-size: 0.9rem; color: var(--text-main); margin-bottom: 6px; line-height: 1.5; }
        .activity-time { font-size: 0.8rem; color: var(--text-muted); font-weight: 500; }

        /* --- Announcements --- */
        .announcement-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .announcement-list li {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }
        .announcement-date {
            background: #eff6ff;
            color: var(--primary);
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            line-height: 1.1;
            flex-shrink: 0;
            border: 1px solid #bfdbfe;
        }
        .announcement-date span { font-weight: 800; font-size: 1.2rem; }
        .announcement-date small { font-size: 0.65rem; text-transform: uppercase; font-weight: 700; }
        .announcement-content .title { font-weight: 700; font-size: 0.95rem; color: var(--text-main); margin-bottom: 6px; }
        .announcement-content .desc { font-size: 0.85rem; color: var(--text-muted); line-height: 1.5; }

        /* --- Quick Access --- */
        .quick-access-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .btn-quick {
            padding: 16px 12px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .btn-quick i {
            font-size: 1.5rem;
            color: var(--primary);
            transition: 0.2s;
        }
        .btn-quick:hover {
            border-color: var(--primary);
            background: #eff6ff;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.1);
        }
        .btn-quick:hover i {
            transform: scale(1.1);
        }

        /* --- Responsive Design --- */
        @media (max-width: 1400px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 1200px) {
            .dashboard-grid-2-1 { grid-template-columns: 1fr; }
            .dashboard-grid-3 { grid-template-columns: 1fr; }
        }
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr; }
            .quick-access-grid { grid-template-columns: 1fr; }
            .nav-date { display: none; }
        }
    </style>
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
            <a href="dashboard/admin.php" class="menu-item active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            
            <div class="menu-label">Manajemen Data</div>
            <a href="#" class="menu-item"><i class="fa-solid fa-bullseye"></i> Data Peminatan</a>
            <a href="../skill/index.php" class="menu-item"><i class="fa-solid fa-code"></i> Data Skill</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-file-lines"></i> Soal Tes Minat & Bakat</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-graduation-cap"></i> Kursus / Pelatihan</a>
            
            <div class="menu-label">Komunikasi</div>
            <a href="#" class="menu-item"><i class="fa-solid fa-bell"></i> Notifikasi / Pengumuman</a>
            
            <div class="menu-label">Lainnya</div>
            <a href="#" class="menu-item"><i class="fa-solid fa-users"></i> Pengguna</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-chart-bar"></i> Laporan</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-gear"></i> Pengaturan</a>
        </div>
        
        <div class="sidebar-footer">
            <a href="../../logout.php" class="logout-btn">
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
                <div class="nav-date">
                    <i class="fa-regular fa-calendar" style="margin-right: 6px;"></i> 
                    <?php echo $dateRange; ?>
                </div>
                <div class="nav-notification">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge">3</span>
                </div>
                <!-- User Avatar -->
                <div style="width: 40px; height: 40px; background: var(--primary-dark); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid #e2e8f0; cursor: pointer;">
                    A
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
            
            <!-- Header Content -->
            <div class="page-header">
                <h1>Selamat datang, <?php echo htmlspecialchars($adminName); ?>! 👋</h1>
                <p>Berikut ringkasan data dan aktivitas sistem PSTI Skill Match.</p>
            </div>

            <!-- 1. Statistik Cards Grid -->
            <div class="stats-grid">
                <!-- Card 1 -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Pengguna</span>
                        <div class="stat-icon icon-blue"><i class="fa-solid fa-users"></i></div>
                    </div>
                    <div class="stat-value">1,245</div>
                    <div class="stat-trend"><i class="fa-solid fa-arrow-up"></i> +12.5%</div>
                </div>
                <!-- Card 2 -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Peminatan</span>
                        <div class="stat-icon icon-purple"><i class="fa-solid fa-bullseye"></i></div>
                    </div>
                    <div class="stat-value">8</div>
                    <div class="stat-trend"><i class="fa-solid fa-arrow-up"></i> +2.0%</div>
                </div>
                <!-- Card 3 -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Skill</span>
                        <div class="stat-icon icon-teal"><i class="fa-solid fa-code"></i></div>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-trend"><i class="fa-solid fa-arrow-up"></i> +8.4%</div>
                </div>
                <!-- Card 4 -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Soal Tes</span>
                        <div class="stat-icon icon-orange"><i class="fa-solid fa-file-lines"></i></div>
                    </div>
                    <div class="stat-value">420</div>
                    <div class="stat-trend"><i class="fa-solid fa-arrow-up"></i> +15.3%</div>
                </div>
                <!-- Card 5 -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Kursus</span>
                        <div class="stat-icon icon-green"><i class="fa-solid fa-graduation-cap"></i></div>
                    </div>
                    <div class="stat-value">48</div>
                    <div class="stat-trend"><i class="fa-solid fa-arrow-up"></i> +5.2%</div>
                </div>
                <!-- Card 6 -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Pengumuman Aktif</span>
                        <div class="stat-icon icon-red"><i class="fa-solid fa-bullhorn"></i></div>
                    </div>
                    <div class="stat-value">3</div>
                    <div class="stat-trend neutral"><i class="fa-solid fa-bolt"></i> Baru</div>
                </div>
            </div>

            <!-- 2. Section Grafik & Statistik Konten -->
            <div class="dashboard-grid-2-1">
                <!-- Grafik Line (Kiri) -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pendaftaran Pengguna</h3>
                        <select class="btn-sm" style="background: var(--bg); color: var(--text-main); border: 1px solid var(--border);">
                            <option>Tahun Ini</option>
                            <option>Bulan Ini</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

                <!-- Grafik Pie (Kanan) -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Distribusi Peminatan</h3>
                        <button class="btn-sm" style="background: transparent; color: var(--text-muted);"><i class="fa-solid fa-ellipsis"></i></button>
                    </div>
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- 3. Section Tengah (Tabel & Statistik Konten) -->
            <div class="dashboard-grid-2-1">
                <!-- Kursus Terpopuler (Kiri) -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kursus Terpopuler</h3>
                        <button class="btn-sm">Lihat Semua</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Kursus</th>
                                    <th>Kategori</th>
                                    <th>Peserta</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Dasar Pemrograman Web</strong></td>
                                    <td>Pengembangan Web</td>
                                    <td>254</td>
                                    <td><span class="text-warning"><i class="fa-solid fa-star"></i> 4.9</span></td>
                                    <td><span class="badge-status active">Aktif</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Pengantar Analisis Data</strong></td>
                                    <td>Analisis Data</td>
                                    <td>182</td>
                                    <td><span class="text-warning"><i class="fa-solid fa-star"></i> 4.8</span></td>
                                    <td><span class="badge-status active">Aktif</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Cybersecurity Foundation</strong></td>
                                    <td>Keamanan Jaringan</td>
                                    <td>145</td>
                                    <td><span class="text-warning"><i class="fa-solid fa-star"></i> 4.7</span></td>
                                    <td><span class="badge-status active">Aktif</span></td>
                                </tr>
                                <tr>
                                    <td><strong>UI/UX Design dengan Figma</strong></td>
                                    <td>Desain UI/UX</td>
                                    <td>130</td>
                                    <td><span class="text-warning"><i class="fa-solid fa-star"></i> 4.8</span></td>
                                    <td><span class="badge-status active">Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Statistik Konten (Kanan) -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statistik Konten</h3>
                    </div>
                    <ul class="content-list">
                        <li>
                            <div class="content-info">
                                <span class="content-name">Peminatan</span>
                                <span class="content-desc">8 Kategori aktif</span>
                            </div>
                            <button class="btn-sm">Lihat Detail</button>
                        </li>
                        <li>
                            <div class="content-info">
                                <span class="content-name">Skill</span>
                                <span class="content-desc">156 Skill terdaftar</span>
                            </div>
                            <button class="btn-sm">Lihat Detail</button>
                        </li>
                        <li>
                            <div class="content-info">
                                <span class="content-name">Soal Tes Minat</span>
                                <span class="content-desc">420 Pertanyaan</span>
                            </div>
                            <button class="btn-sm">Lihat Detail</button>
                        </li>
                        <li>
                            <div class="content-info">
                                <span class="content-name">Kursus / Pelatihan</span>
                                <span class="content-desc">48 Modul tersedia</span>
                            </div>
                            <button class="btn-sm">Lihat Detail</button>
                        </li>
                        <li>
                            <div class="content-info">
                                <span class="content-name">Pengumuman Aktif</span>
                                <span class="content-desc">3 Pengumuman aktif</span>
                            </div>
                            <button class="btn-sm">Lihat Detail</button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 4. Section Bawah -->
            <div class="dashboard-grid-3">
                <!-- Aktivitas Terbaru -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aktivitas Terbaru</h3>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fa-solid fa-user-plus"></i></div>
                            <div class="activity-content">
                                <p class="activity-text"><strong>Budi Santoso</strong> mendaftar sebagai pengguna baru.</p>
                                <span class="activity-time">5 menit yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon green"><i class="fa-solid fa-check-to-slot"></i></div>
                            <div class="activity-content">
                                <p class="activity-text"><strong>Siti Aminah</strong> menyelesaikan tes minat dan bakat.</p>
                                <span class="activity-time">2 jam yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon purple"><i class="fa-solid fa-laptop-code"></i></div>
                            <div class="activity-content">
                                <p class="activity-text"><strong>Andi Wijaya</strong> menyelesaikan kursus "Dasar Pemrograman Web".</p>
                                <span class="activity-time">5 jam yang lalu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengumuman Terbaru -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengumuman Terbaru</h3>
                    </div>
                    <ul class="announcement-list">
                        <li>
                            <div class="announcement-date"><span>28</span><small>Mei</small></div>
                            <div class="announcement-content">
                                <div class="title">Update Sistem Rekomendasi</div>
                                <div class="desc">Algoritma rekomendasi diperbarui untuk akurasi yang lebih baik.</div>
                            </div>
                        </li>
                        <li>
                            <div class="announcement-date"><span>25</span><small>Mei</small></div>
                            <div class="announcement-content">
                                <div class="title">Jadwal Maintenance</div>
                                <div class="desc">Server akan offline pada 1 Juni 2025 pkl 02:00 WIB.</div>
                            </div>
                        </li>
                        <li>
                            <div class="announcement-date"><span>20</span><small>Mei</small></div>
                            <div class="announcement-content">
                                <div class="title">Kursus Baru Dirilis</div>
                                <div class="desc">5 Modul baru untuk Analisis Data telah ditambahkan.</div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Quick Access -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Access</h3>
                    </div>
                    <div class="quick-access-grid">
                        <div class="btn-quick">
                            <i class="fa-solid fa-bullseye"></i>
                            <span>Kelola Peminatan</span>
                        </div>
                        <div class="btn-quick">
                            <i class="fa-solid fa-code"></i>
                            <span>Kelola Skill</span>
                        </div>
                        <div class="btn-quick">
                            <i class="fa-solid fa-file-lines"></i>
                            <span>Kelola Soal Tes</span>
                        </div>
                        <div class="btn-quick">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span>Kelola Kursus</span>
                        </div>
                        <div class="btn-quick">
                            <i class="fa-solid fa-bullhorn"></i>
                            <span>Kelola Pengumuman</span>
                        </div>
                        <div class="btn-quick">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span>Laporan Sistem</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Chart.js -->
    <script>
        // Set Default Font
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = "#64748b";

        // Line Chart (Pendaftaran Pengguna)
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        
        // Create Gradient for Line Chart
        let gradient = lineCtx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pengguna Baru',
                    data: [65, 85, 120, 150, 180, 210],
                    borderColor: '#2563eb',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 13 },
                        displayColors: false
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#f1f5f9', drawBorder: false }
                    },
                    x: {
                        grid: { display: false, drawBorder: false }
                    }
                }
            }
        });

        // Pie/Doughnut Chart (Distribusi Peminatan)
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Web Dev', 'Data Analysis', 'Cybersecurity', 'AI / ML'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                },
                cutout: '75%',
                layout: {
                    padding: { top: 10, bottom: 10 }
                }
            }
        });
    </script>
</body>
</html>
