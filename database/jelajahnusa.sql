CREATE DATABASE IF NOT EXISTS jelajahnusa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jelajahnusa;

CREATE TABLE IF NOT EXISTS admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS destinations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  slug VARCHAR(180) NOT NULL UNIQUE,
  province VARCHAR(100) NOT NULL,
  region VARCHAR(80) NOT NULL,
  category ENUM('Alam','Pantai','Budaya','Sejarah','Kota','Pegunungan') NOT NULL DEFAULT 'Alam',
  description TEXT NOT NULL,
  image_url VARCHAR(500) DEFAULT NULL,
  map_url VARCHAR(500) DEFAULT NULL,
  best_time VARCHAR(150) DEFAULT NULL,
  tips TEXT DEFAULT NULL,
  featured TINYINT(1) NOT NULL DEFAULT 0,
  status ENUM('published','draft') NOT NULL DEFAULT 'published',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_destination_filter (status, region, category),
  INDEX idx_destination_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL,
  subject VARCHAR(100) NOT NULL DEFAULT 'Saran',
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO admins (username,password_hash) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.')
ON DUPLICATE KEY UPDATE username=username;

INSERT INTO destinations (name,slug,province,region,category,description,image_url,map_url,best_time,tips,featured,status) VALUES
('Candi Borobudur','candi-borobudur','Jawa Tengah','Jawa','Sejarah','Candi Buddha bersejarah dengan relief yang menggambarkan perjalanan spiritual dan kehidupan masyarakat pada masa lampau. Pengunjung dapat menikmati arsitektur, lanskap, serta mempelajari nilai sejarah dan budaya kawasan.','https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Candi+Borobudur','Musim kemarau','Periksa jam kunjungan dan ketentuan akses area sebelum datang. Gunakan pemandu resmi bila ingin memahami sejarahnya lebih dalam.',1,'published'),
('Raja Ampat','raja-ampat','Papua Barat Daya','Maluku & Papua','Pantai','Kepulauan dengan perairan jernih, gugusan karst, dan keanekaragaman hayati laut yang luar biasa. Perjalanan ke Raja Ampat perlu direncanakan dengan memperhatikan transportasi, cuaca, serta konservasi laut.','https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Raja+Ampat','Umumnya Oktober–April, cek cuaca lokal','Jangan menyentuh terumbu karang atau memberi makan satwa laut. Bawa kembali sampah dan patuhi aturan kawasan konservasi.',1,'published'),
('Ubud','ubud-bali','Bali','Bali & Nusa Tenggara','Budaya','Ubud dikenal dengan seni, kerajinan, lanskap persawahan, serta ruang budaya yang terus hidup. Pengunjung dapat menjumpai galeri, pasar lokal, pertunjukan, dan jalur alam di sekitarnya.','https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Ubud+Bali','Sepanjang tahun; cek musim hujan','Hormati aturan pura dan upacara adat. Gunakan pakaian yang sesuai ketika memasuki tempat ibadah.',1,'published'),
('Gunung Bromo','gunung-bromo','Jawa Timur','Jawa','Pegunungan','Kawasan gunung berapi dengan lautan pasir dan panorama matahari terbit yang terkenal. Kondisi suhu bisa sangat dingin pada dini hari, sedangkan aktivitas vulkanik dapat memengaruhi akses kawasan.','https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Gunung+Bromo','Musim kemarau biasanya lebih cerah','Periksa status aktivitas vulkanik dan pengumuman resmi. Gunakan jaket hangat, masker, dan ikuti batas aman yang ditetapkan petugas.',1,'published'),
('Danau Toba','danau-toba','Sumatera Utara','Sumatra','Alam','Danau vulkanik luas yang dikelilingi perbukitan dan wilayah budaya Batak. Kawasan ini menawarkan panorama alam, desa budaya, kuliner, dan pengalaman perjalanan yang beragam.','https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Danau+Toba','Sepanjang tahun, sesuaikan dengan cuaca','Hormati adat setempat dan minta izin sebelum memotret orang atau kegiatan adat.',1,'published'),
('Tana Toraja','tana-toraja','Sulawesi Selatan','Sulawesi','Budaya','Wilayah dengan rumah adat Tongkonan, lanskap pegunungan, dan tradisi masyarakat Toraja. Kegiatan budaya tertentu memiliki aturan dan makna khusus yang perlu dipahami pengunjung.','https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Tana+Toraja','Juni–September sering menjadi periode kunjungan populer','Mintalah izin warga atau pemandu sebelum mengambil foto dan selalu hormati adat serta ruang sakral.',0,'published'),
('Kota Lama Semarang','kota-lama-semarang','Jawa Tengah','Jawa','Sejarah','Kawasan bersejarah dengan bangunan bergaya kolonial, ruang publik, museum, dan tempat kuliner. Area ini cocok dijelajahi dengan berjalan kaki sambil memperhatikan keselamatan di jalan.','https://images.unsplash.com/photo-1511818966892-d7d671e672a2?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Kota+Lama+Semarang','Pagi atau sore hari','Jaga kebersihan kawasan, patuhi aturan bangunan cagar budaya, dan waspada ketika menyeberang jalan.',0,'published'),
('Labuan Bajo','labuan-bajo','Nusa Tenggara Timur','Bali & Nusa Tenggara','Alam','Kota pelabuhan yang menjadi pintu menuju Taman Nasional Komodo dan pulau-pulau sekitarnya. Aktivitas laut dan trekking harus mengikuti arahan pemandu serta petugas kawasan.','https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Labuan+Bajo','April–November sering lebih kering','Ikuti aturan keselamatan kapal dan kawasan konservasi. Jangan mendekati komodo tanpa pemandu resmi.',0,'published'),
('Pantai Losari','pantai-losari','Sulawesi Selatan','Sulawesi','Pantai','Ruang publik tepi laut di Makassar yang populer untuk menikmati senja dan kuliner khas. Tempat ini juga menjadi bagian dari kehidupan kota dan aktivitas masyarakat setempat.','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Pantai+Losari','Sore menjelang matahari terbenam','Buang sampah pada tempatnya dan perhatikan kondisi cuaca serta area yang dibatasi.',0,'published'),
('Taman Nasional Tanjung Puting','tanjung-puting','Kalimantan Tengah','Kalimantan','Alam','Kawasan konservasi hutan tropis yang menjadi habitat orangutan dan beragam satwa. Pengalaman berkunjung perlu mengutamakan perlindungan satwa liar dan mengikuti aturan pengelola taman nasional.','https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=1200&q=85','https://maps.google.com/?q=Taman+Nasional+Tanjung+Puting','Musim kering relatif memudahkan perjalanan','Jangan memberi makan atau menyentuh satwa. Gunakan operator yang mengikuti pedoman konservasi dan bawa perlengkapan anti-serangga.',0,'published')
ON DUPLICATE KEY UPDATE name=VALUES(name);
