<?php
// functions/rekomendasi.php
require_once __DIR__ . '/../config.php';

/**
 * Mendapatkan semua data peminatan
 */
function getSemuaPeminatan() {
    global $conn;
    $peminatan = [];
    
    // Asumsi tabel peminatan memiliki kolom id dan nama_peminatan
    $sql = "SELECT * FROM peminatan ORDER BY nama_peminatan ASC";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $peminatan[] = $row;
        }
    }
    
    return $peminatan;
}

/**
 * Mendapatkan semua data skill
 */
function getSemuaSkill() {
    global $conn;
    $skills = [];
    
    $sql = "SELECT * FROM skills ORDER BY nama_skill ASC";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $skills[] = $row;
        }
    }
    
    return $skills;
}

/**
 * Mendapatkan semua rekomendasi skill dengan nama peminatan dan nama skill
 */
function getSemuaRekomendasi() {
    global $conn;
    $rekomendasi = [];
    
    // Join tabel rekomendasi_skill dengan peminatan dan skills
    $sql = "SELECT r.id, p.nama_peminatan, s.nama_skill, s.kategori 
            FROM rekomendasi_skill r
            JOIN peminatan p ON r.peminatan_id = p.id
            JOIN skills s ON r.skill_id = s.id_skill
            ORDER BY p.nama_peminatan ASC, s.nama_skill ASC";
            
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rekomendasi[] = $row;
        }
    }
    
    return $rekomendasi;
}

/**
 * Menambahkan rekomendasi skill baru
 */
function tambahRekomendasi($peminatan_id, $skill_id) {
    global $conn;
    
    $peminatan_id = (int)$peminatan_id;
    $skill_id = (int)$skill_id;
    
    // Cek apakah relasi sudah ada untuk mencegah duplikasi
    $cek_sql = "SELECT id FROM rekomendasi_skill WHERE peminatan_id = $peminatan_id AND skill_id = $skill_id";
    $cek_result = mysqli_query($conn, $cek_sql);
    
    if ($cek_result && mysqli_num_rows($cek_result) > 0) {
        return false; // Relasi sudah ada
    }
    
    $sql = "INSERT INTO rekomendasi_skill (peminatan_id, skill_id) VALUES ($peminatan_id, $skill_id)";
    return mysqli_query($conn, $sql);
}

/**
 * Menghapus rekomendasi skill
 */
function hapusRekomendasi($id) {
    global $conn;
    
    $id = (int)$id;
    $sql = "DELETE FROM rekomendasi_skill WHERE id = $id";
    return mysqli_query($conn, $sql);
}
?>
