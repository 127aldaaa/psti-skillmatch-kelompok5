<?php include '../../config/koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Kursus & Pelatihan</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f1f1f1;
        }

        .header{
            background:#2f63dd;
            color:white;
            text-align:center;
            padding:30px;
            font-size:40px;
            font-weight:bold;
        }

        .container{
            width:90%;
            margin:50px auto;
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:30px;
        }

        .card{
            background:white;
            border-radius:20px;
            padding:30px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .card h3{
            font-size:24px;
            margin-bottom:20px;
            color:#1f2d3d;
        }

        .card p{
            margin-bottom:15px;
            font-size:18px;
            color:#444;
        }

        .btn{
            display:inline-block;
            background:#2f63dd;
            color:white;
            text-decoration:none;
            padding:14px 28px;
            border-radius:12px;
            margin-top:10px;
            font-size:18px;
        }

        .btn:hover{
            background:#1f4fc2;
        }

        .icon{
            color:#2f63dd;
            font-size:35px;
            margin-right:10px;
        }
    </style>
</head>
<body>

<div class="header">
    Kursus & Pelatihan
</div>

<div class="container">

<?php
$data = mysqli_query($conn,"SELECT * FROM kursus_pelatihan");

while($d = mysqli_fetch_assoc($data)){
?>

    <div class="card">

        <h3>
            🎓 <?= $d['judul']; ?>
        </h3>

        <p><?= $d['deskripsi']; ?></p>

        <p>
            <b>Kategori:</b>
            <?= $d['kategori']; ?>
        </p>

        <p>
            <b>Durasi:</b>
            <?= $d['durasi']; ?>
        </p>

        <a href="daftar_kursus.php?id=<?= $d['id']; ?>" class="btn">
            Daftar Kursus
        </a>

    </div>

<?php } ?>

<div style="text-align: center; margin-top: 40px; margin-bottom: 40px; width: 100%;">
        <a href="../dashboard%20mahasiswa/dashboard_mahasiswa.php" style="
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            padding: 10px 30px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s ease;
        " onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
            Kembali
        </a>
    </div>

</body>
</html>