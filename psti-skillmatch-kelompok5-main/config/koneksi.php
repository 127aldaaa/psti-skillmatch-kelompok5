<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "manajemen_kursuspelatihan"
);

if(!$conn){
    die("Koneksi database gagal");
}
?>