<?php
include 'koneksi.php';

$query = mysqli_query($conn,
"SELECT * FROM hasil_tes
ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Tes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4">

        <h2 class="mb-4">
            Riwayat Tes Mahasiswa
        </h2>

        <table class="table table-bordered table-striped">

            <tr>
                <th>Tanggal</th>
                <th>Skor</th>
                <th>Rekomendasi</th>
            </tr>

            <?php
            while($data = mysqli_fetch_assoc($query)){
            ?>

            <tr>
                <td><?= $data['tanggal']; ?></td>
                <td><?= $data['skor']; ?></td>
                <td><?= $data['rekomendasi']; ?></td>
            </tr>

            <?php } ?>

        </table>

        <a href="index.php" class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

</body>
</html>