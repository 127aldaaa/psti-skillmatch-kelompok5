<?php
include '../config.php';

$data = mysqli_query($conn, "SELECT * FROM soal_tes");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tes Minat dan Bakat</title>

    <link rel="stylesheet" href="style.css?v=2">
</head>

<body>

<div class="container">

    <div class="form-box">

        <h1 class="title">
            Tes Minat dan Bakat
        </h1>

        <p class="desc">
            Jawab pertanyaan sesuai dengan minat dan kemampuan Anda.
        </p>

        <form action="proses_tes.php" method="POST">

        <?php
        $no = 1;

        while($d = mysqli_fetch_array($data)){
        ?>

        <div class="soal">

            <h3>
                <?= $no++ ?>.
                <?= $d['pertanyaan']; ?>
            </h3>

            <label class="opsi">
                <input type="radio"
                       name="jawaban[<?= $d['id_soal']; ?>]"
                       value="A"
                       required>

                <?= $d['opsi_a']; ?>
            </label>

            <label class="opsi">
                <input type="radio"
                       name="jawaban[<?= $d['id_soal']; ?>]"
                       value="B">

                <?= $d['opsi_b']; ?>
            </label>

            <label class="opsi">
                <input type="radio"
                       name="jawaban[<?= $d['id_soal']; ?>]"
                       value="C">

                <?= $d['opsi_c']; ?>
            </label>

        </div>

        <?php } ?>

        <button type="submit">
            Submit Tes
        </button>

        </form>

        <div class="aksi">
    <a href="../dashboard_mahasiswa/dashboard_mahasiswa.php" class="btn-kembali">
        ← Kembali ke Dashboard
    </a>
</div>

    </div>

</div>

</body>
</html>