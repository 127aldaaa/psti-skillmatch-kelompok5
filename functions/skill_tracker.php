<?php
// functions/skill_tracker.php
require_once __DIR__ . '/../config.php';

/**
 * Mendapatkan semua data skill tracker dengan search opsional
 */
function getSkillTrackers($search = '') {
    global $conn;
    
    $trackers = [];
    $sql = "SELECT * FROM skill_tracker";
    
    if (!empty($search)) {
        $search = mysqli_real_escape_string($conn, $search);
        $sql .= " WHERE nama_mahasiswa LIKE '%$search%' OR nama_skill LIKE '%$search%' OR level_skill LIKE '%$search%' OR status LIKE '%$search%'";
    }
    
    $sql .= " ORDER BY tanggal_update DESC";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $trackers[] = $row;
        }
    }
    
    return $trackers;
}

/**
 * Mendapatkan data skill tracker berdasarkan ID
 */
function getSkillTrackerById($id) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM skill_tracker WHERE id = '$id' LIMIT 1";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

/**
 * Menambahkan data skill tracker baru
 */
function addSkillTracker($data) {
    global $conn;
    
    $nama_mahasiswa = mysqli_real_escape_string($conn, $data['nama_mahasiswa']);
    $nama_skill = mysqli_real_escape_string($conn, $data['nama_skill']);
    $level_skill = mysqli_real_escape_string($conn, $data['level_skill']);
    $progress_persen = (int)$data['progress_persen'];
    $status = mysqli_real_escape_string($conn, $data['status']);
    
    $sql = "INSERT INTO skill_tracker (nama_mahasiswa, nama_skill, level_skill, progress_persen, status) 
            VALUES ('$nama_mahasiswa', '$nama_skill', '$level_skill', $progress_persen, '$status')";
    
    return mysqli_query($conn, $sql);
}

/**
 * Memperbarui data skill tracker
 */
function updateSkillTracker($id, $data) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $nama_mahasiswa = mysqli_real_escape_string($conn, $data['nama_mahasiswa']);
    $nama_skill = mysqli_real_escape_string($conn, $data['nama_skill']);
    $level_skill = mysqli_real_escape_string($conn, $data['level_skill']);
    $progress_persen = (int)$data['progress_persen'];
    $status = mysqli_real_escape_string($conn, $data['status']);
    
    $sql = "UPDATE skill_tracker SET 
            nama_mahasiswa = '$nama_mahasiswa', 
            nama_skill = '$nama_skill', 
            level_skill = '$level_skill', 
            progress_persen = $progress_persen, 
            status = '$status' 
            WHERE id = '$id'";
    
    return mysqli_query($conn, $sql);
}

/**
 * Menghapus data skill tracker
 */
function deleteSkillTracker($id) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM skill_tracker WHERE id = '$id'";
    
    return mysqli_query($conn, $sql);
}
?>
