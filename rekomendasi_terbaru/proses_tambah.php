<?php

include 'koneksi.php';

$skor = $_POST['skor'];
$rekomendasi = $_POST['rekomendasi'];

mysqli_query($conn,
"INSERT INTO hasil_tes(user_id, skor, rekomendasi)
VALUES
(1, '$skor', '$rekomendasi')");

header("Location: history.php");

?>