<?php
require_once 'config.php';

$pageTitle = 'Long - Trang chủ';

$hot = $pdo->query("SELECT * FROM products WHERE is_hot=1 ORDER BY id DESC LIMIT 6")->fetchAll();
$accessories = $pdo->query("SELECT * FROM products WHERE category='accessory' ORDER BY is_hot DESC, id DESC LIMIT 4")->fetchAll();

require 'includes/header.php';
?>

<section class="hero">
    <div class="hero-copy">
        <span class="eyebrow">Long STORE</span>
        <h1>Điện thoại & phụ kiện<br><span>công nghệ mới</span></h1>
        <p>Khám phá những mẫu điện thoại nổi bật, phụ kiện tiện ích và nhiều ưu đãi hấp dẫn.</p>
        <div class="hero-buttons">
            <a class="btn btn-white" href="phones.php">Xem điện thoại</a>
            <a class="btn btn-outline-white" href="accessories.php">Xem phụ kiện</a>
        </div>
    </div>
    <div class="hero-phone">
        <div class="phone-mock">
            <div class="camera"></div><div class="camera"></div><div class="camera"></div>
            <div class="phone-screen">18<br><small>PRO</small></div>
        </div>
    </div>
</section>

<section class="quick-cats">
    <a href="phones.php"><span>📱</span><b>Điện thoại</b><small>iPhone · Samsung · Xiaomi</small></a>
    <a href="accessories.php"><span>🎧</span><b>Phụ kiện</b><small>Tai nghe · Sạc · Ốp lưng</small></a>
    <a href="cart.php"><span>🛒</span><b>Giỏ hàng</b><small>Xem sản phẩm đã chọn</small></a>
    <a href="login.php"><span>👤</span><b>Tài khoản</b><small>Đăng nhập / đăng ký</small></a>
</section>

<section class="section">
    <div class="section-heading">
        <div>
            <span class="eyebrow red">NỔI BẬT</span>
            <h2>Điện thoại hot</h2>
        </div>
        <a href="phones.php">Xem tất cả →</a>
    </div>
    <div class="product-grid">
        <?php foreach ($hot as $product): include 'includes/product_card.php'; endforeach; ?>
    </div>
</section>

<section class="banner">
    <div>
        <span class="eyebrow">ƯU ĐÃI PHỤ KIỆN</span>
        <h2>Phụ kiện chính hãng<br>giá tốt mỗi ngày</h2>
        <p>Sạc nhanh, tai nghe, ốp lưng và nhiều sản phẩm tiện ích.</p>
        <a class="btn btn-dark" href="accessories.php">Mua phụ kiện</a>
    </div>
    <div class="accessory-art">🎧</div>
</section>

<section class="section">
    <div class="section-heading">
        <div>
            <span class="eyebrow red">PHỤ KIỆN</span>
            <h2>Phụ kiện bán chạy</h2>
        </div>
        <a href="accessories.php">Xem tất cả →</a>
    </div>
    <div class="product-grid">
        <?php foreach ($accessories as $product): include 'includes/product_card.php'; endforeach; ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
