<?php
// config/config.php

// Mulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Dapatkan base path dinamis untuk memudahkan di localhost
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$base_url = $protocol . "://" . $host . $base_dir;

// Konfigurasi Umum
define('BASE_URL', $base_url);
define('APP_NAME', 'PSTI Skill Match');

// Inisialisasi session admin default jika belum ada
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'Admin';
}
