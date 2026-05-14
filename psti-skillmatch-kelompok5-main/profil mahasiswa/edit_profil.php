<?php
include '../config.php';
session_start();

$_SESSION['username'] = 'alda'; 
$user_logged_in = $_SESSION['username']; 

$query = mysqli_query($conn, "SELECT * FROM profil WHERE username = '$user_logged_in'");
if (mysqli_num_rows($query) == 0) {
    $query = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
}
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $nim      = mysqli_real_escape_string($conn, $_POST['nim']);
    $angkatan = mysqli_real_escape_string($conn, $_POST['angkatan']); // Tambahan Angkatan
    $foto_name = $data['foto_profil']; 

    if (!empty($_FILES['foto_profil']['name'])) {
        $target_dir = "../image/"; 
        $foto_name = time() . "_" . basename($_FILES['foto_profil']['name']);
        move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_dir . $foto_name);
    }

    // Update Query ditambah kolom angkatan
    $sql = "UPDATE profil SET 
            nama_lengkap='$nama', 
            email='$email', 
            nim='$nim', 
            angkatan='$angkatan', 
            foto_profil='$foto_name' 
            WHERE username='" . $data['username'] . "'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Profil Berhasil Diperbarui!'); window.location='index_profil.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7fe; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); width: 320px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 12px; color: #666; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-save { background: #007bff; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3 style="text-align:center; color:#007bff;">Edit Profil</h3>
        <div class="form-group" style="text-align:center;">
            <img src="../image/<?php echo $data['foto_profil'] ?: 'default.png'; ?>" style="width:70px; height:70px; border-radius:50%; object-fit:cover; border: 2px solid #007bff;">
            <input type="file" name="foto_profil" style="font-size:10px; margin-top:5px;">
        </div>
        <div class="form-group"><label>NIM</label><input type="text" name="nim" value="<?php echo $data['nim']; ?>"></div>
        <div class="form-group"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>"></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" value="<?php echo $data['email']; ?>"></div>
        <div class="form-group"><label>Angkatan</label><input type="number" name="angkatan" value="<?php echo $data['angkatan']; ?>"></div>
        
        <button type="submit" name="update" class="btn-save">Simpan Perubahan</button>
        <a href="index_profil.php" style="display:block; text-align:center; margin-top:10px; font-size:12px; color:#999; text-decoration:none;">Batal</a>
    </form>
</div>

</body>
</html>