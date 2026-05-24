<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/skill_tracker.php';

// Menangani form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama_mahasiswa' => sanitizeInput($_POST['nama_mahasiswa']),
        'nama_skill' => sanitizeInput($_POST['nama_skill']),
        'level_skill' => sanitizeInput($_POST['level_skill']),
        'progress_persen' => (int)$_POST['progress_persen'],
        'status' => sanitizeInput($_POST['status'])
    ];
    
    addSkillTracker($data);
    
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
        <h1>Tambah Skill Tracker Baru</h1>
        <p>Hubungkan mahasiswa dengan skill yang akan mereka kembangkan.</p>
    </div>

    <div class="card" style="max-width: 800px;">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title">Form Tambah Skill Tracker</h3>
            <a href="index.php" class="btn-sm" style="background: #6b7280; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="card-body" style="padding: 25px;">
            <form action="" method="POST">
                <div style="margin-bottom: 20px;">
                    <label for="nama_mahasiswa" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Nama Mahasiswa</label>
                    <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" required placeholder="Masukkan nama lengkap mahasiswa"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="nama_skill" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Nama Skill</label>
                    <input type="text" id="nama_skill" name="nama_skill" required placeholder="Contoh: PHP Native, Figma, ReactJS"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="level_skill" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Level Skill</label>
                    <select id="level_skill" name="level_skill" required 
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                        <option value="">-- Pilih Level Skill --</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="progress_persen" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Progress (%)</label>
                    <input type="number" id="progress_persen" name="progress_persen" min="0" max="100" required placeholder="Contoh: 45"
                           style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="status" style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Status</label>
                    <select id="status" name="status" required 
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text-main); font-family: inherit;">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Mulai">Belum Mulai</option>
                        <option value="Sedang Belajar">Sedang Belajar</option>
                        <option value="Hampir Selesai">Hampir Selesai</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                
                <div style="text-align: right;">
                    <button type="submit" style="background: #22c55e; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: bold; font-family: inherit; font-size: 15px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-save"></i> Simpan Tracker
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php
include '../../includes/footer.php';
?>
