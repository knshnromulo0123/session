CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email_address VARCHAR(100) UNIQUE NOT NULL,
    user_name VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    product_price DECIMAL(10,2) NOT NULL,
    product_image VARCHAR(255) NOT NULL,
    category VARCHAR(50)
);

INSERT INTO products (product_name, product_price, product_image, category) VALUES
('Lotus Bracelet', 2345.00, 'image/lotusbrace.jpg', 'Bracelet'),
('Lotus Necklace', 2345.00, 'image/necklotus.jpg', 'Necklace'),
('Pearl Necklace', 1600.00, 'image/neckpearl.jpg', 'Necklace'),
('Necklace Tied Knot', 2499.00, 'image/necktied.jpg', 'Necklace'),
('Lotus Earrings', 2345.00, 'image/earlotus.jpg', 'Earrings'),
('Pearl Earrings', 1600.00, 'image/earpearl.jpg', 'Earrings'),
('Tied Knot Earrings', 1600.00, 'image/eartied.jpg', 'Earrings'),
('Pearl Bracelet', 1600.00, 'image/pearlbrace.jpg', 'Bracelet'),
('Tied Knot Bracelet', 1800.00, 'image/tiednotbrace.jpg', 'Bracelet');
