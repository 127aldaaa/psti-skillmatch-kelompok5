<?php include '../../config/koneksi.php'; ?>

<h2>Daftar Kursus</h2>

<?php
$data = mysqli_query($conn, "SELECT * FROM courses");

while($d = mysqli_fetch_array($data)){
?>

<div style="border:1px solid #ccc; padding:15px; margin:10px;">
    <h3><?= $d['judul']; ?></h3>
    <p><?= $d['deskripsi']; ?></p>
    <p>Kategori: <?= $d['kategori']; ?></p>

    <button>Daftar Kursus</button>
</div>

<?php } ?>