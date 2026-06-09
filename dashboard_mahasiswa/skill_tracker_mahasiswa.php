<?php
require_once '../config/config.php';

// Halaman placeholder untuk Skill Tracker Mahasiswa
// Saat ini hanya mencegah mahasiswa mengakses halaman admin.
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Skill Tracker Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 text-center">
        <h2>Skill Tracker Mahasiswa</h2>
        <p class="text-muted">Halaman ini khusus untuk mahasiswa mengelola log skill mereka.</p>
        <div class="alert alert-info">
            Fitur CRUD Skill Tracker untuk mahasiswa sedang dalam pengembangan.
        </div>
        <a href="dashboard_mahasiswa.php" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
    </div>
</body>
</html>
