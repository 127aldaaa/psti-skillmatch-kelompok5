<?php
session_start();
include '../config.php';

$id_user = $_SESSION['id'];
$nama    = $_SESSION['username'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM riwayat_tes
     WHERE id_user='$id_user'
     ORDER BY tanggal_tes DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Tes</title>

    <link rel="stylesheet" href="riwayat.css?v=2">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Riwayat Tes Minat & Bakat</h1>

        <p class="desc">
            Halo, <b><?= $nama; ?></b> 👋 <br>
            Berikut hasil tes yang pernah Anda lakukan
        </p>

        <table>

            <tr>
                <th>Hasil Peminatan</th>
                <th>Tanggal Tes</th>
            </tr>

            <?php if(mysqli_num_rows($data) > 0) : ?>

                <?php while($d = mysqli_fetch_assoc($data)) : ?>

                <tr>

                    <td>
                        <span class="badge">
                            <?= $d['hasil_peminatan']; ?>
                        </span>
                    </td>

                    <td>
                        <?= date('d M Y - H:i', strtotime($d['tanggal_tes'])); ?>
                    </td>

                </tr>

                <?php endwhile; ?>

            <?php else : ?>

                <tr>

                    <td colspan="2">
                        Belum ada riwayat tes
                    </td>

                </tr>

            <?php endif; ?>

        </table>
        <a href="../dashboard_mahasiswa/dashboard_mahasiswa.php" class="btn-kembali">
    ← Kembali ke Dashboard
</a>

    </div>

</div>

</body>
</html>