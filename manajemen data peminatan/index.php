<?php
include 'koneksi.php';

// --- LOGIKA HAPUS DATA ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM peminatan WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
}

// --- LOGIKA SIMPAN & EDIT DATA ---
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_peminatan'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];

    if ($id == "") {
        $sql = "INSERT INTO peminatan (nama_peminatan, deskripsi, kategori) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $deskripsi, $kategori]);
    } else {
        $sql = "UPDATE peminatan SET nama_peminatan=?, deskripsi=?, kategori=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $deskripsi, $kategori, $id]);
    }
    header("Location: index.php");
}

// --- LOGIKA AMBIL DATA UNTUK EDIT ---
$edit_data = ['id' => '', 'nama_peminatan' => '', 'deskripsi' => '', 'kategori' => ''];
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM peminatan WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_data = $stmt->fetch();
}

$query = $pdo->query("SELECT * FROM peminatan ORDER BY id DESC");
$data_peminatan = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSTI SkillMatch - Data Peminatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f7ff; min-height: 100vh; padding: 40px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .main-container {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            display: flex;
            margin-bottom: 50px;
        }
        
        .sidebar-logo {
            background: linear-gradient(135deg, #007bff 0%, #ffffff 100%);
            width: 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-section { width: 60%; padding: 40px; }

        .btn-myskill {
            background-color: #007bff;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-myskill:hover { background-color: #0056b3; color: white; transform: scale(1.02); }

        .card-peminatan {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            height: 100%;
            background: white;
            display: flex;
            flex-direction: column;
        }
        .card-peminatan:hover { transform: translateY(-5px); }
        
        .card-body-custom { padding: 20px; flex-grow: 1; }
        
        .quote-icon { color: #007bff; font-size: 24px; font-weight: bold; }
        
        .card-title-custom {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a2a3a;
            margin-bottom: 10px;
            min-height: 50px;
        }

        .card-text-custom { color: #5a6a7a; font-size: 0.9rem; margin-bottom: 15px; }

        .card-footer-custom {
            padding: 15px;
            background: transparent;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 10px;
        }

        .btn-action { flex: 1; border-radius: 6px; font-size: 0.85rem; padding: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: 0.2s; }
        
        .btn-edit { background-color: #add8e6; color: #0056b3; }
        .btn-edit:hover { background-color: #87ceeb; color: #004085; }
        
        .btn-hapus { background-color: #001f3f; color: white; }
        .btn-hapus:hover { background-color: #001226; }
        
        .badge-kategori {
            background-color: #e7f1ff;
            color: #007bff;
            font-size: 0.75rem;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="main-container">
        <div class="sidebar-logo">
            <img src="https://via.placeholder.com/150x150.png?text=PSTI" alt="Logo">
            <h2 class="mt-3 fw-bold text-dark text-center" style="letter-spacing: -1px;">MySkill<br><span style="color: #007bff;">PSTI</span></h2>
        </div>

        <div class="form-section">
            <h4 class="fw-bold mb-4" style="color: #1a2a3a;"><?= $edit_data['id'] ? 'Edit' : 'Tambah' ?> Peminatan</h4>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Nama Peminatan</label>
                    <input type="text" name="nama_peminatan" class="form-control" placeholder="Contoh: Cloud Engineer" value="<?= $edit_data['nama_peminatan'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="2" placeholder="Jelaskan fokus peminatan ini..." required><?= $edit_data['deskripsi'] ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Pendidikan" <?= $edit_data['kategori'] == 'Pendidikan' ? 'selected' : '' ?>>Pendidikan</option>
                        <option value="Engineering" <?= $edit_data['kategori'] == 'Engineering' ? 'selected' : '' ?>>Engineering</option>
                        <option value="Sistem Informasi" <?= $edit_data['kategori'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                    </select>
                </div>
                <!-- Perubahan Teks Tombol di Sini -->
                <button type="submit" name="simpan" class="btn btn-myskill">
                    <?= $edit_data['id'] ? 'Simpan Perubahan' : 'Simpan Peminatan' ?>
                </button>
            </form>
        </div>
    </div>

    <div class="text-center mb-5">
        <h3 class="fw-bold">Rintis Karir Bersama PSTI</h3>
        <p class="text-secondary">Pilih dan tentukan masa depanmu melalui berbagai jalur peminatan</p>
    </div>

    <div class="row g-4">
        <?php foreach ($data_peminatan as $row): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card-peminatan">
                <div class="card-body-custom">
                    <div class="quote-icon">“</div>
                    <div class="badge-kategori"><?= htmlspecialchars($row['kategori']) ?></div>
                    <h5 class="card-title-custom"><?= htmlspecialchars($row['nama_peminatan']) ?></h5>
                    <p class="card-text-custom"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
                </div>
                <div class="card-footer-custom">
                    <a href="index.php?edit=<?= $row['id'] ?>" class="btn-action btn-edit">Edit Data</a>
                    <a href="index.php?hapus=<?= $row['id'] ?>" class="btn-action btn-hapus" onclick="return confirm('Hapus peminatan ini?')">Hapus</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
