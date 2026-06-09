<?php
require_once '../../config/config.php';
require_once '../../config/koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kursus dan Pelatihan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f7fb;
        }

        .content{
            padding:30px;
        }

        .card-table{
            background:white;
            border-radius:20px;
            padding:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        table{
            vertical-align:middle !important;
        }

        .badge-kategori{
            background:#e7f1ff;
            color:#0d6efd;
            padding:8px 12px;
            border-radius:10px;
            font-size:13px;
        }
    </style>
</head>

<body>

<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <div>
            <h2 class="fw-bold">
                Manajemen Kursus dan Pelatihan
            </h2>

            <p class="text-muted">
                Kelola semua data kursus atau pelatihan yang ada di sistem.
            </p>
        </div>

        <a href="tambah_kursus.php" class="btn btn-primary">
            + Tambah Kursus
        </a>

    </div>

    <div class="card-table">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kursus</th>
                    <th>Kategori</th>
                    <th>Durasi</th>
                    <th>Updated At</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            $data = mysqli_query($conn, "SELECT * FROM courses ORDER BY id DESC");

            while($d = mysqli_fetch_array($data)){
            ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td width="35%">
                        <b><?= $d['judul']; ?></b>
                        <br>

                        <small class="text-muted">
                            <?= $d['deskripsi']; ?>
                        </small>
                    </td>

                    <td>
                        <span class="badge-kategori">
                            <?= $d['kategori']; ?>
                        </span>
                    </td>

                    <td><?= $d['durasi']; ?></td>

                    <td><?= $d['updated_at']; ?></td>

                    <td>
                        <a href="ubah_kursus.php?id=<?= $d['id']; ?>"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="hapus_kursus.php?id=<?= $d['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                           Hapus
                        </a>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>