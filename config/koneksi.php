<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "skillmatch"
);

if(!$conn){
    die("Koneksi database gagal");
}
?>