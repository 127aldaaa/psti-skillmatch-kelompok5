<?php
include '../../config/koneksi.php';

$id_kursus = $_POST['id_kursus'];
$nama = $_POST['nama_mahasiswa'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];

mysqli_query($conn,"
INSERT INTO pendaftaran_kursus
(id_kursus,nama_mahasiswa,nim,kelas)
VALUES
('$id_kursus','$nama','$nim','$kelas')
");

header("Location: kursus_mahasiswa.php");
exit;
?>