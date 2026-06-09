<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/progress_skill_tracker.php';

$error = '';
$success = '';

// Cek ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = sanitizeInput($_GET['id']);
$progress = getProgressSkillTrackerById($id);

if (!$progress) {
    header("Location: index.php");
    exit;
}

// Ambil data untuk form select
$trackers = getAllSkillTrackers();

// Menangani form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'skill_tracker_id' => $_POST['skill_tracker_id'],
        'progress_persen' => $_POST['progress_persen'],
        'status_progress' => $_POST['status_progress'],
        'catatan' => $_POST['catatan']
    ];
    
    if (empty($data['skill_tracker_id']) || $data['progress_persen'] === '' || empty($data['status_progress'])) {
        $error = "Semua field yang wajib harus diisi!";
    } else {
        if (updateProgressSkillTracker($id, $data)) {
            $success = "Data progress berhasil diperbarui!";
            // Update data yang ditampilkan
            $progress = getProgressSkillTrackerById($id);
            header("refresh:1;url=index.php");
        } else {
            $error = "Gagal memperbarui data. Pastikan format benar.";
        }
    }
}

include '../../includes/header.php';
?>

<div class="content-area">
    <div class="page-header">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
            <a href="index.php" style="color: var(--text-muted); font-size: 1.2rem;"><i class="fa-solid fa-arrow-left"></i></a>
            <h1 style="margin: 0;">Edit Progress Skill</h1>
        </div>
        <p>Ubah data perkembangan skill mahasiswa.</p>
    </div>

    <div class="card" style="max-width: 800px;">
        <?php if ($error): ?>
            <div style="background: #fef2f2; border-left: 4px solid var(--danger); padding: 15px; margin-bottom: 20px; border-radius: 4px; color: #991b1b;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div style="background: #ecfdf5; border-left: 4px solid var(--success); padding: 15px; margin-bottom: 20px; border-radius: 4px; color: #166534;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Mahasiswa & Skill <span style="color: var(--danger);">*</span></label>
                <select name="skill_tracker_id" required style="width: 100%; padding: 10px 15px; border: 1px solid var(--border); border-radius: 8px; outline: none; font-size: 1rem;">
                    <option value="">-- Pilih Tracker Mahasiswa --</option>
                    <?php foreach ($trackers as $tracker): ?>
                        <option value="<?php echo $tracker['id']; ?>" <?php echo ($tracker['id'] == $progress['skill_tracker_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($tracker['nama_mahasiswa'] . ' - ' . $tracker['nama_skill']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Progress Persentase (%) <span style="color: var(--danger);">*</span></label>
                <input type="number" name="progress_persen" min="0" max="100" value="<?php echo htmlspecialchars($progress['progress_persen']); ?>" required style="width: 100%; padding: 10px 15px; border: 1px solid var(--border); border-radius: 8px; outline: none; font-size: 1rem;" placeholder="0-100">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Status Progress <span style="color: var(--danger);">*</span></label>
                <select name="status_progress" required style="width: 100%; padding: 10px 15px; border: 1px solid var(--border); border-radius: 8px; outline: none; font-size: 1rem;">
                    <option value="">-- Pilih Status --</option>
                    <option value="Belum Mulai" <?php echo ($progress['status_progress'] == 'Belum Mulai') ? 'selected' : ''; ?>>Belum Mulai</option>
                    <option value="Sedang Belajar" <?php echo ($progress['status_progress'] == 'Sedang Belajar') ? 'selected' : ''; ?>>Sedang Belajar</option>
                    <option value="Hampir Selesai" <?php echo ($progress['status_progress'] == 'Hampir Selesai') ? 'selected' : ''; ?>>Hampir Selesai</option>
                    <option value="Selesai" <?php echo ($progress['status_progress'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                </select>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Catatan</label>
                <textarea name="catatan" rows="4" style="width: 100%; padding: 10px 15px; border: 1px solid var(--border); border-radius: 8px; outline: none; font-size: 1rem;" placeholder="Opsional..."><?php echo htmlspecialchars($progress['catatan']); ?></textarea>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 1rem;">Perbarui Data</button>
                <a href="index.php" style="background: var(--bg); color: var(--text-main); border: 1px solid var(--border); padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 1rem; text-decoration: none;">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
