CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    action VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO activity_log (user_name, action, description) VALUES 
('Budi Santoso', 'Registrasi', 'mendaftar sebagai pengguna baru.'), 
('Siti Aminah', 'Selesai Tes', 'menyelesaikan tes minat dan bakat.'), 
('Andi Wijaya', 'Selesai Kursus', 'menyelesaikan kursus Dasar Pemrograman Web.');
