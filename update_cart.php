<?php
require_once 'config.php';
$id = (int)($_POST['product_id'] ?? 0);
$qty = (int)($_POST['qty'] ?? 0);

if ($qty <= 0) unset($_SESSION['cart'][$id]);
else $_SESSION['cart'][$id] = min(10, $qty);

header('Location: cart.php');
exit;
?>
