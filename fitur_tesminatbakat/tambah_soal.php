<?php
include '../config.php';

if(isset($_POST['simpan'])){

    $pertanyaan = $_POST['pertanyaan'];

    $kategori_a = $_POST['kategori_a'];
    $kategori_b = $_POST['kategori_b'];
    $kategori_c = $_POST['kategori_c'];

    $opsi_a = $_POST['opsi_a'];
    $opsi_b = $_POST['opsi_b'];
    $opsi_c = $_POST['opsi_c'];

    $query = mysqli_query($conn, "
        INSERT INTO soal_tes
        (
            pertanyaan,
            opsi_a,
            opsi_b,
            opsi_c,
            kategori_a,
            kategori_b,
            kategori_c
        )

        VALUES
        (
            '$pertanyaan',
            '$opsi_a',
            '$opsi_b',
            '$opsi_c',
            '$kategori_a',
            '$kategori_b',
            '$kategori_c'
        )
    ");

    if($query){

        echo "
        <script>
            alert('Soal berhasil ditambahkan!');
            window.location='data_soal.php';
        </script>
        ";

    } else {

        echo mysqli_error($conn);

    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Soal</title>

<style>

body{
    font-family:Arial;
    background:#dbeafe;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.container{
    width:700px;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

h1{
    text-align:center;
    margin-bottom:25px;
}

input{
    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:20px;
    border:1px solid #8ec5e8;
    border-radius:10px;
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:white;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.btn-kembali{
    display:block;
    text-align:center;
    margin-top:15px;
    background:#e5e7eb;
    color:black;
    padding:12px;
    border-radius:10px;
    text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

    <h1>Tambah Soal Minat & Bakat</h1>

    <form method="POST">

        <label>Pertanyaan</label>
        <input type="text"
               name="pertanyaan"
               required>

        <label>Kategori A</label>
        <input type="text"
               name="kategori_a"
               placeholder="Contoh: Sistem Informasi"
               required>

        <label>Kategori B</label>
        <input type="text"
               name="kategori_b"
               placeholder="Contoh: Engineering"
               required>

        <label>Kategori C</label>
        <input type="text"
               name="kategori_c"
               placeholder="Contoh: Pendidikan"
               required>

        <h3>Opsi Jawaban</h3>

        <label>Opsi A</label>
        <input type="text"
               name="opsi_a"
               value="Sangat tertarik"
               required>

        <label>Opsi B</label>
        <input type="text"
               name="opsi_b"
               value="Tertarik"
               required>

        <label>Opsi C</label>
        <input type="text"
               name="opsi_c"
               value="Kurang tertarik"
               required>

        <button type="submit" name="simpan">
            Simpan Soal
        </button>

        <a href="data_soal.php" class="btn-kembali">
            Kembali
        </a>

    </form>

</div>

</body>
</html>