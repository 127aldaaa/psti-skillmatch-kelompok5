<?php
require_once '../config/config.php';
require_once '../config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$data = mysqli_query($conn, "SELECT * FROM soal_tes");
?>

<!DOCTYPE html>
<html>
<head>

    <title>Data Soal</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="main">

    <div class="container">

       <div class="topbar">

    <h1>Data Soal Tes Minat & Bakat</h1>

    <p>
        Kelola semua soal tes minat dan bakat yang tersedia
    </p>

</div>

        <div class="card">

            <a href="tambah_soal.php" class="btn-tambah">
                + Tambah Soal
            </a>

            <div class="table-container">

                <table>

                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $no = 1; ?>
                    <?php while($row = mysqli_fetch_assoc($data)) : ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $row['pertanyaan']; ?></td>

                        <td>
                            <span class="badge">
                            <?= $row['kategori_a']; ?> /
                            <?= $row['kategori_b']; ?> /
                            <?= $row['kategori_c']; ?>
                        </span>
                    </td>

                        <td>

                            <a href="edit_soal.php?id=<?= $row['id_soal']; ?>" class="btn-edit">
                                Edit
                            </a>

                            <a href="hapus_soal.php?id=<?= $row['id_soal']; ?>" class="btn-hapus">
                                Hapus
                            </a>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                </table>

            </div>

        </div>

    </div>

</div>