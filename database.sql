CREATE DATABASE IF NOT EXISTS clickbuy_phone
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE clickbuy_phone;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    category ENUM('phone','accessory') NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    old_price DECIMAL(15,2) NOT NULL DEFAULT 0,
    image TEXT NOT NULL,
    colors VARCHAR(255) DEFAULT '',
    warranty VARCHAR(100) DEFAULT '12 tháng',
    description TEXT,
    sold INT DEFAULT 0,
    is_hot TINYINT(1) DEFAULT 0,
    badge VARCHAR(100) DEFAULT ''
);

INSERT INTO products
(name, brand, category, price, old_price, image, colors, warranty, description, sold, is_hot, badge)
VALUES
('iPhone 18 Pro 256GB', 'Apple', 'phone', 34990000, 37990000,
 'https://images.unsplash.com/photo-1592286927505-2fd0b7a11d03?auto=format&fit=crop&w=700&q=85',
 'Đen Titan, Bạc, Tím', '12 tháng',
 'Mẫu điện thoại cao cấp với thiết kế hiện đại, màn hình sắc nét, hiệu năng mạnh và hệ thống camera đa năng.',
 128, 1, 'HOT'),

('Samsung Galaxy S26 Ultra 256GB', 'Samsung', 'phone', 31990000, 34990000,
 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=700&q=85',
 'Đen, Bạc, Tím', '12 tháng',
 'Điện thoại màn hình lớn, camera độ phân giải cao, hiệu năng mạnh và hỗ trợ nhiều tính năng AI.',
 96, 1, 'HOT'),

('Xiaomi 17 Ultra 512GB', 'Xiaomi', 'phone', 23990000, 25990000,
 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=700&q=85',
 'Đen, Trắng, Xanh', '12 tháng',
 'Thiết kế cao cấp, cấu hình mạnh, bộ nhớ lớn và hệ thống camera hướng đến trải nghiệm chụp ảnh.',
 73, 1, 'GIẢM 2TR'),

('OPPO Find X9 Pro', 'OPPO', 'phone', 22990000, 24990000,
 'https://images.unsplash.com/photo-1556656793-08538906a9f8?auto=format&fit=crop&w=700&q=85',
 'Đen, Trắng', '12 tháng',
 'Thiết kế mỏng, màn hình đẹp và camera tối ưu cho nhu cầu chụp ảnh hàng ngày.',
 61, 1, 'MỚI'),

('Vivo X300 Pro', 'Vivo', 'phone', 19990000, 21990000,
 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=700&q=85',
 'Đen, Xanh', '12 tháng',
 'Smartphone hiệu năng cao với màn hình sống động và thời lượng pin phù hợp cho sử dụng cả ngày.',
 45, 1, 'HOT'),

('iPhone 17 256GB', 'Apple', 'phone', 22990000, 24990000,
 'https://images.unsplash.com/photo-1603899122634-f086ca5f5ddd?auto=format&fit=crop&w=700&q=85',
 'Đen, Trắng, Xanh', '12 tháng',
 'Thiết kế hiện đại, hiệu năng ổn định và hệ sinh thái Apple tiện lợi.',
 88, 1, 'BÁN CHẠY'),

('AirPods Pro', 'Apple', 'accessory', 5990000, 6490000,
 'https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?auto=format&fit=crop&w=700&q=85',
 'Trắng', '12 tháng',
 'Tai nghe không dây nhỏ gọn, hỗ trợ chống ồn chủ động và kết nối thuận tiện với thiết bị Apple.',
 152, 1, 'HOT'),

('Sạc nhanh 65W USB-C', 'CLICKBUY', 'accessory', 490000, 650000,
 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?auto=format&fit=crop&w=700&q=85',
 'Trắng, Đen', '12 tháng',
 'Củ sạc công suất cao, thiết kế nhỏ gọn, phù hợp với nhiều thiết bị hỗ trợ USB-C.',
 205, 1, 'GIẢM 25%'),

('Ốp lưng MagSafe trong suốt', 'CLICKBUY', 'accessory', 290000, 390000,
 'https://images.unsplash.com/photo-1601593346740-925612772716?auto=format&fit=crop&w=700&q=85',
 'Trong suốt, Khói', '6 tháng',
 'Ốp lưng bảo vệ điện thoại, thiết kế trong suốt và hỗ trợ phụ kiện MagSafe.',
 133, 1, 'BÁN CHẠY'),

('Cáp USB-C to USB-C 100W', 'CLICKBUY', 'accessory', 190000, 250000,
 'https://images.unsplash.com/photo-1625842268584-8f3296236761?auto=format&fit=crop&w=700&q=85',
 'Trắng, Đen', '6 tháng',
 'Cáp sạc và truyền dữ liệu USB-C công suất cao, phù hợp với điện thoại, tablet và laptop.',
 174, 1, 'GIÁ TỐT'),

('Kính cường lực 9H', 'CLICKBUY', 'accessory', 120000, 180000,
 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?auto=format&fit=crop&w=700&q=85',
 'Trong suốt', '6 tháng',
 'Kính bảo vệ màn hình với độ cứng cao, hạn chế trầy xước trong quá trình sử dụng.',
 301, 0, 'GIÁ TỐT'),

('Giá đỡ điện thoại để bàn', 'CLICKBUY', 'accessory', 250000, 320000,
 'https://images.unsplash.com/photo-1616348436168-de43ad0db179?auto=format&fit=crop&w=700&q=85',
 'Đen, Bạc', '6 tháng',
 'Giá đỡ nhỏ gọn, tiện xem video, học tập và làm việc tại bàn.',
 79, 0, 'MỚI');

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    fullname VARCHAR(120) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(190) NOT NULL,
    city VARCHAR(120) NOT NULL,
    address VARCHAR(255) NOT NULL,
    note TEXT,
    payment VARCHAR(30) NOT NULL DEFAULT 'COD',
    total_amount DECIMAL(15,2) NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'Chờ xác nhận',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    quantity INT NOT NULL,
    CONSTRAINT fk_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);
