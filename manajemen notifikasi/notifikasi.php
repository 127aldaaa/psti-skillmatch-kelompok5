<?php
include '../peminatan/koneksi.php';

// HAPUS
if (isset($_GET['hapus'])) {
    $stmt = $pdo->prepare("DELETE FROM notifikasi WHERE id=?");
    $stmt->execute([$_GET['hapus']]);
    header("Location: notifikasi.php");
}

// SIMPAN
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    if ($id == "") {
        $stmt = $pdo->prepare("INSERT INTO notifikasi (judul, isi) VALUES (?, ?)");
        $stmt->execute([$judul, $isi]);
    } else {
        $stmt = $pdo->prepare("UPDATE notifikasi SET judul=?, isi=? WHERE id=?");
        $stmt->execute([$judul, $isi, $id]);
    }
    header("Location: notifikasi.php");
}

// EDIT
$edit = ['id'=>'','judul'=>'','isi'=>''];
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM notifikasi WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $edit = $stmt->fetch();
}

// AMBIL DATA
$data = $pdo->query("SELECT * FROM notifikasi ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #f0f7ff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-notif {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: 0.3s;
    }
    .card-notif:hover { transform: translateY(-5px); }

    .badge-tanggal {
        background-color: #e7f1ff;
        color: #007bff;
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .btn-myskill {
        background-color: #007bff;
        color: white;
        border-radius: 8px;
        font-weight: bold;
    }
    .btn-myskill:hover { background-color: #0056b3; }
    </style>
</head>

<body class="container py-5">

<h3 class="fw-bold mb-4"><?= $edit['id'] ? 'Edit' : 'Tambah' ?> Notifikasi</h3>

<form method="POST" class="mb-5">
    <input type="hidden" name="id" value="<?= $edit['id'] ?>">

    <input type="text" name="judul" class="form-control mb-3" placeholder="Judul" value="<?= $edit['judul'] ?>" required>

    <textarea name="isi" class="form-control mb-3" rows="3" placeholder="Isi pengumuman" required><?= $edit['isi'] ?></textarea>

    <button name="simpan" class="btn btn-myskill w-100">
        <?= $edit['id'] ? 'Simpan Perubahan' : 'Simpan Notifikasi' ?>
    </button>
</form>

<h4 class="fw-bold mb-4">Daftar Notifikasi</h4>

<div class="row g-4">
<?php foreach ($data as $row): ?>
<div class="col-md-6 col-lg-4">
    <div class="card-notif p-3 bg-white">

        <div class="badge-tanggal mb-2">
            Dibuat: <?= $row['tanggal'] ?><br>

            <?php if (isset($row['updated_at']) && $row['updated_at'] != $row['tanggal']): ?>
                Update: <?= $row['updated_at'] ?>
            <?php endif; ?>
        </div>

        <h5 class="fw-bold"><?= htmlspecialchars($row['judul']) ?></h5>

        <p class="text-secondary">
            <?= nl2br(htmlspecialchars($row['isi'])) ?>
        </p>

        <div class="d-flex gap-2">
            <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary w-50">Edit</a>
            <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-dark w-50" onclick="return confirm('Hapus?')">Hapus</a>
        </div>

    </div>
</div>
<?php endforeach; ?>
</div>

</body>
</html>