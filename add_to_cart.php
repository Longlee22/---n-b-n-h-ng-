<?php
require_once 'config.php';

$id = (int)($_POST['product_id'] ?? 0);
$qty = max(1, min(10, (int)($_POST['qty'] ?? 1)));

$stmt = $pdo->prepare("SELECT id FROM products WHERE id=?");
$stmt->execute([$id]);

if (!$stmt->fetch()) {
    die("Sản phẩm không tồn tại.");
}

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
$_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;

header('Location: cart.php');
exit;
?>
