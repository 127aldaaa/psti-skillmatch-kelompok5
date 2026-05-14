<?php
include '../config.php';

$id = $_GET['id'];

$hapus = mysqli_query($conn, "DELETE FROM soal_tes WHERE id_soal='$id'");

if($hapus){
    header("Location: data_soal.php?status=hapus_sukses");
    exit;
}else{
    echo "Gagal menghapus data";
}
?>