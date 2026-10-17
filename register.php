<?php
require_once 'config.php';
$pageTitle = 'Đăng ký tài khoản - Long';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Vui lòng nhập họ tên và email hợp lệ.';
    } elseif (strlen($password) < 6) {
        $error = 'Mật khẩu phải có ít nhất 6 ký tự.';
    } elseif ($password !== $confirm) {
        $error = 'Mật khẩu xác nhận không khớp.';
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE email=?");
        $check->execute([$email]);

        if ($check->fetch()) {
            $error = 'Email này đã được đăng ký.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hash]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}

require 'includes/header.php';
?>
<div class="auth-wrap">
    <div class="auth-card">
        <span class="eyebrow red">TÀI KHOẢN</span>
        <h1>Tạo tài khoản</h1>
        <p>Đăng ký để quản lý thông tin và đơn hàng.</p>

        <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

        <form method="post">
            <label>Họ và tên
                <input required type="text" name="name" value="<?= e($_POST['name'] ?? '') ?>">
            </label>
            <label>Email
                <input required type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>">
            </label>
            <label>Mật khẩu
                <input required type="password" name="password">
            </label>
            <label>Nhập lại mật khẩu
                <input required type="password" name="confirm">
            </label>
            <button class="btn btn-primary full" type="submit">Đăng ký</button>
        </form>
        <p class="auth-switch">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
