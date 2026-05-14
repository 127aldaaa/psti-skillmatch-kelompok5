<?php
require_once '../../config/config.php';
require_once '../../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM courses WHERE id=$id");
$d = mysqli_fetch_array($data);

if (isset($_POST['submit'])) {
    mysqli_query($conn, "UPDATE courses SET
        judul='$_POST[judul]',
        deskripsi='$_POST[deskripsi]',
        durasi='$_POST[durasi]',
        kategori='$_POST[kategori]'
        WHERE id=$id");

    header("Location: kursus.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Kursus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h3>Edit Kursus</h3>

<form method="POST">
    <input type="text" name="judul" value="<?= $d['judul'] ?>" class="form-control mb-2">
    <textarea name="deskripsi" class="form-control mb-2"><?= $d['deskripsi'] ?></textarea>
    <input type="text" name="durasi" value="<?= $d['durasi'] ?>" class="form-control mb-2">
    <input type="text" name="kategori" value="<?= $d['kategori'] ?>" class="form-control mb-2">
    
    <button name="submit" class="btn btn-primary">Update</button>
    <a href="kursus.php" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>