<?php
require_once '../../config/config.php';
require_once '../../config/koneksi.php';

if (isset($_POST['submit'])) {
    mysqli_query($conn, "INSERT INTO courses (judul, deskripsi, durasi, kategori)
    VALUES ('$_POST[judul]', '$_POST[deskripsi]', '$_POST[durasi]', '$_POST[kategori]')");

    header("Location: kursus.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Kursus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h3>Tambah Kursus</h3>

<form method="POST">
    <input type="text" name="judul" class="form-control mb-2" placeholder="Judul" required>
    <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>
    <input type="text" name="durasi" class="form-control mb-2" placeholder="Durasi">
    <input type="text" name="kategori" class="form-control mb-2" placeholder="Kategori">
    
    <button name="submit" class="btn btn-success">Simpan</button>
    <a href="kursus.php" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>