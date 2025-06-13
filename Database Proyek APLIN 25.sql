DROP DATABASE IF EXISTS proyek_aplin;
CREATE DATABASE proyek_aplin;
USE proyek_aplin;

CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description`TEXT,
    price INT NOT NULL,
    category ENUM('Makanan', 'Minuman') NOT NULL,
    image_url VARCHAR(255) DEFAULT 'default.jpg',
    total_ordered INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO menus (`name`, `description`, price, category, image_url, total_ordered) VALUES
('Nasi Goreng Spesial', 'Nasi goreng spesial dengan telur dan daging', 25000, 'Makanan', 'uploads/nasi_goreng_spesial.jpg', 8),
('Ayam Bakar Madu', 'Ayam bakar dengan bumbu madu special', 35000, 'Makanan', 'uploads/ayam_bakar_madu.jpeg', 6),
('Nasi Sancam Babi', 'Nasi dengan daging babi sancam', 50000, 'Makanan', 'uploads/nasi_sancam_babi.jpg', 8),
('Mie Chasio Babi', 'Mie dengan daging babi chasio', 45000, 'Makanan', 'uploads/mie_chasio_babi.jpg', 11),
('Mie Sancam Babi', 'Mie dengan daging babi sancam', 40000, 'Makanan', 'uploads/mie_sancam_babi.jpg', 8),
('Es Teh', 'Es teh yang diseduh dengan teh murni', 6000, 'Minuman', 'uploads/es_teh.jpg', 21);

CREATE TABLE reservasi_meja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    nomor_telepon VARCHAR(20) NOT NULL,
    tanggal_reservasi DATE NOT NULL,
    waktu_reservasi TIME NOT NULL,
    nomor_meja VARCHAR(5) NOT NULL,
    jumlah_tamu INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO reservasi_meja (nama_pelanggan, nomor_telepon, tanggal_reservasi, waktu_reservasi, nomor_meja, jumlah_tamu) VALUES
('Erick', '123456753', '2024-03-12', '15:00:00', 'T1', 3);


CREATE TABLE htrans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_method VARCHAR(50),
    total INT NOT NULL,
    kasir_id INT,
    status_ready INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO htrans (total, kasir_id, payment_method, created_at) VALUES
(310000, 1, 'cash', '2025-06-01 10:15:00'),
(78000, NULL, 'qris', '2025-06-02 09:30:00'),
(102000, NULL, 'qris', '2025-06-03 13:45:00'),
(176000, 1, 'cash', '2025-06-04 12:00:00'),
(153000, NULL, 'qris', '2025-06-05 14:20:00'),
(66000, 2, 'cash', '2025-06-06 15:10:00'),
(142000, NULL, 'qris', '2025-06-07 08:55:00'),
(86000, 2, 'cash', '2025-06-08 17:25:00'),
(96000, NULL, 'qris', '2025-06-09 19:00:00'),
(207000, 3, 'cash', '2025-06-10 11:05:00'),
(81000, NULL, 'qris', '2025-06-11 16:30:00'),
(127000, 1, 'cash', '2025-06-12 18:15:00');

CREATE TABLE dtrans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    htrans_id INT,
    item_name VARCHAR(255),
    qty INT,
    price INT,
    subtotal INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (htrans_id) REFERENCES htrans(id)
);

INSERT INTO dtrans (htrans_id, item_name, qty, price, subtotal) VALUES
(1, 'Nasi Sancam Babi', 2, 50000, 100000),
(1, 'Mie Chasio Babi', 1, 45000, 45000),
(1, 'Mie Sancam Babi', 3, 40000, 120000),
(1, 'Mie Chasio Babi', 1, 45000, 45000),
(2, 'Es Teh', 3, 6000, 18000),
(2, 'Ayam Bakar Madu', 1, 35000, 35000),
(2, 'Nasi Goreng Spesial', 1, 25000, 25000),
(3, 'Es Teh', 2, 6000, 12000),
(3, 'Mie Chasio Babi', 2, 45000, 90000),
(4, 'Ayam Bakar Madu', 2, 35000, 70000),
(4, 'Nasi Sancam Babi', 2, 50000, 100000),
(4, 'Es Teh', 1, 6000, 6000),
(5, 'Mie Sancam Babi', 1, 40000, 40000),
(5, 'Nasi Goreng Spesial', 2, 25000, 50000),
(5, 'Es Teh', 3, 6000, 18000),
(5, 'Mie Chasio Babi', 1, 45000, 45000),
(6, 'Ayam Bakar Madu', 1, 35000, 35000),
(6, 'Es Teh', 1, 6000, 6000),
(6, 'Nasi Goreng Spesial', 1, 25000, 25000),
(7, 'Mie Sancam Babi', 2, 40000, 80000),
(7, 'Es Teh', 2, 6000, 12000),
(7, 'Nasi Sancam Babi', 1, 50000, 50000),
(8, 'Mie Chasio Babi', 1, 45000, 45000),
(8, 'Es Teh', 1, 6000, 6000),
(8, 'Ayam Bakar Madu', 1, 35000, 35000),
(9, 'Nasi Goreng Spesial', 2, 25000, 50000),
(9, 'Es Teh', 1, 6000, 6000),
(9, 'Mie Sancam Babi', 1, 40000, 40000),
(10, 'Nasi Sancam Babi', 3, 50000, 150000),
(10, 'Es Teh', 2, 6000, 12000),
(10, 'Mie Chasio Babi', 1, 45000, 45000),
(11, 'Mie Sancam Babi', 1, 40000, 40000),
(11, 'Es Teh', 1, 6000, 6000),
(11, 'Ayam Bakar Madu', 1, 35000, 35000),
(12, 'Mie Chasio Babi', 2, 45000, 90000),
(12, 'Es Teh', 2, 6000, 12000),
(12, 'Nasi Goreng Spesial', 1, 25000, 25000);

SELECT SUM(total) FROM htrans;
SELECT SUM(subtotal) FROM dtrans;

CREATE TABLE `user` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    posisi ENUM('Kasir', 'Admin') NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `user` (username, nama, posisi, `password`) VALUES
('kasir1', 'Alexander Brick', 'Kasir', '$2y$10$Zl6d7s0tAGZMXRVoQVTMqunblUwgPT.eFNmg7YbGjdk8IFaSFZPMe'), -- Password : kasir
('kasir2', 'Dewi Sartika', 'Kasir', '$2y$10$Zl6d7s0tAGZMXRVoQVTMqunblUwgPT.eFNmg7YbGjdk8IFaSFZPMe'),
('kasir3', 'Budi Santoso', 'Kasir', '$2y$10$Zl6d7s0tAGZMXRVoQVTMqunblUwgPT.eFNmg7YbGjdk8IFaSFZPMe'),
('kasir4', 'Rina Wijaya', 'Kasir', '$2y$10$Zl6d7s0tAGZMXRVoQVTMqunblUwgPT.eFNmg7YbGjdk8IFaSFZPMe'),
('kasir5', 'Agus Pratama', 'Kasir', '$2y$10$Zl6d7s0tAGZMXRVoQVTMqunblUwgPT.eFNmg7YbGjdk8IFaSFZPMe');

CREATE TABLE meja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_meja VARCHAR(5) NOT NULL,
    kapasitas INT NOT NULL,
    `status` INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO meja (nomor_meja, kapasitas) VALUES
('T1', 4),
('T2', 4),
('T3', 2),
('T4', 6),
('T5', 6);

CREATE TABLE promo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_promo VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    kode_promo VARCHAR(100) NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO promo (nama_promo, deskripsi, kode_promo, tanggal_mulai, tanggal_selesai, is_active)
VALUES 
('Diskon Awal Tahun', 'Promo spesial untuk menyambut tahun baru.', 'NEWYEAR2025', '2025-01-01', '2025-01-15', 0),
('Ramadhan Sale', 'Promo spesial selama bulan Ramadhan.', 'RAMADHAN25', '2025-03-10', '2025-04-10', 0),
('Diskon Akhir Tahun', 'Tutup tahun dengan hemat.', 'YEAREND2025', '2025-12-15', '2025-12-31', 0),
('Promo Hari Spesial', 'Hanya berlaku hari ini!', 'SPECIALDAY', '2025-06-01', '2025-06-01', 1),
('Promo Kemerdekaan', 'Rayakan kemerdekaan dengan promo menarik.', 'MERDEKA45', '2025-08-10', '2025-08-20', 0),
('Promo Akhir Pekan', 'Hemat di akhir pekan.', 'WEEKEND20', '2025-05-30', '2025-06-02', 1),
('Diskon Ulang Tahun', 'Rayakan ulang tahun dengan diskon.', 'BIRTHDAY25', '2025-05-28', '2025-06-10', 1),
('Promo Valentine', 'Diskon 20% untuk pasangan!', 'LOVE20', '2025-02-10', '2025-02-15', 0),
('Promo Flash Sale', 'Promo kilat diskon gede.', 'FLASH50', '2025-06-01', '2025-06-05', 1),
('Promo Belanja 1', 'Promo spesial belanja hemat.', 'SHOPHEMAT', '2025-05-20', '2025-06-15', 1);

CREATE TABLE transaksi_promo (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kasir_id INT,
  promo_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (kasir_id) REFERENCES `user`(id),
  FOREIGN KEY (promo_id) REFERENCES promo(id)
);

CREATE TABLE `shift` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    hari_masuk ENUM('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu') NOT NULL DEFAULT 'Senin',
    jam_masuk TIME NOT NULL,
    jam_pulang TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES USER(id) ON DELETE CASCADE
);

INSERT INTO shift (user_id, hari_masuk, jam_masuk, jam_pulang) VALUES
(1, 'Senin', '10:00:00', '16:00:00'),
(1, 'Selasa', '16:00:00', '22:00:00'),
(1, 'Rabu', '10:00:00', '16:00:00'),
(1, 'Kamis', '16:00:00', '22:00:00'),
(1, 'Jumat', '10:00:00', '16:00:00'),
(1, 'Minggu', '10:00:00', '16:00:00'),
(2, 'Senin', '16:00:00', '22:00:00'),
(2, 'Selasa', '10:00:00', '16:00:00'),
(2, 'Rabu', '16:00:00', '22:00:00'),
(2, 'Kamis', '10:00:00', '16:00:00'),
(2, 'Jumat', '16:00:00', '22:00:00'),
(2, 'Sabtu', '10:00:00', '16:00:00'),
(3, 'Senin', '10:00:00', '16:00:00'),
(3, 'Selasa', '10:00:00', '16:00:00'),
(3, 'Kamis', '16:00:00', '22:00:00'),
(3, 'Jumat', '10:00:00', '16:00:00'),
(3, 'Sabtu', '16:00:00', '22:00:00'),
(3, 'Minggu', '10:00:00', '16:00:00'),
(4, 'Senin', '16:00:00', '22:00:00'),
(4, 'Selasa', '10:00:00', '16:00:00'),
(4, 'Rabu', '16:00:00', '22:00:00'),
(4, 'Kamis', '10:00:00', '16:00:00'),
(4, 'Sabtu', '10:00:00', '16:00:00'),
(4, 'Minggu', '16:00:00', '22:00:00'),
(5, 'Selasa', '16:00:00', '22:00:00'),
(5, 'Rabu', '10:00:00', '16:00:00'),
(5, 'Kamis', '16:00:00', '22:00:00'),
(5, 'Jumat', '10:00:00', '16:00:00'),
(5, 'Sabtu', '16:00:00', '22:00:00'),
(5, 'Minggu', '10:00:00', '16:00:00');
