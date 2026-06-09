<?php
// functions/progress_skill_tracker.php
require_once __DIR__ . '/../config.php';

function getDBConn() {
    global $conn;
    if (!$conn) {
        $conn = mysqli_connect("localhost", "root", "", "skillmatch");
    }
    return $conn;
}

/**
 * Mendapatkan semua data progress skill tracker (dengan informasi mahasiswa dan skill)
 */
function getProgressSkillTrackers($search = '') {
    $db = getDBConn();
    
    $progress_logs = [];
    $sql = "SELECT p.*, s.nama_mahasiswa, s.nama_skill 
            FROM progress_skill_tracker p 
            JOIN skill_tracker s ON p.skill_tracker_id = s.id";
    
    if (!empty($search)) {
        $search = mysqli_real_escape_string($db, $search);
        $sql .= " WHERE s.nama_mahasiswa LIKE '%$search%' 
                  OR s.nama_skill LIKE '%$search%' 
                  OR p.status_progress LIKE '%$search%' 
                  OR p.catatan LIKE '%$search%'";
    }
    
    $sql .= " ORDER BY p.tanggal_update DESC, p.id DESC";
    
    $result = mysqli_query($db, $sql);
    
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
    $db = getDBConn();
    
    $id = mysqli_real_escape_string($db, $id);
    $sql = "SELECT p.*, s.nama_mahasiswa, s.nama_skill 
            FROM progress_skill_tracker p
            JOIN skill_tracker s ON p.skill_tracker_id = s.id
            WHERE p.id = '$id' LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

/**
 * Menambahkan data progress baru
 */
function addProgressSkillTracker($data) {
    $db = getDBConn();
    
    $skill_tracker_id = (int)$data['skill_tracker_id'];
    $progress_persen = (int)$data['progress_persen'];
    $status_progress = mysqli_real_escape_string($db, $data['status_progress']);
    $catatan = mysqli_real_escape_string($db, $data['catatan']);
    
    $sql = "INSERT INTO progress_skill_tracker (skill_tracker_id, progress_persen, status_progress, catatan) 
            VALUES ($skill_tracker_id, $progress_persen, '$status_progress', '$catatan')";
    
    return mysqli_query($db, $sql);
}

/**
 * Memperbarui data progress
 */
function updateProgressSkillTracker($id, $data) {
    $db = getDBConn();
    
    $id = mysqli_real_escape_string($db, $id);
    $skill_tracker_id = (int)$data['skill_tracker_id'];
    $progress_persen = (int)$data['progress_persen'];
    $status_progress = mysqli_real_escape_string($db, $data['status_progress']);
    $catatan = mysqli_real_escape_string($db, $data['catatan']);
    
    $sql = "UPDATE progress_skill_tracker SET 
            skill_tracker_id = $skill_tracker_id, 
            progress_persen = $progress_persen, 
            status_progress = '$status_progress', 
            catatan = '$catatan' 
            WHERE id = '$id'";
    
    return mysqli_query($db, $sql);
}

/**
 * Menghapus data progress
 */
function deleteProgressSkillTracker($id) {
    $db = getDBConn();
    
    $id = mysqli_real_escape_string($db, $id);
    $sql = "DELETE FROM progress_skill_tracker WHERE id = '$id'";
    
    return mysqli_query($db, $sql);
}

/**
 * Mendapatkan semua data skill tracker untuk form select
 */
function getAllSkillTrackers() {
    $db = getDBConn();
    
    $trackers = [];
    $sql = "SELECT id, nama_mahasiswa, nama_skill FROM skill_tracker ORDER BY nama_mahasiswa ASC";
    
    $result = mysqli_query($db, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $trackers[] = $row;
        }
    }
    
    return $trackers;
}
?>
