<?php
include '../config.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM soal_tes WHERE id_soal='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Konfirmasi Hapus</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#60a5fa,#2563eb);
}

.card{
    background:white;
    width:420px;
    padding:30px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,0.2);
    animation:pop 0.3s ease;
}

@keyframes pop{
    from{transform:scale(0.8); opacity:0;}
    to{transform:scale(1); opacity:1;}
}

.icon{
    font-size:60px;
    margin-bottom:10px;
}

h2{
    color:#dc2626;
    margin-bottom:10px;
}

p{
    color:#6b7280;
    margin-bottom:20px;
}

.soal{
    font-weight:bold;
    margin-bottom:20px;
    color:#111827;
}

.btn-group{
    display:flex;
    gap:10px;
    justify-content:center;
}

button{
    padding:12px 18px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:bold;
    transition:0.2s;
}

.btn-yes{
    background:#dc2626;
    color:white;
}

.btn-yes:hover{
    background:#b91c1c;
}

.btn-no{
    background:#e5e7eb;
    color:#111827;
}

.btn-no:hover{
    background:#d1d5db;
}

</style>
</head>

<body>

<div class="card">

    <div class="icon">⚠️</div>

    <h2>Hapus Soal?</h2>

    <p>Data yang dihapus tidak bisa dikembalikan</p>

    <div class="soal">
        "<?= $data['pertanyaan']; ?>"
    </div>

    <div class="btn-group">

        <a href="hapus_proses.php?id=<?= $id; ?>">
            <button class="btn-yes">Ya, Hapus</button>
        </a>

        <a href="data_soal.php">
            <button class="btn-no">Batal</button>
        </a>

    </div>

</div>

</body>
</html>