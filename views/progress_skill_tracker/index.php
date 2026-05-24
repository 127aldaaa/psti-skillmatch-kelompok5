<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/progress_skill_tracker.php';

// Mendapatkan keyword pencarian
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Menangani aksi hapus data di index jika dipanggil langsung
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = sanitizeInput($_GET['id']);
    deleteProgressSkillTracker($id);
    header("Location: index.php");
    exit;
}

// Mendapatkan semua data progress logs
$progress_logs = getProgressSkillTrackers($search);

// Include header
include '../../includes/header.php';
?>

<!-- Content Area -->
<div class="content-area">
    
    <!-- Header Content -->
    <div class="page-header">
        <h1>Progress Skill Tracker</h1>
        <p>Catatan riwayat perkembangan belajar skill mahasiswa secara mendalam.</p>
    </div>

    <!-- Tabel Data Progress Tracker -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h3 class="card-title">Riwayat Progress Belajar Mahasiswa</h3>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="index.php" method="GET" style="display: flex; gap: 5px;">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari mahasiswa, skill, progress..." style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; outline: none;">
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
                        <th>Mahasiswa & Skill</th>
                        <th>Progress Belajar</th>
                        <th>Catatan</th>
                        <th>Tanggal Progress</th>
                        <th>Status Progress</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($progress_logs) > 0): ?>
                        <?php $no = 1; foreach ($progress_logs as $log): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <strong style="display: block; color: var(--text-main);"><?php echo htmlspecialchars($log['nama_mahasiswa']); ?></strong>
                                    <small style="background: #eff6ff; color: var(--primary); padding: 2px 6px; border-radius: 4px; font-weight: 700; font-size: 0.75rem; margin-top: 4px; display: inline-block;">
                                        <?php echo htmlspecialchars($log['nama_skill']); ?>
                                    </small>
                                </td>
                                <td><strong><?php echo htmlspecialchars($log['progress']); ?></strong></td>
                                <td><span style="font-size: 0.85rem; color: var(--text-muted);"><?php echo nl2br(htmlspecialchars($log['catatan'])); ?></span></td>
                                <td>
                                    <span style="font-weight: 600; font-size: 0.85rem; color: var(--text-main);">
                                        <i class="fa-regular fa-calendar-days" style="margin-right: 6px;"></i><?php echo date('d M Y', strtotime($log['tanggal_progress'])); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                    $status = htmlspecialchars($log['status_progress']);
                                    $status_style = 'background: #f1f5f9; color: #475569;';
                                    if ($status == 'Selesai') {
                                        $status_style = 'background: #dcfce3; color: #15803d;';
                                    } elseif ($status == 'Sedang Belajar') {
                                        $status_style = 'background: #dbeafe; color: #1d4ed8;';
                                    } elseif ($status == 'Hampir Selesai') {
                                        $status_style = 'background: #fef9c3; color: #a16207;';
                                    } elseif ($status == 'Belum Mulai') {
                                        $status_style = 'background: #fee2e2; color: #b91c1c;';
                                    }
                                    ?>
                                    <span class="badge-status" style="<?php echo $status_style; ?> padding: 6px 12px; font-weight: 700;"><?php echo $status; ?></span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="edit.php?id=<?php echo $log['id']; ?>" class="btn-sm" style="background: #3b82f6; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        <a href="delete.php?id=<?php echo $log['id']; ?>" class="btn-sm" style="background: #ef4444; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan progress ini?');">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px; color: var(--text-muted);">Belum ada riwayat progress belajar skill.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include '../../includes/footer.php';
?>
