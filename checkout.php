<?php
require_once 'config.php';
$pageTitle = 'Thanh toán - Long';

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'];
$ids = array_keys($cart);
$marks = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($marks)");
$stmt->execute($ids);

$items = $stmt->fetchAll();
$total = 0;
foreach ($items as &$item) {
    $item['qty'] = $cart[$item['id']];
    $total += $item['qty'] * $item['price'];
}
unset($item);

$shipping = $total >= 500000 ? 0 : 30000;
$grandTotal = $total + $shipping;

require 'includes/header.php';
?>
<div class="page-head simple">
    <div><span class="eyebrow red">CHECKOUT</span><h1>Thông tin đặt hàng</h1></div>
</div>

<form action="place_order.php" method="post" class="checkout-layout">
    <div class="checkout-form">
        <h2>Thông tin khách hàng</h2>
        <div class="form-grid">
            <label>Họ và tên *
                <input required type="text" name="fullname" value="<?= e($_SESSION['user']['name'] ?? '') ?>" placeholder="Nguyễn Văn A">
            </label>
            <label>Số điện thoại *
                <input required type="tel" name="phone" placeholder="09xxxxxxxx">
            </label>
            <label>Email *
                <input required type="email" name="email" value="<?= e($_SESSION['user']['email'] ?? '') ?>" placeholder="example@gmail.com">
            </label>
            <label>Tỉnh / Thành phố *
                <input required type="text" name="city" placeholder="Hà Nội">
            </label>
            <label class="full-field">Địa chỉ nhận hàng *
                <input required type="text" name="address" placeholder="Số nhà, đường, phường/xã...">
            </label>
            <label class="full-field">Ghi chú
                <textarea name="note" rows="4" placeholder="Ghi chú cho cửa hàng (nếu có)"></textarea>
            </label>
        </div>

        <h2>Phương thức thanh toán</h2>
        <label class="payment-option"><input type="radio" name="payment" value="COD" checked> <b>Thanh toán khi nhận hàng (COD)</b></label>
        <label class="payment-option"><input type="radio" name="payment" value="BANK"> <b>Chuyển khoản ngân hàng</b></label>
    </div>

    <aside class="summary">
        <h2>Đơn hàng của bạn</h2>
        <?php foreach ($items as $item): ?>
            <div class="mini-product">
                <span><?= e($item['name']) ?> × <?= (int)$item['qty'] ?></span>
                <b><?= money($item['qty'] * $item['price']) ?></b>
            </div>
        <?php endforeach; ?>
        <hr>
        <div><span>Tạm tính</span><b><?= money($total) ?></b></div>
        <div><span>Giao hàng</span><b><?= $shipping ? money($shipping) : 'Miễn phí' ?></b></div>
        <div class="summary-total"><span>Tổng</span><strong><?= money($grandTotal) ?></strong></div>
        <button class="btn btn-buy full" type="submit">Xác nhận đặt hàng</button>
    </aside>
</form>

<?php require 'includes/footer.php'; ?>
