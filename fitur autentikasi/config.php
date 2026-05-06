<?php
$conn = mysqli_connect("localhost", "root", "", "skillmatch");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>