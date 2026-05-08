<?php
$conn = mysqli_connect("localhost", "root", "", "skillmatch");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS skills (
    id_skill INT AUTO_INCREMENT PRIMARY KEY,
    nama_skill VARCHAR(255) NOT NULL,
    kategori VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "Table skills created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// insert dummy data if empty
$check = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM skills");
$row = mysqli_fetch_assoc($check);
if ($row['cnt'] == 0) {
    $insert = "INSERT INTO skills (nama_skill, kategori, deskripsi) VALUES 
        ('PHP Native', 'Pemrograman Web', 'Pengembangan web menggunakan PHP murni tanpa framework.'),
        ('JavaScript', 'Pemrograman Web', 'Bahasa pemrograman untuk membuat interaksi pada halaman web.'),
        ('Figma', 'Desain UI/UX', 'Alat desain antarmuka kolaboratif.')";
    mysqli_query($conn, $insert);
}

mysqli_close($conn);
?>
