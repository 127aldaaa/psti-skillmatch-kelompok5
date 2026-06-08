<?php
// 1. Wajib jalankan session di paling atas agar bisa mengambil data dari proses_tes.php
session_start();


$rekomendasi = $_SESSION['rekomendasi'] ?? "Belum ada hasil rekomendasi. Silakan ikuti tes terlebih dahulu.";
$skorA       = $_SESSION['skorA'] ?? 0;
$skorB       = $_SESSION['skorB'] ?? 0;
$skorC       = $_SESSION['skorC'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Rekomendasi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="card">

        <h1> Hasil Rekomendasi Peminatan</h1>

        <div class="rekomendasi">
            <?= htmlspecialchars($rekomendasi) ?>
        </div>

        <div class="skor">
            <p>📊 Skor A: <?= htmlspecialchars($skorA) ?></p>
            <p>📊 Skor B: <?= htmlspecialchars($skorB) ?></p>
            <p>📊 Skor C: <?= htmlspecialchars($skorC) ?></p>
        </div>

        <a href="../riwayat.php" class="btn secondary">Lihat Riwayat</a>
        <a href="../fitur_tesminat/tes.php" class="btn secondary">Ulangi Tes</a>

    </div>

</div>

</body>
</html>