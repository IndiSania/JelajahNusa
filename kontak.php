<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Kontak — JelajahNusa'; $success=false; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  if (!csrfValid($_POST['csrf'] ?? '')) $error='Sesi formulir tidak valid. Muat ulang halaman lalu coba lagi.';
  else {
    $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $subject=trim($_POST['subject']??'Saran'); $message=trim($_POST['message']??'');
    if ($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || $message==='') $error='Lengkapi nama, email yang valid, dan pesan.';
    else { $stmt=$pdo->prepare("INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)"); $stmt->execute([$name,$email,$subject,$message]); $success=true; }
  }
}
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><span class="eyebrow dark-eyebrow">TERHUBUNG DENGAN KAMI</span><h1>Punya cerita atau <em>saran?</em></h1><p>Bantu kami menyempurnakan informasi destinasi dan mengenalkan lebih banyak tempat di Indonesia.</p></div></section>
<section class="container contact-layout section"><div class="contact-copy"><span class="eyebrow dark-eyebrow">KAMI TERBUKA UNTUK</span><h2>Kontribusi kecil bisa membawa <em>dampak besar.</em></h2><p>Kirim rekomendasi tempat wisata, koreksi informasi, atau ide kolaborasi. Pesan akan tersimpan di sistem demo ini.</p><div class="contact-point"><span>01</span><div><h3>Rekomendasi destinasi</h3><p>Bagikan tempat lokal yang layak dikenal.</p></div></div><div class="contact-point"><span>02</span><div><h3>Koreksi informasi</h3><p>Bantu menjaga informasi tetap akurat.</p></div></div></div>
<form class="contact-form" method="post"><h2>Kirim pesan</h2><?php if($success): ?><div class="alert success">Terima kasih! Pesanmu berhasil disimpan.</div><?php endif; ?><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><label>Nama lengkap<input required name="name" maxlength="100" value="<?= e($_POST['name']??'') ?>" placeholder="Nama kamu"></label><label>Email<input required type="email" name="email" maxlength="190" value="<?= e($_POST['email']??'') ?>" placeholder="nama@email.com"></label><label>Topik<select name="subject"><option>Saran destinasi</option><option>Koreksi informasi</option><option>Kolaborasi</option><option>Lainnya</option></select></label><label>Pesan<textarea required name="message" rows="5" maxlength="3000" placeholder="Ceritakan pesanmu..."><?= e($_POST['message']??'') ?></textarea></label><button class="btn btn-primary btn-full">Kirim pesan ↗</button></form></section>
<?php include __DIR__ . '/includes/footer.php'; ?>