<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/skill.php';

// Mendapatkan keyword pencarian
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Menangani aksi hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_skill'])) {
    $id = sanitizeInput($_GET['id_skill']);
    deleteSkill($id);
    header("Location: index.php");
    exit;
}

// Mendapatkan semua data skill dari database
$skills = getSkills($search);

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
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h3 class="card-title">Daftar Skill</h3>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="index.php" method="GET" style="display: flex; gap: 5px;">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari skill..." style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; outline: none;">
                    <button type="submit" style="background: var(--primary); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;"><i class="fa-solid fa-search"></i> Cari</button>
                    <?php if(!empty($search)): ?>
                        <a href="index.php" style="background: var(--text-muted); color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px;"><i class="fa-solid fa-times"></i> Reset</a>
                    <?php endif; ?>
                </form>
                <a href="create.php" class="btn-sm" style="background: #22c55e; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-plus"></i> Tambah Skill
                </a>
            </div>
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
                                        <a href="edit.php?id_skill=<?php echo $skill['id_skill']; ?>" class="btn-sm" style="background: #3b82f6; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        <a href="index.php?action=delete&id_skill=<?php echo $skill['id_skill']; ?>" class="btn-sm" style="background: #ef4444; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;" onclick="return confirm('Apakah Anda yakin ingin menghapus skill ini?');">
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
