CREATE TABLE IF NOT EXISTS `progress_skill_tracker` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `skill_tracker_id` INT NOT NULL,
  `progress` VARCHAR(255) NOT NULL,
  `catatan` TEXT NULL,
  `tanggal_progress` DATE NOT NULL,
  `status_progress` VARCHAR(50) NOT NULL,
  FOREIGN KEY (`skill_tracker_id`) REFERENCES `skill_tracker` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
