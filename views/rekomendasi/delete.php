<?php
require_once '../../config.php';
require_once '../../functions/helper.php';
require_once '../../functions/rekomendasi.php';

// Menangani aksi hapus data
if (isset($_GET['id'])) {
    $id = sanitizeInput($_GET['id']);
    hapusRekomendasi($id);
}

// Redirect kembali ke halaman index
header("Location: index.php");
exit;
?>
