<?php
// config/config.php

// Pastikan path session valid
$sessionPath = sys_get_temp_dir();
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}
session_save_path($sessionPath);

// Mulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Dapatkan base path dinamis untuk memudahkan di localhost
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host;

// Konfigurasi Umum
define('BASE_URL', $base_url);
define('APP_NAME', 'PSTI Skill Match');


