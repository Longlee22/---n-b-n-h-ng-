<?php
require_once 'config.php';
$pageTitle = 'Đăng nhập - Long';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    }
    $error = 'Email hoặc mật khẩu không đúng.';
}

require 'includes/header.php';
?>
<div class="auth-wrap">
    <div class="auth-card">
        <span class="eyebrow red">TÀI KHOẢN</span>
        <h1>Đăng nhập</h1>
        <p>Chào mừng bạn quay lại Long.</p>

        <?php if (!empty($_GET['registered'])): ?><div class="alert success-alert">Đăng ký thành công. Hãy đăng nhập.</div><?php endif; ?>
        <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

        <form method="post">
            <label>Email
                <input required type="email" name="email" placeholder="example@gmail.com">
            </label>
            <label>Mật khẩu
                <input required type="password" name="password" placeholder="••••••••">
            </label>
            <button class="btn btn-primary full" type="submit">Đăng nhập</button>
        </form>
        <p class="auth-switch">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
