<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/skill_tracker.php';

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = sanitizeInput($_GET['id']);
$tracker = getSkillTrackerById($id);

// Jika data tidak ditemukan
if (!$tracker) {
    header("Location: index.php");
    exit;
}

// Menangani form submit untuk update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama_mahasiswa' => sanitizeInput($_POST['nama_mahasiswa']),
        'nama_skill' => sanitizeInput($_POST['nama_skill']),
        'level_skill' => sanitizeInput($_POST['level_skill']),
        'progress_persen' => (int)$_POST['progress_persen'],
        'status' => sanitizeInput($_POST['status'])
    ];
    
    updateSkillTracker($id, $data);
    
    // Redirect kembali ke halaman index setelah berhasil
    header("Location: index.php");
    exit;
}

// Include header
include '../../includes/header.php';
?>

<!-- Content Area -->
<div class="content-area">
    
    <div class="page-header">
        <h1>Edit Skill Tracker</h1>
        <p>Perbarui informasi perkembangan skill mahasiswa.</p>
    </div>

    <div class="card" style="max-width: 800px;">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title">Form Edit Skill Tracker</h3>
            <a href="index.php" class="btn-sm" style="background: #6b7280; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="card-body" style="padding: 25px;">
            <form action="" method="POST">
                <div style="margin-bottom: 20px;">
                    <label for="nama_mahasiswa" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Nama Mahasiswa</label>
                    <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" required value="<?php echo htmlspecialchars($tracker['nama_mahasiswa']); ?>"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="nama_skill" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Nama Skill</label>
                    <input type="text" id="nama_skill" name="nama_skill" required value="<?php echo htmlspecialchars($tracker['nama_skill']); ?>"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="level_skill" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Level Skill</label>
                    <select id="level_skill" name="level_skill" required 
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                        <option value="">-- Pilih Level Skill --</option>
                        <option value="Beginner" <?php echo ($tracker['level_skill'] == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
                        <option value="Intermediate" <?php echo ($tracker['level_skill'] == 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                        <option value="Advanced" <?php echo ($tracker['level_skill'] == 'Advanced') ? 'selected' : ''; ?>>Advanced</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="progress_persen" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Progress (%)</label>
                    <input type="number" id="progress_persen" name="progress_persen" min="0" max="100" required value="<?php echo (int)$tracker['progress_persen']; ?>"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="status" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Status</label>
                    <select id="status" name="status" required 
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Mulai" <?php echo ($tracker['status'] == 'Belum Mulai') ? 'selected' : ''; ?>>Belum Mulai</option>
                        <option value="Sedang Belajar" <?php echo ($tracker['status'] == 'Sedang Belajar') ? 'selected' : ''; ?>>Sedang Belajar</option>
                        <option value="Hampir Selesai" <?php echo ($tracker['status'] == 'Hampir Selesai') ? 'selected' : ''; ?>>Hampir Selesai</option>
                        <option value="Selesai" <?php echo ($tracker['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                    </select>
                </div>
                
                <div style="text-align: right;">
                    <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: bold; font-family: inherit; font-size: 15px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php
include '../../includes/footer.php';
?>
