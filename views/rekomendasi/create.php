<?php
require_once '../../config.php';
require_once '../../functions/helper.php';
require_once '../../functions/rekomendasi.php';

$error = '';
$success = '';

// Menangani form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $peminatan_id = isset($_POST['peminatan_id']) ? sanitizeInput($_POST['peminatan_id']) : '';
    $skill_id = isset($_POST['skill_id']) ? sanitizeInput($_POST['skill_id']) : '';
    
    if (empty($peminatan_id) || empty($skill_id)) {
        $error = "Peminatan dan Skill harus dipilih!";
    } else {
        $result = tambahRekomendasi($peminatan_id, $skill_id);
        if ($result) {
            $success = "Rekomendasi berhasil ditambahkan!";
        } else {
            $error = "Gagal menambahkan rekomendasi. Mungkin relasi sudah ada atau terjadi kesalahan database.";
        }
    }
}

// Mendapatkan data untuk dropdown
$list_peminatan = getSemuaPeminatan();
$list_skill = getSemuaSkill();

// Include header
include '../../includes/header.php';
?>

<!-- Content Area -->
<div class="content-area">
    
    <!-- Header Content -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h1>Tambah Rekomendasi Skill</h1>
            <p>Pilih peminatan dan skill yang direkomendasikan.</p>
        </div>
        <a href="index.php" class="btn-sm" style="background: var(--text-muted); color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if (!empty($error)): ?>
        <div style="background: #fee2e2; color: #ef4444; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #ef4444;">
            <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div style="background: #dcfce3; color: #22c55e; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #22c55e;">
            <i class="fa-solid fa-circle-check"></i> <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <!-- Form Tambah Rekomendasi -->
    <div class="card" style="max-width: 600px;">
        <div class="card-header">
            <h3 class="card-title">Form Rekomendasi</h3>
        </div>
        <div class="card-body" style="padding: 20px;">
            <form action="create.php" method="POST">
                
                <div style="margin-bottom: 15px;">
                    <label for="peminatan_id" style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-main);">Peminatan</label>
                    <select id="peminatan_id" name="peminatan_id" required style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; outline: none; background: white; font-family: 'Inter', sans-serif;">
                        <option value="">-- Pilih Peminatan --</option>
                        <?php foreach ($list_peminatan as $p): ?>
                            <option value="<?php echo htmlspecialchars($p['id']); ?>">
                                <?php echo htmlspecialchars($p['nama_peminatan']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="skill_id" style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-main);">Skill yang Direkomendasikan</label>
                    <select id="skill_id" name="skill_id" required style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; outline: none; background: white; font-family: 'Inter', sans-serif;">
                        <option value="">-- Pilih Skill --</option>
                        <?php foreach ($list_skill as $s): ?>
                            <option value="<?php echo htmlspecialchars($s['id_skill']); ?>">
                                <?php echo htmlspecialchars($s['nama_skill']); ?> (<?php echo htmlspecialchars($s['kategori']); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div style="display: flex; gap: 10px;">
                    <button type="submit" style="background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 500; font-family: 'Inter', sans-serif;">
                        <i class="fa-solid fa-save"></i> Simpan Rekomendasi
                    </button>
                    <a href="index.php" style="background: var(--bg-main); color: var(--text-main); border: 1px solid var(--border); padding: 10px 20px; border-radius: 6px; cursor: pointer; text-decoration: none; font-weight: 500; display: inline-block;">
                        Batal
                    </a>
                </div>
                
            </form>
        </div>
    </div>

</div>

<?php
// Include footer
include '../../includes/footer.php';
?>
