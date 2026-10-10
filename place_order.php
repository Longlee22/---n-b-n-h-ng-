<?php
require_once 'config.php';

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$fullname = trim($_POST['fullname'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$city = trim($_POST['city'] ?? '');
$address = trim($_POST['address'] ?? '');
$note = trim($_POST['note'] ?? '');
$payment = $_POST['payment'] ?? 'COD';

if (!$fullname || !$phone || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$city || !$address) {
    die("Vui lòng nhập đầy đủ và đúng thông tin khách hàng.");
}

$cart = $_SESSION['cart'];
$ids = array_keys($cart);
$marks = implode(',', array_fill(0, count($ids), '?'));

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($marks) FOR UPDATE");
    $stmt->execute($ids);
    $products = $stmt->fetchAll();

    $total = 0;
    foreach ($products as $p) {
        $total += $p['price'] * $cart[$p['id']];
    }
    $shipping = $total >= 500000 ? 0 : 30000;
    $grandTotal = $total + $shipping;

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, fullname, phone, email, city, address, note, payment, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user']['id'] ?? null,
        $fullname, $phone, $email, $city, $address, $note, $payment, $grandTotal
    ]);
    $orderId = $pdo->lastInsertId();

    $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)");
    foreach ($products as $p) {
        $itemStmt->execute([$orderId, $p['id'], $p['name'], $p['price'], $cart[$p['id']]]);
    }

    $pdo->commit();
    $_SESSION['cart'] = [];

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    die("Có lỗi khi tạo đơn hàng: " . e($e->getMessage()));
}

$pageTitle = 'Đặt hàng thành công - CLICKBUY';
require 'includes/header.php';
?>
<div class="success">
    <div class="success-icon">✓</div>
    <h1>Đặt hàng thành công!</h1>
    <p>Cảm ơn <?= e($fullname) ?>. Đơn hàng <b>#<?= e($orderId) ?></b> đã được ghi nhận.</p>
    <p>Nhân viên sẽ liên hệ với bạn qua số <b><?= e($phone) ?></b> để xác nhận.</p>
    <div class="success-buttons">
        <a class="btn btn-primary" href="index.php">Về trang chủ</a>
        <a class="btn btn-light" href="phones.php">Tiếp tục mua sắm</a>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
