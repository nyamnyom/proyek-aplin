CREATE DATABASE proyek_aplin;
USE proyek_aplin;


CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    DESCRIPTION TEXT,
    price DECIMAL(10,2) NOT NULL,
    category ENUM('food', 'drink') NOT NULL,
    image_url VARCHAR(255) DEFAULT 'default.jpg',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO menus (NAME, DESCRIPTION, price, category, image_url) VALUES
('Nasi Goreng Spesial', 'Nasi goreng dengan telur dan ayam', 25000, 'food', 'https://source.unsplash.com/random/600x400?food=1'),
('Ayam Bakar Madu', 'Ayam bakar dengan bumbu madu', 35000, 'food', 'https://source.unsplash.com/random/600x400?food=2'),
('Es Teh Manis', 'Es teh dengan gula khusus', 8000, 'drink', 'https://source.unsplash.com/random/600x400?drink=1');


CREATE TABLE htrans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total INT,
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE dtrans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    htrans_id INT,
    item_name VARCHAR(100),
    qty INT,
    price INT,
    subtotal INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (htrans_id) REFERENCES htrans(id)
);