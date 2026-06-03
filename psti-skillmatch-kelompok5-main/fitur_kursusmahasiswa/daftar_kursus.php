<?php
include '../../config/koneksi.php';

$id_kursus = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Pendaftaran Kursus</title>

<style>
body{
    margin:0;
    background:#f1f1f1;
    font-family:Arial,sans-serif;
}

.header{
    background:#2f63dd;
    color:white;
    text-align:center;
    padding:30px;
    font-size:40px;
    font-weight:bold;
}

.form-box{
    width:500px;
    margin:50px auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.form-box h2{
    text-align:center;
    margin-bottom:25px;
    color:#2f63dd;
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:10px;
}

button{
    width:100%;
    background:#2f63dd;
    color:white;
    border:none;
    padding:14px;
    border-radius:10px;
    font-size:18px;
    cursor:pointer;
}

button:hover{
    background:#1f4fc2;
}
</style>

</head>
<body>

<div class="header">
    Pendaftaran Kursus
</div>

<div class="form-box">

    <h2>Isi Data Pendaftaran</h2>

    <form action="simpan_pendaftaran.php" method="POST">

        <input type="hidden" name="id_kursus" value="<?= $id_kursus ?>">

        <div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" required>
        </div>

        <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" required>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" required>
        </div>

        <button type="submit">
            Konfirmasi Pendaftaran
        </button>

    </form>

</div>

</body>
</html>