CREATE TABLE IF NOT EXISTS `skill_tracker` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_mahasiswa` VARCHAR(255) NOT NULL,
  `nama_skill` VARCHAR(255) NOT NULL,
  `level_skill` VARCHAR(50) NOT NULL,
  `progress_persen` INT NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `tanggal_update` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `skill_tracker` (`nama_mahasiswa`, `nama_skill`, `level_skill`, `progress_persen`, `status`) VALUES 
('Nazwa Aulia Fitri', 'PHP Native', 'Intermediate', 60, 'Sedang Belajar'),
('Niha Karina', 'JavaScript', 'Beginner', 30, 'Sedang Belajar'),
('Muhammad Rayhan', 'Figma', 'Advanced', 90, 'Hampir Selesai');
