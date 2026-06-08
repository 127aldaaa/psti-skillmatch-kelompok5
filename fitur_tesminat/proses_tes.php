<?php
include '../config.php';

$jawaban = $_POST['jawaban'];

$hasil = [];

foreach($jawaban as $id_soal => $pilihan){

    $query = mysqli_query(
        $conn,
        "SELECT * FROM soal_tes WHERE id_soal='$id_soal'"
    );

    $data = mysqli_fetch_array($query);

    // menentukan kategori dan skor
    if($pilihan == "A"){

        $kategori = $data['kategori_a'];
        $skor = 3;

    } elseif($pilihan == "B"){

        $kategori = $data['kategori_b'];
        $skor = 2;

    } elseif($pilihan == "C"){

        $kategori = $data['kategori_c'];
        $skor = 1;

    }

    // menghitung skor kategori
    if(isset($hasil[$kategori])){

        $hasil[$kategori] += $skor;

    } else {

        $hasil[$kategori] = $skor;

    }

}

// urutkan skor terbesar
arsort($hasil);

// ambil hasil tertinggi
$rekomendasi = array_key_first($hasil);

$nama = "Mahasiswa"; // sementara

mysqli_query(
    $conn,
    "INSERT INTO riwayat_tes
    (nama_mahasiswa, hasil_peminatan)
    VALUES
    ('$nama', '$rekomendasi')"
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Tes</title>

    <link rel="stylesheet" href="hasil.css?v=2">
</head>

<body>

<div class="hasil-container">

    <div class="hasil-box">

        <h1>Hasil Tes Minat dan Kemampuan</h1>

        <p class="deskripsi">
            Berdasarkan jawaban yang Anda pilih,
            kecenderungan peminatan Anda adalah:
        </p>

        <div class="hasil">
            <?= $rekomendasi; ?>
        </div>

        <a href="tes.php" class="btn">
            Kembali ke Tes
        </a>

    </div>

</div>

</body>
</html>