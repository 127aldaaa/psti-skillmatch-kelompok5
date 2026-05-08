<?php
require_once '../../config/config.php';
require_once '../../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM courses WHERE id=$id");

header("Location: kursus.php");
?>