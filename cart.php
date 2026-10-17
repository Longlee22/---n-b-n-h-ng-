<?php
require_once 'config.php';
$pageTitle = 'Giỏ hàng - Long';

$cart = $_SESSION['cart'] ?? [];
$items = [];
$total = 0;

if ($cart) {
    $ids = array_keys($cart);
    $marks = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($marks)");
    $stmt->execute($ids);
    foreach ($stmt->fetchAll() as $p) {
        $p['qty'] = $cart[$p['id']];
        $p['line_total'] = $p['qty'] * $p['price'];
        $total += $p['line_total'];
        $items[] = $p;
    }
}

require 'includes/header.php';
?>
<div class="page-head simple">
    <div><span class="eyebrow red">ĐƠN HÀNG</span><h1>Giỏ hàng</h1></div>
</div>

<?php if (!$items): ?>
    <div class="empty">
        <div>🛒</div>
        <h2>Giỏ hàng đang trống</h2>
        <p>Hãy chọn một sản phẩm bạn thích.</p>
        <a class="btn btn-primary" href="phones.php">Mua điện thoại</a>
    </div>
<?php else: ?>
<div class="cart-layout">
    <div class="cart-list">
        <?php foreach ($items as $item): ?>
        <div class="cart-item">
            <img src="<?= e($item['image']) ?>" alt="<?= e($item['name']) ?>">
            <div class="cart-item-info">
                <a href="product.php?id=<?= (int)$item['id'] ?>"><h3><?= e($item['name']) ?></h3></a>
                <p><?= e($item['brand']) ?></p>
                <strong><?= money($item['price']) ?></strong>
            </div>
            <form action="update_cart.php" method="post" class="cart-qty">
                <input type="hidden" name="product_id" value="<?= (int)$item['id'] ?>">
                <input type="number" name="qty" min="0" max="10" value="<?= (int)$item['qty'] ?>">
                <button class="btn btn-light btn-small">Cập nhật</button>
            </form>
            <div class="line-total"><?= money($item['line_total']) ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <aside class="summary">
        <h2>Tóm tắt đơn hàng</h2>
        <div><span>Tạm tính</span><b><?= money($total) ?></b></div>
        <div><span>Phí giao hàng</span><b><?= $total >= 500000 ? 'Miễn phí' : money(30000) ?></b></div>
        <hr>
        <div class="summary-total"><span>Tổng cộng</span><strong><?= money($total + ($total >= 500000 ? 0 : 30000)) ?></strong></div>
        <a class="btn btn-buy full" href="checkout.php">Tiến hành đặt hàng</a>
    </aside>
</div>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
