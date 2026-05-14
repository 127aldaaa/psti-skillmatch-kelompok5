<?php
// functions/helper.php

/**
 * Mendapatkan rentang tanggal dummy untuk dashboard
 * @return string
 */
function getDummyDateRange() {
    return "25 Mei - 1 Juni 2025";
}

/**
 * Mendapatkan URL base dari path relatif
 * @param string $path
 * @return string
 */
function url($path = '') {
    // Memastikan BASE_URL tersedia (di set di config)
    if (defined('BASE_URL')) {
        return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
    }
    return '/' . ltrim($path, '/');
}

/**
 * Mengamankan input string
 * @param string $data
 * @return string
 */
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
