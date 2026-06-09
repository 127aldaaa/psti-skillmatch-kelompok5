<?php
include '../config.php'; 
session_start();

// Paksa session username untuk keperluan testing
$_SESSION['username'] = 'alda'; 
$user_logged_in = $_SESSION['username']; 

// Ambil data. Jika 'alda' tidak ketemu, ambil baris pertama yang ada di database
$query = mysqli_query($conn, "SELECT * FROM profil WHERE username = '$user_logged_in'");
if (mysqli_num_rows($query) == 0) {
    $query = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
}
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Mahasiswa</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7fe; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { width: 350px; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); text-align: center; }
        .img-profile { width: 110px; height: 110px; border-radius: 50%; object-fit: cover; border: 4px solid #007bff; margin-bottom: 15px; background: #eee; }
        .info { text-align: left; margin-top: 20px; }
        .info label { font-size: 11px; color: #aaa; text-transform: uppercase; display: block; margin-bottom: 2px; }
        .info p { font-weight: bold; color: #333; margin: 0 0 15px 0; border-bottom: 1px solid #f0f0f0; padding-bottom: 5px; }
        .btn-edit { display: block; background: #007bff; color: white; padding: 12px; border-radius: 10px; text-decoration: none; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>

    <div class="card">
        <img src="../image/<?php echo !empty($data['foto_profil']) ? $data['foto_profil'] : 'default.png'; ?>" class="img-profile">
        
        <h2 style="margin:0; color:#007bff;"><?php echo $data['nama_lengkap'] ?? 'Nama Tidak Ada'; ?></h2>
        <p style="color:#888; font-size:14px;">NIM: <?php echo $data['nim'] ?? '-'; ?></p>

        <div class="info">
            <label>Email</label>
            <p><?php echo $data['email'] ?? '-'; ?></p>
            
            <label>Program Studi</label>
            <p><?php echo $data['prodi'] ?? '-'; ?></p>
            
            <label>Angkatan</label>
            <p><?php echo $data['angkatan'] ?? '-'; ?></p>
        </div>

        <a href="edit_profil.php" class="btn-edit">Edit Profil</a>
        <a href="../dashboard_mahasiswa/dashboard_mahasiswa.php" style="display:block; margin-top:15px; color:#aaa; text-decoration:none; font-size:12px;">Kembali</a>
    </div>

</body>
</html>