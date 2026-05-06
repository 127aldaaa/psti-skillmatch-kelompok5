<?php
session_start();
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // ambil user
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // cek password hash
        if (password_verify($password, $user['password'])) {

            // session
            $_SESSION['id'] = $user['id_users'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // redirect role
            if ($user['role'] == 'admin') {
                header("Location: dashboard_admin.php");
                exit();
            } else {
                header("Location: dashboard_mahasiswa.php");
                exit();
            }

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login SkillMatch</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <!-- BAGIAN KIRI (GAMBAR / LOGO) -->
    <div class="left">
        <img src="image/logo2.jpeg" alt="logo">
    </div>

    <!-- BAGIAN KANAN (FORM) -->
    <div class="right">
        <h2>Login SkillMatch</h2>

        <?php if ($error != ""): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Login</button>
        </form>

        <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
    </div>

</div>

</body>
</html>