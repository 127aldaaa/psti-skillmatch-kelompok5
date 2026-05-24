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

// Create table rekomendasi_skill
$sql_rekomendasi = "CREATE TABLE IF NOT EXISTS rekomendasi_skill (
    id INT AUTO_INCREMENT PRIMARY KEY,
    peminatan_id INT NOT NULL,
    skill_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql_rekomendasi)) {
    echo "Table rekomendasi_skill created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Create table skill_tracker
$sql_tracker = "CREATE TABLE IF NOT EXISTS skill_tracker (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_mahasiswa VARCHAR(255) NOT NULL,
    nama_skill VARCHAR(255) NOT NULL,
    level_skill VARCHAR(50) NOT NULL,
    progress_persen INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    tanggal_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (mysqli_query($conn, $sql_tracker)) {
    echo "Table skill_tracker created successfully<br>";
} else {
    echo "Error creating table skill_tracker: " . mysqli_error($conn) . "<br>";
}

// Create table progress_skill_tracker
$sql_progress = "CREATE TABLE IF NOT EXISTS progress_skill_tracker (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_tracker_id INT NOT NULL,
    progress VARCHAR(255) NOT NULL,
    catatan TEXT NULL,
    tanggal_progress DATE NOT NULL,
    status_progress VARCHAR(50) NOT NULL,
    FOREIGN KEY (skill_tracker_id) REFERENCES skill_tracker(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (mysqli_query($conn, $sql_progress)) {
    echo "Table progress_skill_tracker created successfully<br>";
} else {
    echo "Error creating table progress_skill_tracker: " . mysqli_error($conn) . "<br>";
}

// insert dummy data for skill_tracker if empty
$check_tracker = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM skill_tracker");
$row_tracker = mysqli_fetch_assoc($check_tracker);
if ($row_tracker && $row_tracker['cnt'] == 0) {
    $insert_tracker = "INSERT INTO skill_tracker (nama_mahasiswa, nama_skill, level_skill, progress_persen, status) VALUES 
        ('Nazwa Aulia Fitri', 'PHP Native', 'Intermediate', 60, 'Sedang Belajar'),
        ('Niha Karina', 'JavaScript', 'Beginner', 30, 'Sedang Belajar'),
        ('Muhammad Rayhan', 'Figma', 'Advanced', 90, 'Hampir Selesai')";
    if (mysqli_query($conn, $insert_tracker)) {
        echo "Dummy data for skill_tracker inserted successfully<br>";
    }
}

// insert dummy data for progress_skill_tracker if empty
$check_progress = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM progress_skill_tracker");
$row_progress = mysqli_fetch_assoc($check_progress);
if ($row_progress && $row_progress['cnt'] == 0) {
    $trackers = mysqli_query($conn, "SELECT id, nama_mahasiswa FROM skill_tracker");
    if ($trackers) {
        while ($tracker = mysqli_fetch_assoc($trackers)) {
            $tid = $tracker['id'];
            if ($tracker['nama_mahasiswa'] == 'Nazwa Aulia Fitri') {
                mysqli_query($conn, "INSERT INTO progress_skill_tracker (skill_tracker_id, progress, catatan, tanggal_progress, status_progress) VALUES 
                    ($tid, 'Memahami konsep dasar CRUD', 'Telah mempelajari INSERT, SELECT, UPDATE, DELETE dengan PHP Native.', '2026-05-20', 'Sedang Belajar'),
                    ($tid, 'Koneksi Database MySQL', 'Sudah bisa menghubungkan PHP dengan MySQL via mysqli_connect.', '2026-05-22', 'Sedang Belajar')");
            } else if ($tracker['nama_mahasiswa'] == 'Niha Karina') {
                mysqli_query($conn, "INSERT INTO progress_skill_tracker (skill_tracker_id, progress, catatan, tanggal_progress, status_progress) VALUES 
                    ($tid, 'Sintaks JavaScript Dasar', 'Belajar variabel, array, dan fungsi dasar.', '2026-05-21', 'Sedang Belajar')");
            } else if ($tracker['nama_mahasiswa'] == 'Muhammad Rayhan') {
                mysqli_query($conn, "INSERT INTO progress_skill_tracker (skill_tracker_id, progress, catatan, tanggal_progress, status_progress) VALUES 
                    ($tid, 'Membuat Wireframe & High-Fi Design', 'Menyelesaikan desain ber-resolusi tinggi untuk modul dashboard.', '2026-05-23', 'Hampir Selesai')");
            }
        }
        echo "Dummy data for progress_skill_tracker inserted successfully<br>";
    }
}

mysqli_close($conn);
?>
