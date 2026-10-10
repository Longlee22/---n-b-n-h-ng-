<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $pageTitle ?? 'CLICKBUY - Điện thoại & phụ kiện';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container topbar-inner">
        <a class="logo" href="index.php">
            <span class="logo-mark">◆</span>
            <span>CLICK<span>BUY</span></span>
        </a>

        <form class="search" action="phones.php" method="get">
            <input type="text" name="q" placeholder="Bạn cần tìm gì..." value="<?= e($_GET['q'] ?? '') ?>">
            <button type="submit">⌕</button>
        </form>

        <div class="top-actions">
            <a href="phones.php">Điện thoại</a>
            <a href="accessories.php">Phụ kiện</a>
            <a href="cart.php">🛒 Giỏ hàng <b>(<?= cartCount() ?>)</b></a>
            <?php if (!empty($_SESSION['user'])): ?>
                <a href="logout.php">👤 <?= e($_SESSION['user']['name']) ?> · Đăng xuất</a>
            <?php else: ?>
                <a href="login.php">👤 Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="notice">
    <div class="container">🔥 Ưu đãi hôm nay · Trả góp 0% · Miễn phí giao hàng đơn từ 500.000đ</div>
</div>

<main class="container">
