<?php
include 'koneksi.php';

$query = mysqli_query($conn,
"SELECT * FROM hasil_tes
ORDER BY tanggal DESC
LIMIT 1");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rekomendasi Terbaru</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4 text-center">

        <h2 class="mb-4">
            Rekomendasi Terbaru
        </h2>

        <h1 class="text-success">
            <?= $data['rekomendasi']; ?>
        </h1>

        <p class="mt-3">
            Skor : <?= $data['skor']; ?>
        </p>

        <p>
            Tanggal : <?= $data['tanggal']; ?>
        </p>

        <a href="index.php" class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

</body>
</html>