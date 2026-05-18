<?php
$conn = mysqli_connect("localhost", "root", "", "skillmatch");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS peminatan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_peminatan VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    kategori VARCHAR(255)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table peminatan created successfully\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

$check = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM peminatan");
$row = mysqli_fetch_assoc($check);
if ($row['cnt'] == 0) {
    $insert = "INSERT INTO peminatan (nama_peminatan, deskripsi, kategori) VALUES 
        ('Web Development', 'Pengembangan web', 'Sistem Informasi'),
        ('Mobile Development', 'Pengembangan mobile', 'Sistem Informasi')";
    mysqli_query($conn, $insert);
    echo "Dummy data inserted\n";
}
mysqli_close($conn);
?>
