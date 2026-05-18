<?php
require_once '../../config.php';
require_once '../../functions/helper.php';
require_once '../../functions/rekomendasi.php';

// Menangani aksi hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = sanitizeInput($_GET['id']);
    hapusRekomendasi($id);
    header("Location: index.php");
    exit;
}

// Mendapatkan semua data rekomendasi dari database
$rekomendasi = getSemuaRekomendasi();

// Include header
include '../../includes/header.php';
?>

<!-- Content Area -->
<div class="content-area">
    
    <!-- Header Content -->
    <div class="page-header">
        <h1>Rekomendasi Data Skill</h1>
        <p>Kelola rekomendasi skill untuk setiap peminatan.</p>
    </div>

    <!-- Tabel Data Rekomendasi -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h3 class="card-title">Daftar Rekomendasi Skill</h3>
            <div style="display: flex; gap: 10px; align-items: center;">
                <a href="create.php" class="btn-sm" style="background: #22c55e; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-plus"></i> Tambah Rekomendasi
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Peminatan</th>
                        <th>Skill yang Direkomendasikan</th>
                        <th>Kategori Skill</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rekomendasi) > 0): ?>
                        <?php $no = 1; foreach ($rekomendasi as $item): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($item['nama_peminatan']); ?></strong></td>
                                <td><?php echo htmlspecialchars($item['nama_skill']); ?></td>
                                <td><?php echo htmlspecialchars($item['kategori']); ?></td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn-sm" style="background: #ef4444; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;" onclick="return confirm('Apakah Anda yakin ingin menghapus rekomendasi ini?');">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px;">Belum ada data rekomendasi skill.</td>
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
