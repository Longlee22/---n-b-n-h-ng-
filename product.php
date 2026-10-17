<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    http_response_code(404);
    die("Không tìm thấy sản phẩm.");
}

$pageTitle = $product['name'] . ' - Long';

$colors = array_filter(array_map('trim', explode(',', $product['colors'])));

require 'includes/header.php';
?>
<div class="breadcrumb">
    <a href="index.php">Trang chủ</a> / 
    <a href="<?= $product['category'] === 'phone' ? 'phones.php' : 'accessories.php' ?>">
        <?= $product['category'] === 'phone' ? 'Điện thoại' : 'Phụ kiện' ?>
    </a> / <?= e($product['name']) ?>
</div>

<section class="detail">
    <div class="detail-image">
        <?php if ($product['badge']): ?><span class="badge large"><?= e($product['badge']) ?></span><?php endif; ?>
        <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>">
    </div>

    <div class="detail-content">
        <div class="product-type"><?= $product['category'] === 'phone' ? 'ĐIỆN THOẠI' : 'PHỤ KIỆN' ?></div>
        <h1><?= e($product['name']) ?></h1>
        <div class="rating big">★★★★★ <span>Đã bán <?= (int)$product['sold'] ?></span></div>

        <div class="detail-price">
            <strong><?= money($product['price']) ?></strong>
            <?php if ($product['old_price'] > $product['price']): ?><del><?= money($product['old_price']) ?></del><?php endif; ?>
        </div>

        <div class="detail-box">
            <b>Mô tả sản phẩm</b>
            <p><?= nl2br(e($product['description'])) ?></p>
        </div>

        <?php if ($colors): ?>
        <div class="option">
            <b>Màu sắc:</b>
            <div class="color-list">
                <?php foreach ($colors as $i => $color): ?>
                    <label>
                        <input type="radio" name="color_view" value="<?= e($color) ?>" <?= $i === 0 ? 'checked' : '' ?>>
                        <span><?= e($color) ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="detail-specs">
            <div><span>Thương hiệu</span><b><?= e($product['brand']) ?></b></div>
            <div><span>Bảo hành</span><b><?= e($product['warranty']) ?></b></div>
            <div><span>Tình trạng</span><b>Còn hàng</b></div>
        </div>

        <form action="add_to_cart.php" method="post" class="buy-form">
            <input type="hidden" name="product_id" value="<?= (int)$product['id'] ?>">
            <input type="hidden" name="color" id="selectedColor" value="<?= e($colors[0] ?? '') ?>">
            <div class="qty">
                <button type="button" onclick="changeQty(-1)">−</button>
                <input id="qty" type="number" name="qty" value="1" min="1" max="10">
                <button type="button" onclick="changeQty(1)">+</button>
            </div>
            <button class="btn btn-buy" type="submit">🛒 Mua ngay</button>
        </form>
    </div>
</section>

<section class="detail-extra">
    <h2>Thông tin sản phẩm</h2>
    <div class="info-table">
        <div><span>Sản phẩm</span><b><?= e($product['name']) ?></b></div>
        <div><span>Danh mục</span><b><?= $product['category'] === 'phone' ? 'Điện thoại' : 'Phụ kiện' ?></b></div>
        <div><span>Thương hiệu</span><b><?= e($product['brand']) ?></b></div>
        <div><span>Màu sắc</span><b><?= e($product['colors']) ?></b></div>
        <div><span>Bảo hành</span><b><?= e($product['warranty']) ?></b></div>
    </div>
</section>

<script>
document.querySelectorAll('input[name="color_view"]').forEach(el => {
    el.addEventListener('change', () => {
        document.getElementById('selectedColor').value = el.value;
    });
});
</script>

<?php require 'includes/footer.php'; ?>
