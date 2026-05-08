<?php
// functions/skill.php
require_once __DIR__ . '/../config.php';


/**
 * Mendapatkan semua data skill dengan fitur search opsional
 */
function getSkills($search = '') {
    global $conn; // Menggunakan koneksi dari config.php
    
    $skills = [];
    $sql = "SELECT * FROM skills";
    
    if (!empty($search)) {
        // Melindungi dari SQL Injection
        $search = mysqli_real_escape_string($conn, $search);
        $sql .= " WHERE nama_skill LIKE '%$search%' OR kategori LIKE '%$search%' OR deskripsi LIKE '%$search%'";
    }
    
    $sql .= " ORDER BY created_at DESC";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $skills[] = $row;
        }
    }
    
    return $skills;
}

/**
 * Mendapatkan data skill berdasarkan ID
 */
function getSkillById($id) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM skills WHERE id_skill = '$id' LIMIT 1";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

/**
 * Menambahkan data skill baru
 */
function addSkill($data) {
    global $conn;
    
    $nama_skill = mysqli_real_escape_string($conn, $data['nama_skill']);
    $kategori = mysqli_real_escape_string($conn, $data['kategori']);
    $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);
    
    $sql = "INSERT INTO skills (nama_skill, kategori, deskripsi) VALUES ('$nama_skill', '$kategori', '$deskripsi')";
    
    return mysqli_query($conn, $sql);
}

/**
 * Memperbarui data skill berdasarkan ID
 */
function updateSkill($id, $data) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $nama_skill = mysqli_real_escape_string($conn, $data['nama_skill']);
    $kategori = mysqli_real_escape_string($conn, $data['kategori']);
    $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);
    
    $sql = "UPDATE skills SET nama_skill = '$nama_skill', kategori = '$kategori', deskripsi = '$deskripsi' WHERE id_skill = '$id'";
    
    return mysqli_query($conn, $sql);
}

/**
 * Menghapus data skill berdasarkan ID
 */
function deleteSkill($id) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM skills WHERE id_skill = '$id'";
    
    return mysqli_query($conn, $sql);
}
?>
