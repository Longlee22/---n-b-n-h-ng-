<?php
require_once 'config.php';
$pageTitle = 'Điện thoại - Long';

$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM products WHERE category='phone'";
$params = [];

if ($q !== '') {
    $sql .= " AND (name LIKE ? OR brand LIKE ?)";
    $params = ["%$q%", "%$q%"];
}
$sql .= " ORDER BY is_hot DESC, id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

require 'includes/header.php';
?>
<div class="page-head">
    <div>
        <span class="eyebrow red">DANH MỤC</span>
        <h1>Điện thoại</h1>
        <p><?= count($products) ?> sản phẩm điện thoại</p>
    </div>
    <div class="filter-pills">
        <a class="active" href="phones.php">Tất cả</a>
        <a href="phones.php?q=iPhone">iPhone</a>
        <a href="phones.php?q=Samsung">Samsung</a>
        <a href="phones.php?q=Xiaomi">Xiaomi</a>
    </div>
</div>

<?php if ($q): ?><div class="search-result">Kết quả tìm kiếm cho: <b><?= e($q) ?></b></div><?php endif; ?>

<div class="product-grid">
    <?php foreach ($products as $product): include 'includes/product_card.php'; endforeach; ?>
</div>

<?php require 'includes/footer.php'; ?>
