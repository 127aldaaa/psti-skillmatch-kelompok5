<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/skill.php';

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$skill = getSkillById($id);

// Jika data tidak ditemukan, kembalikan ke index
if (!$skill) {
    header("Location: index.php");
    exit;
}

// Menangani form submit untuk update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama_skill' => sanitizeInput($_POST['nama_skill']),
        'kategori' => sanitizeInput($_POST['kategori']),
        'deskripsi' => sanitizeInput($_POST['deskripsi'])
    ];
    
    updateSkill($id, $data);
    
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
        <h1>Edit Data Skill</h1>
        <p>Perbarui informasi data skill pada sistem.</p>
    </div>

    <div class="card" style="max-width: 800px;">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title">Form Edit Skill</h3>
            <a href="index.php" class="btn-sm" style="background: #6b7280; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="card-body" style="padding: 25px;">
            <form action="" method="POST">
                <div style="margin-bottom: 20px;">
                    <label for="nama_skill" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Nama Skill</label>
                    <input type="text" id="nama_skill" name="nama_skill" value="<?php echo htmlspecialchars($skill['nama_skill']); ?>" required 
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="kategori" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Kategori</label>
                    <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($skill['kategori']); ?>" required 
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>
                
                <div style="margin-bottom: 25px;">
                    <label for="deskripsi" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="5" required 
                              style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit; resize: vertical;"><?php echo htmlspecialchars($skill['deskripsi']); ?></textarea>
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
// Include footer
include '../../includes/footer.php';
?>
