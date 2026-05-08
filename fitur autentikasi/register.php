<?php
include 'config.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // validasi
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Semua field wajib diisi";

    } elseif (strlen($password) < 8) {
        $error = "Password minimal 8 karakter";

    } else {

        // cek email
        $cek = mysqli_query($conn, "SELECT id_users FROM users WHERE email='$email'");

        if (mysqli_num_rows($cek) > 0) {
            $error = "Email sudah terdaftar";

        } else {

            // hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // insert ke database
            $query = "INSERT INTO users 
            (username, email, password, role, dibuat_pada, diubah_pada)
            VALUES
            ('$username', '$email', '$hash', 'mahasiswa', NOW(), NOW())";

            if (mysqli_query($conn, $query)) {
                $success = "Registrasi berhasil!";
            } else {
                $error = "ERROR: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register SkillMatch</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <!-- KIRI -->
    <div class="left">
        <img src="image/logo2.jpeg" alt="logo">
    </div>

    <!-- KANAN -->
    <div class="right">
        <h2>Register SkillMatch</h2>

        <!-- ERROR -->
        <?php if ($error != ""): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- SUCCESS -->
        <?php if ($success != ""): ?>
            <div style="padding:10px; background:#e6ffe6; border:1px solid green; margin-bottom:10px;">
                <p style="color:green;"><?php echo $success; ?></p>

                <a href="login.php">
                    <button type="button">Login Sekarang</button>
                </a>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>

        <!-- LINK LOGIN (SELALU TAMPIL) -->
        <p>
            Sudah punya akun? 
            <a href="login.php">Login</a>
        </p>

    </div>

</div>

</body>
</html>