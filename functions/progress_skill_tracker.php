<?php
// functions/progress_skill_tracker.php
require_once __DIR__ . '/../config.php';

/**
 * Mendapatkan semua data progress skill tracker (dengan informasi mahasiswa dan skill)
 */
function getProgressSkillTrackers($search = '') {
    global $conn;
    
    $progress_logs = [];
    $sql = "SELECT p.*, s.nama_mahasiswa, s.nama_skill 
            FROM progress_skill_tracker p 
            JOIN skill_tracker s ON p.skill_tracker_id = s.id";
    
    if (!empty($search)) {
        $search = mysqli_real_escape_string($conn, $search);
        $sql .= " WHERE s.nama_mahasiswa LIKE '%$search%' 
                  OR s.nama_skill LIKE '%$search%' 
                  OR p.progress LIKE '%$search%' 
                  OR p.status_progress LIKE '%$search%'";
    }
    
    $sql .= " ORDER BY p.tanggal_progress DESC, p.id DESC";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $progress_logs[] = $row;
        }
    }
    
    return $progress_logs;
}

/**
 * Mendapatkan data progress berdasarkan ID
 */
function getProgressSkillTrackerById($id) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT p.*, s.nama_mahasiswa, s.nama_skill 
            FROM progress_skill_tracker p
            JOIN skill_tracker s ON p.skill_tracker_id = s.id
            WHERE p.id = '$id' LIMIT 1";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

/**
 * Menambahkan data progress baru
 */
function addProgressSkillTracker($data) {
    global $conn;
    
    $skill_tracker_id = (int)$data['skill_tracker_id'];
    $progress = mysqli_real_escape_string($conn, $data['progress']);
    $catatan = mysqli_real_escape_string($conn, $data['catatan']);
    $tanggal_progress = mysqli_real_escape_string($conn, $data['tanggal_progress']);
    $status_progress = mysqli_real_escape_string($conn, $data['status_progress']);
    
    $sql = "INSERT INTO progress_skill_tracker (skill_tracker_id, progress, catatan, tanggal_progress, status_progress) 
            VALUES ($skill_tracker_id, '$progress', '$catatan', '$tanggal_progress', '$status_progress')";
    
    return mysqli_query($conn, $sql);
}

/**
 * Memperbarui data progress
 */
function updateProgressSkillTracker($id, $data) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $skill_tracker_id = (int)$data['skill_tracker_id'];
    $progress = mysqli_real_escape_string($conn, $data['progress']);
    $catatan = mysqli_real_escape_string($conn, $data['catatan']);
    $tanggal_progress = mysqli_real_escape_string($conn, $data['tanggal_progress']);
    $status_progress = mysqli_real_escape_string($conn, $data['status_progress']);
    
    $sql = "UPDATE progress_skill_tracker SET 
            skill_tracker_id = $skill_tracker_id, 
            progress = '$progress', 
            catatan = '$catatan', 
            tanggal_progress = '$tanggal_progress', 
            status_progress = '$status_progress' 
            WHERE id = '$id'";
    
    return mysqli_query($conn, $sql);
}

/**
 * Menghapus data progress
 */
function deleteProgressSkillTracker($id) {
    global $conn;
    
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM progress_skill_tracker WHERE id = '$id'";
    
    return mysqli_query($conn, $sql);
}

/**
 * Mendapatkan riwayat progress untuk skill tracker tertentu
 */
function getProgressHistoryByTrackerId($tracker_id) {
    global $conn;
    
    $tracker_id = mysqli_real_escape_string($conn, $tracker_id);
    $history = [];
    $sql = "SELECT * FROM progress_skill_tracker 
            WHERE skill_tracker_id = '$tracker_id' 
            ORDER BY tanggal_progress DESC, id DESC";
            
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }
    }
    
    return $history;
}
?>
