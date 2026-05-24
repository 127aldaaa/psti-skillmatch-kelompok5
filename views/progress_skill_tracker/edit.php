<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/skill_tracker.php';
require_once '../../functions/progress_skill_tracker.php';

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = sanitizeInput($_GET['id']);
$log = getProgressSkillTrackerById($id);

// Jika data tidak ditemukan
if (!$log) {
    header("Location: index.php");
    exit;
}

// Mendapatkan data tracker untuk dropdown
$trackers = getSkillTrackers();

// Menangani form submit untuk update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'skill_tracker_id' => (int)$_POST['skill_tracker_id'],
        'progress' => sanitizeInput($_POST['progress']),
        'catatan' => sanitizeInput($_POST['catatan']),
        'tanggal_progress' => sanitizeInput($_POST['tanggal_progress']),
        'status_progress' => sanitizeInput($_POST['status_progress'])
    ];
    
    updateProgressSkillTracker($id, $data);
    
    // Sinkronisasi progress persen & status di tabel skill_tracker utama demi integrasi premium!
    $tid = $data['skill_tracker_id'];
    $prog_status = $data['status_progress'];
    $tracker = getSkillTrackerById($tid);
    if ($tracker) {
        $new_percent = $tracker['progress_persen'];
        if ($prog_status == 'Selesai') {
            $new_percent = 100;
        } elseif ($prog_status == 'Hampir Selesai') {
            $new_percent = max($new_percent, 80);
        } elseif ($prog_status == 'Sedang Belajar') {
            $new_percent = max($new_percent, 25);
        } elseif ($prog_status == 'Belum Mulai') {
            $new_percent = 0;
        }
        
        $update_data = [
            'nama_mahasiswa' => $tracker['nama_mahasiswa'],
            'nama_skill' => $tracker['nama_skill'],
            'level_skill' => $tracker['level_skill'],
            'progress_persen' => $new_percent,
            'status' => $prog_status
        ];
        updateSkillTracker($tid, $update_data);
    }

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
        <h1>Edit Progress Skill Tracker</h1>
        <p>Perbarui rincian catatan perkembangan belajar mahasiswa.</p>
    </div>

    <div class="card" style="max-width: 800px;">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title">Form Edit Progress Belajar</h3>
            <a href="index.php" class="btn-sm" style="background: #6b7280; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="card-body" style="padding: 25px;">
            <form action="" method="POST">
                <div style="margin-bottom: 20px;">
                    <label for="skill_tracker_id" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Pilih Mahasiswa & Skill</label>
                    <select id="skill_tracker_id" name="skill_tracker_id" required 
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                        <option value="">-- Pilih Mahasiswa - Skill --</option>
                        <?php foreach ($trackers as $t): ?>
                            <option value="<?php echo $t['id']; ?>" <?php echo ($t['id'] == $log['skill_tracker_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($t['nama_mahasiswa']) . " - " . htmlspecialchars($t['nama_skill']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="progress" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Progress Belajar</label>
                    <input type="text" id="progress" name="progress" required value="<?php echo htmlspecialchars($log['progress']); ?>"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="catatan" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Catatan Detail (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="4"
                              style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit; resize: vertical;"><?php echo htmlspecialchars($log['catatan']); ?></textarea>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="tanggal_progress" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Tanggal Progress</label>
                    <input type="date" id="tanggal_progress" name="tanggal_progress" required value="<?php echo htmlspecialchars($log['tanggal_progress']); ?>"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="status_progress" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Status Progress</label>
                    <select id="status_progress" name="status_progress" required 
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Mulai" <?php echo ($log['status_progress'] == 'Belum Mulai') ? 'selected' : ''; ?>>Belum Mulai</option>
                        <option value="Sedang Belajar" <?php echo ($log['status_progress'] == 'Sedang Belajar') ? 'selected' : ''; ?>>Sedang Belajar</option>
                        <option value="Hampir Selesai" <?php echo ($log['status_progress'] == 'Hampir Selesai') ? 'selected' : ''; ?>>Hampir Selesai</option>
                        <option value="Selesai" <?php echo ($log['status_progress'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
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
