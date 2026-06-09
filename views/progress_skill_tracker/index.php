<?php
require_once '../../config/config.php';
require_once '../../config.php';
require_once '../../functions/helper.php';
require_once '../../functions/progress_skill_tracker.php';

// Mendapatkan keyword pencarian
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Menangani aksi hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = sanitizeInput($_GET['id']);
    deleteProgressSkillTracker($id);
    header("Location: index.php");
    exit;
}

// Mendapatkan semua data progress dari database
$progress_logs = getProgressSkillTrackers($search);

// Include header
include '../../includes/header.php';
?>

<!-- Content Area -->
<div class="content-area">
    
    <!-- Header Content -->
    <div class="page-header">
        <h1>Progress Skill Tracker</h1>
        <p>Kelola perkembangan persentase skill mahasiswa.</p>
    </div>

    <!-- Tabel Data Progress -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h3 class="card-title">Daftar Progress Skill</h3>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="index.php" method="GET" style="display: flex; gap: 5px;">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari data..." style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; outline: none;">
                    <button type="submit" style="background: var(--primary); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;"><i class="fa-solid fa-search"></i> Cari</button>
                    <?php if(!empty($search)): ?>
                        <a href="index.php" style="background: var(--text-muted); color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px;"><i class="fa-solid fa-times"></i> Reset</a>
                    <?php endif; ?>
                </form>
                <a href="create.php" class="btn-sm" style="background: #22c55e; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-plus"></i> Tambah Progress
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Mahasiswa</th>
                        <th>Skill</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Update Terakhir</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($progress_logs) > 0): ?>
                        <?php $no = 1; foreach ($progress_logs as $log): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($log['nama_mahasiswa']); ?></strong></td>
                                <td><?php echo htmlspecialchars($log['nama_skill']); ?></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="flex-grow: 1; background: #e2e8f0; height: 8px; border-radius: 4px; overflow: hidden;">
                                            <div style="width: <?php echo $log['progress_persen']; ?>%; background: var(--primary); height: 100%;"></div>
                                        </div>
                                        <span style="font-size: 0.85rem; font-weight: 600; min-width: 40px;"><?php echo $log['progress_persen']; ?>%</span>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                        $statusClass = '';
                                        switch($log['status_progress']) {
                                            case 'Selesai': $statusClass = 'background: #dcfce3; color: #166534;'; break;
                                            case 'Hampir Selesai': $statusClass = 'background: #dbeafe; color: #1e40af;'; break;
                                            case 'Sedang Belajar': $statusClass = 'background: #fef9c3; color: #854d0e;'; break;
                                            default: $statusClass = 'background: #f1f5f9; color: #475569;'; break;
                                        }
                                    ?>
                                    <span class="badge-status" style="<?php echo $statusClass; ?> padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;"><?php echo htmlspecialchars($log['status_progress']); ?></span>
                                </td>
                                <td><?php echo date('d M Y, H:i', strtotime($log['tanggal_update'])); ?></td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="edit.php?id=<?php echo $log['id']; ?>" class="btn-sm" style="background: #3b82f6; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        <a href="index.php?action=delete&id=<?php echo $log['id']; ?>" class="btn-sm" style="background: #ef4444; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data progress ini?');">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px;">Belum ada data progress yang ditambahkan.</td>
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
