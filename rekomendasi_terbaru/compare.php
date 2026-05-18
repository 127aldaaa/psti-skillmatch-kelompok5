<?php
include 'koneksi.php';

$query = mysqli_query($conn,
"SELECT * FROM hasil_tes
ORDER BY tanggal DESC
LIMIT 2");

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}

$baru = $data[0];
$lama = $data[1];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Compare Hasil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4">

        <h2 class="mb-4">
            Compare Hasil Tes
        </h2>

        <table class="table table-bordered text-center">

            <tr class="table-dark">
                <th>Hasil Lama</th>
                <th>Hasil Baru</th>
            </tr>

            <tr>
                <td><?= $lama['rekomendasi']; ?></td>
                <td><?= $baru['rekomendasi']; ?></td>
            </tr>

            <tr>
                <td>Skor : <?= $lama['skor']; ?></td>
                <td>Skor : <?= $baru['skor']; ?></td>
            </tr>

        </table>

        <?php
        if($lama['rekomendasi'] == $baru['rekomendasi']){
            echo "<div class='alert alert-info'>
                    Rekomendasi tidak berubah
                  </div>";
        }else{
            echo "<div class='alert alertsuccess'>
                    Rekomendasi berubah
                  </div>";
        }
        ?>

        <a href="index.php" class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

</body>
</html>
