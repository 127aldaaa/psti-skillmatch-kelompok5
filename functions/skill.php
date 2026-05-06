<?php
// functions/skill.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inisialisasi data dummy di session jika belum ada
if (!isset($_SESSION['skills'])) {
    $_SESSION['skills'] = [
        [
            'id' => 1,
            'nama_skill' => 'PHP Native',
            'kategori' => 'Pemrograman Web',
            'deskripsi' => 'Pengembangan web menggunakan PHP murni tanpa framework.'
        ],
        [
            'id' => 2,
            'nama_skill' => 'JavaScript',
            'kategori' => 'Pemrograman Web',
            'deskripsi' => 'Bahasa pemrograman untuk membuat interaksi pada halaman web.'
        ],
        [
            'id' => 3,
            'nama_skill' => 'Figma',
            'kategori' => 'Desain UI/UX',
            'deskripsi' => 'Alat desain antarmuka kolaboratif.'
        ]
    ];
}

/**
 * Mendapatkan semua data skill
 */
function getSkills() {
    return $_SESSION['skills'];
}

/**
 * Mendapatkan data skill berdasarkan ID
 */
function getSkillById($id) {
    foreach ($_SESSION['skills'] as $skill) {
        if ($skill['id'] == $id) {
            return $skill;
        }
    }
    return null;
}

/**
 * Menambahkan data skill baru
 */
function addSkill($data) {
    $skills = $_SESSION['skills'];
    $newId = 1;
    if (count($skills) > 0) {
        $lastSkill = end($skills);
        $newId = $lastSkill['id'] + 1;
    }
    
    $data['id'] = $newId;
    $_SESSION['skills'][] = $data;
    return true;
}

/**
 * Memperbarui data skill berdasarkan ID
 */
function updateSkill($id, $data) {
    foreach ($_SESSION['skills'] as $key => $skill) {
        if ($skill['id'] == $id) {
            $_SESSION['skills'][$key]['nama_skill'] = $data['nama_skill'];
            $_SESSION['skills'][$key]['kategori'] = $data['kategori'];
            $_SESSION['skills'][$key]['deskripsi'] = $data['deskripsi'];
            return true;
        }
    }
    return false;
}

/**
 * Menghapus data skill berdasarkan ID
 */
function deleteSkill($id) {
    foreach ($_SESSION['skills'] as $key => $skill) {
        if ($skill['id'] == $id) {
            unset($_SESSION['skills'][$key]);
            // Re-index array agar urutan index tetap rapi
            $_SESSION['skills'] = array_values($_SESSION['skills']);
            return true;
        }
    }
    return false;
}
