<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Destinasi — JelajahNusa';
$q = trim($_GET['q'] ?? '');
$region = trim($_GET['region'] ?? '');
$category = trim($_GET['category'] ?? '');
$destinations = getDestinations($pdo, ['q'=>$q, 'region'=>$region, 'category'=>$category]);
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><span class="eyebrow dark-eyebrow">KATALOG NUSANTARA</span><h1>Temukan tempat <em>favoritmu.</em></h1><p>Gunakan pencarian dan filter untuk menemukan inspirasi perjalanan berikutnya.</p></div></section>
<section class="container section catalog-section">
<form class="filter-panel" method="get">
  <label class="filter-search">Cari destinasi<input type="search" name="q" value="<?= e($q) ?>" placeholder="Nama tempat, kota, provinsi..."></label>
  <label>Wilayah<select name="region"><option value="">Semua wilayah</option><?php foreach(['Jawa','Sumatra','Kalimantan','Sulawesi','Bali & Nusa Tenggara','Maluku & Papua'] as $r): ?><option <?= $region===$r?'selected':'' ?>><?= e($r) ?></option><?php endforeach; ?></select></label>
  <label>Kategori<select name="category"><option value="">Semua kategori</option><?php foreach(['Alam','Pantai','Budaya','Sejarah','Kota','Pegunungan'] as $c): ?><option <?= $category===$c?'selected':'' ?>><?= e($c) ?></option><?php endforeach; ?></select></label>
  <button class="btn btn-dark" type="submit">Terapkan filter</button>
</form>
<div class="results-line"><span><strong><?= count($destinations) ?></strong> destinasi ditemukan</span><a class="text-link" href="destinasi.php">Reset filter ↗</a></div>
<?php if (!$destinations): ?><div class="empty-state"><span>⌕</span><h2>Belum ada destinasi yang cocok</h2><p>Coba kata kunci atau filter yang berbeda.</p><a class="btn btn-primary" href="destinasi.php">Lihat semua destinasi</a></div><?php else: ?>
<div class="destination-grid">
<?php foreach($destinations as $d): ?><a class="destination-card" href="detail.php?slug=<?= e($d['slug']) ?>"><div class="card-image"><img loading="lazy" src="<?= e($d['image_url'] ?: imageFallback()) ?>" alt="<?= e($d['name']) ?>"><span class="card-region"><?= e($d['region']) ?></span><span class="image-arrow">↗</span></div><div class="card-copy"><div><h3><?= e($d['name']) ?></h3><p><?= e($d['province']) ?></p></div><span class="card-type"><?= e($d['category']) ?></span></div><p class="card-desc"><?= e(shortText($d['description'], 115)) ?></p></a><?php endforeach; ?>
</div><?php endif; ?>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>