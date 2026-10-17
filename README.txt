Long PHONE STORE - PHP + MYSQL
====================================

1. YÊU CẦU
- XAMPP
- PHP 8+
- MySQL
- Trình duyệt Chrome/Edge

2. CÀI ĐẶT
- Copy nguyên thư mục "clickbuy_phone_store" vào:
  C:\xampp\htdocs\

- Mở XAMPP và Start:
  Apache
  MySQL

- Vào phpMyAdmin:
  http://localhost/phpmyadmin

- Chọn Import -> chọn database.sql -> Go.
  Hoặc mở SQL và chạy toàn bộ file database.sql.

3. CHẠY WEBSITE
Mở:
http://localhost/clickbuy_phone_store/

4. CÁC TRANG CHÍNH
index.php          Trang chủ
phones.php        Tất cả điện thoại
accessories.php   Tất cả phụ kiện
product.php?id=1  Trang riêng từng sản phẩm
cart.php          Giỏ hàng
checkout.php      Nhập thông tin đặt hàng
register.php      Đăng ký
login.php         Đăng nhập
logout.php        Đăng xuất

5. TÍNH NĂNG
- Trang chủ có sản phẩm hot + phụ kiện
- Điện thoại và phụ kiện tách riêng
- Trang riêng từng sản phẩm
- Chọn màu sắc
- Chọn số lượng
- Mua ngay -> giỏ hàng
- Checkout: họ tên, số điện thoại, Gmail, tỉnh/thành, địa chỉ, ghi chú
- COD / chuyển khoản
- Đăng ký tài khoản
- Đăng nhập bằng password_hash/password_verify
- Lưu đơn hàng vào MySQL
- Responsive cho máy tính và điện thoại

6. LƯU Ý
Ảnh sản phẩm trong database đang dùng URL ảnh mẫu trên Internet.
Nếu muốn website chạy hoàn toàn offline, thay cột image trong database bằng ảnh local trong assets/img/.
