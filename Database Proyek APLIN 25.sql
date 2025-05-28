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
('Nasi Goreng Spesial', 'Nasi goreng spesial dengan telur dan daging', 25000, 'Makanan', 'nasi_goreng_spesial.jpg', 1),
('Ayam Bakar Madu', 'Ayam bakar dengan bumbu madu special', 35000, 'Makanan', 'ayam_bakar_madu.jpeg', 1),
('Nasi Semacem Babi', 'Nasi dengan daging babi semacem', 50000, 'Makanan', 'nasi_semacem_babi.jpg', 1),
('Mie Chachu Babi', 'Mie dengan daging babi chachu', 45000, 'Makanan', 'mie_chachu_babi.jpg', 1),
('Mie Semacem Babi', 'Mie dengan daging babi semacem', 40000, 'Makanan', 'mie_semacem_babi.jpg', 1),
('Es Teh', 'Es teh yang diseduh dengan teh murni', 6000, 'Minuman', 'eh_teh.jpg', 1);

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

INSERT INTO htrans (total, kasir_id, payment_method) VALUES
(310000, 1, 'cash'),
(78000, NULL, 'qris');

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
(1, 'Nasi Semacem Babi', 2, 50000, 100000),
(1, 'Mie Chachu Babi', 1, 45000, 45000),
(1, 'Mie Semacem Babi', 3, 40000, 120000),
(1, 'Mie Chachu Babi', 1, 45000, 45000),
(2, 'Es Teh', 3, 6000, 18000),
(2, 'Ayam Bakar Madu', 1, 35000, 35000),
(2, 'Nasi Goreng Spesial', 1, 25000, 25000);


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

INSERT INTO `user` (username, nama, posisi, PASSWORD) VALUES
('kasir', 'Alexander Brick', 'Kasir', '$2y$10$Zl6d7s0tAGZMXRVoQVTMqunblUwgPT.eFNmg7YbGjdk8IFaSFZPMe');


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

CREATE TABLE transaksi_promo (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kasir_id INT,
  promo_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (kasir_id) REFERENCES `user`(id),
  FOREIGN KEY (promo_id) REFERENCES promo(id)
);