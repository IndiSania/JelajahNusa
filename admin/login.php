<?php
require_once __DIR__ . '/../includes/functions.php';
if (!empty($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  if (!csrfValid($_POST['csrf']??'')) $error='Sesi tidak valid. Muat ulang halaman.';
  else {
    $stmt=$pdo->prepare("SELECT id,username,password_hash FROM admins WHERE username=? LIMIT 1"); $stmt->execute([trim($_POST['username']??'')]); $admin=$stmt->fetch();
    if ($admin && password_verify($_POST['password']??'', $admin['password_hash'])) { session_regenerate_id(true); $_SESSION['admin_id']=$admin['id']; $_SESSION['admin_username']=$admin['username']; header('Location: index.php'); exit; }
    $error='Username atau kata sandi tidak sesuai.';
  }
}
$pageTitle='Login Admin — JelajahNusa'; include __DIR__.'/../includes/header.php';
?>
<section class="login-wrap"><form class="contact-form login-card" method="post"><span class="eyebrow dark-eyebrow">AREA PENGELOLA</span><h1>Login <em>admin.</em></h1><p>Masuk untuk mengelola destinasi dan membaca pesan warga.</p><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><label>Username<input required name="username" autocomplete="username"></label><label>Kata sandi<input required type="password" name="password" autocomplete="current-password"></label><button class="btn btn-primary btn-full">Masuk dashboard →</button><p class="small-note">Akun awal tercantum di README.md. Ganti kata sandi setelah instalasi.</p></form></section>
<?php include __DIR__.'/../includes/footer.php'; ?>