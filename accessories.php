<?php
require_once 'config.php';
$pageTitle = 'Phụ kiện - Long';

$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM products WHERE category='accessory'";
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
        <h1>Phụ kiện điện thoại</h1>
        <p><?= count($products) ?> sản phẩm phụ kiện</p>
    </div>
    <div class="filter-pills">
        <a class="active" href="accessories.php">Tất cả</a>
        <a href="accessories.php?q=Tai nghe">Tai nghe</a>
        <a href="accessories.php?q=Sạc">Sạc</a>
        <a href="accessories.php?q=Ốp">Ốp lưng</a>
    </div>
</div>

<?php if ($q): ?><div class="search-result">Kết quả tìm kiếm cho: <b><?= e($q) ?></b></div><?php endif; ?>

<div class="product-grid">
    <?php foreach ($products as $product): include 'includes/product_card.php'; endforeach; ?>
</div>

<?php require 'includes/footer.php'; ?>
