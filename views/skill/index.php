<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/skill.php';

// Menangani aksi hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteSkill($id);
    header("Location: index.php");
    exit;
}

// Mendapatkan semua data skill
$skills = getSkills();

// Include header
include '../../includes/header.php';
?>

<!-- Content Area -->
<div class="content-area">
    
    <!-- Header Content -->
    <div class="page-header">
        <h1>Manajemen Data Skill</h1>
        <p>Kelola daftar skill yang tersedia dalam sistem.</p>
    </div>

    <!-- Tabel Data Skill -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title">Daftar Skill</h3>
            <a href="create.php" class="btn-sm" style="background: #22c55e; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-plus"></i> Tambah Skill
            </a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Skill</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($skills) > 0): ?>
                        <?php $no = 1; foreach ($skills as $skill): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($skill['nama_skill']); ?></strong></td>
                                <td><?php echo htmlspecialchars($skill['kategori']); ?></td>
                                <td><?php echo htmlspecialchars($skill['deskripsi']); ?></td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="edit.php?id=<?php echo $skill['id']; ?>" class="btn-sm" style="background: #3b82f6; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        <a href="index.php?action=delete&id=<?php echo $skill['id']; ?>" class="btn-sm" style="background: #ef4444; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;" onclick="return confirm('Apakah Anda yakin ingin menghapus skill ini?');">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px;">Belum ada data skill yang ditambahkan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
// Include footer
include '../../includes/footer.php';
?>
