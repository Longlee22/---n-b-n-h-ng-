<?php
$badge = $product['badge'] ?? '';
?>
<div class="product-card">
    <a href="product.php?id=<?= (int)$product['id'] ?>" class="product-image-wrap">
        <?php if ($badge): ?><span class="badge"><?= e($badge) ?></span><?php endif; ?>
        <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>">
    </a>
    <div class="product-info">
        <div class="product-type"><?= $product['category'] === 'phone' ? 'ĐIỆN THOẠI' : 'PHỤ KIỆN' ?></div>
        <a href="product.php?id=<?= (int)$product['id'] ?>" class="product-name"><?= e($product['name']) ?></a>
        <div class="rating">★★★★★ <span>(<?= (int)$product['sold'] ?> đã bán)</span></div>
        <div class="price-row">
            <strong><?= money($product['price']) ?></strong>
            <?php if ($product['old_price'] > $product['price']): ?>
                <del><?= money($product['old_price']) ?></del>
            <?php endif; ?>
        </div>
        <a class="btn btn-primary btn-small" href="product.php?id=<?= (int)$product['id'] ?>">Xem sản phẩm</a>
    </div>
</div>
