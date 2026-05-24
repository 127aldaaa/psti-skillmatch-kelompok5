<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/skill_tracker.php';

// Mendapatkan keyword pencarian
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Menangani aksi hapus data di index jika dipanggil langsung
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = sanitizeInput($_GET['id']);
    deleteSkillTracker($id);
    header("Location: index.php");
    exit;
}

// Mendapatkan semua data skill tracker
$trackers = getSkillTrackers($search);

// Include header
include '../../includes/header.php';
?>

<!-- Content Area -->
<div class="content-area">
    
    <!-- Header Content -->
    <div class="page-header">
        <h1>Skill Tracker</h1>
        <p>Memonitor tingkat penguasaan skill dan progress belajar mahasiswa secara berkala.</p>
    </div>

    <!-- Tabel Data Skill Tracker -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h3 class="card-title">Daftar Skill Tracker Mahasiswa</h3>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="index.php" method="GET" style="display: flex; gap: 5px;">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari mahasiswa atau skill..." style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; outline: none;">
                    <button type="submit" style="background: var(--primary); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;"><i class="fa-solid fa-search"></i> Cari</button>
                    <?php if(!empty($search)): ?>
                        <a href="index.php" style="background: var(--text-muted); color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px;"><i class="fa-solid fa-times"></i> Reset</a>
                    <?php endif; ?>
                </form>
                <a href="create.php" class="btn-sm" style="background: #22c55e; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-plus"></i> Tambah Tracker
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Skill</th>
                        <th>Level Skill</th>
                        <th style="width: 200px;">Progress Belajar</th>
                        <th>Status</th>
                        <th>Tanggal Update</th>
                        <th style="width: 250px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($trackers) > 0): ?>
                        <?php $no = 1; foreach ($trackers as $tracker): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($tracker['nama_mahasiswa']); ?></strong></td>
                                <td><span style="background: #eff6ff; color: var(--primary); padding: 4px 8px; border-radius: 4px; font-weight: 600; font-size: 0.85rem;"><?php echo htmlspecialchars($tracker['nama_skill']); ?></span></td>
                                <td>
                                    <?php 
                                    $lvl = htmlspecialchars($tracker['level_skill']);
                                    $lvl_class = 'background: #f1f5f9; color: #475569;';
                                    if ($lvl == 'Beginner') {
                                        $lvl_class = 'background: #eff6ff; color: #1d4ed8;';
                                    } elseif ($lvl == 'Intermediate') {
                                        $lvl_class = 'background: #fff7ed; color: #c2410c;';
                                    } elseif ($lvl == 'Advanced') {
                                        $lvl_class = 'background: #faf5ff; color: #6b21a8;';
                                    }
                                    ?>
                                    <span style="<?php echo $lvl_class; ?> padding: 4px 8px; border-radius: 4px; font-weight: 700; font-size: 0.8rem;"><?php echo $lvl; ?></span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="flex: 1; background: #e2e8f0; height: 8px; border-radius: 4px; overflow: hidden; position: relative;">
                                            <div style="background: var(--primary); width: <?php echo (int)$tracker['progress_persen']; ?>%; height: 100%; border-radius: 4px;"></div>
                                        </div>
                                        <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-main); min-width: 35px; text-align: right;"><?php echo (int)$tracker['progress_persen']; ?>%</span>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                    $status = htmlspecialchars($tracker['status']);
                                    $status_style = 'background: #f1f5f9; color: #475569;';
                                    if ($status == 'Selesai') {
                                        $status_style = 'background: #dcfce3; color: #15803d;';
                                    } elseif ($status == 'Sedang Belajar' || $status == 'Belajar') {
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
                                    <small style="color: var(--text-muted); font-weight: 600;">
                                        <i class="fa-regular fa-clock" style="margin-right: 4px;"></i><?php echo date('d M Y, H:i', strtotime($tracker['tanggal_update'])); ?>
                                    </small>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="../progress_skill_tracker/index.php?search=<?php echo urlencode($tracker['nama_mahasiswa']); ?>" class="btn-sm" style="background: #8b5cf6; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;" title="Lihat Detail Progress">
                                            <i class="fa-solid fa-history"></i> Progress
                                        </a>
                                        <a href="edit.php?id=<?php echo $tracker['id']; ?>" class="btn-sm" style="background: #3b82f6; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        <a href="delete.php?id=<?php echo $tracker['id']; ?>" class="btn-sm" style="background: #ef4444; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data tracker ini? Semua riwayat progress terkait akan ikut terhapus.');">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px; color: var(--text-muted);">Belum ada data skill tracker mahasiswa.</td>
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
