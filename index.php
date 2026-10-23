<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'JelajahNusa — Temukan Pesona Indonesia';
$destinations = getDestinations($pdo, ['limit' => 6]);
$stats = ['destinations' => (int)$pdo->query("SELECT COUNT(*) FROM destinations WHERE status='published'")->fetchColumn(),
          'regions' => (int)$pdo->query("SELECT COUNT(DISTINCT province) FROM destinations WHERE status='published'")->fetchColumn()];
include __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="hero-shade"></div>
  <div class="container hero-content">
    <span class="eyebrow">JELAJAHI KEINDAHAN NUSANTARA</span>
    <h1>Setiap sudut Indonesia<br><em>punya cerita.</em></h1>
    <p>Temukan destinasi, budaya, dan pengalaman lokal yang membuat Indonesia istimewa.</p>
    <a class="btn btn-primary" href="destinasi.php">Jelajahi destinasi <span>↗</span></a>
    <div class="hero-note"><span class="live-dot"></span> Inspirasi perjalanan dari Sabang sampai Merauke</div>
  </div>
  <div class="hero-index">01 / NUSANTARA</div>
</section>
<section class="container quick-search-wrap">
  <form class="quick-search" action="destinasi.php" method="get">
    <div class="search-symbol">⌕</div>
    <label><span>Mau ke mana?</span><input type="search" name="q" placeholder="Cari destinasi atau daerah..."></label>
    <label class="region-select"><span>Wilayah</span><select name="region"><option value="">Semua wilayah</option><option>Jawa</option><option>Sumatra</option><option>Kalimantan</option><option>Sulawesi</option><option>Bali & Nusa Tenggara</option><option>Maluku & Papua</option></select></label>
    <button class="btn btn-dark" type="submit">Cari tempat <span>→</span></button>
  </form>
</section>
<section class="section container">
  <div class="section-head"><div><span class="eyebrow dark-eyebrow">PILIHAN UNTUKMU</span><h2>Destinasi yang <em>memikat.</em></h2></div><a class="text-link" href="destinasi.php">Lihat semua destinasi <span>↗</span></a></div>
  <div class="destination-grid">
  <?php foreach ($destinations as $d): ?>
    <a class="destination-card" href="detail.php?slug=<?= e($d['slug']) ?>">
      <div class="card-image"><img loading="lazy" src="<?= e($d['image_url'] ?: imageFallback()) ?>" alt="<?= e($d['name']) ?>"><span class="card-region"><?= e($d['region']) ?></span><span class="image-arrow">↗</span></div>
      <div class="card-copy"><div><h3><?= e($d['name']) ?></h3><p><?= e($d['province']) ?></p></div><span class="card-type"><?= e($d['category']) ?></span></div>
      <p class="card-desc"><?= e(shortText($d['description'], 105)) ?></p>
    </a>
  <?php endforeach; ?>
  </div>
</section>
<section class="story-band">
  <div class="container story-layout"><div><span class="eyebrow">LEBIH DARI SEKADAR PERJALANAN</span><h2>Kenali tempatnya.<br><em>Hargai budayanya.</em></h2></div><div class="story-text"><p>Perjalanan yang baik bukan hanya tentang tempat yang dikunjungi, tetapi juga tentang masyarakat, tradisi, dan alam yang kita jaga bersama.</p><a class="btn btn-outline-light" href="budaya.php">Jelajahi budaya <span>↗</span></a></div></div>
</section>
<section class="section container">
  <div class="section-head"><div><span class="eyebrow dark-eyebrow">JELAJAHI DENGAN BIJAK</span><h2>Perjalanan yang <em>berarti.</em></h2></div></div>
  <div class="value-grid">
    <article class="value-card"><span class="value-icon">⌖</span><h3>Temukan tempat baru</h3><p>Jelajahi referensi destinasi dari berbagai provinsi di Indonesia.</p></article>
    <article class="value-card"><span class="value-icon">✳</span><h3>Kenali budaya lokal</h3><p>Pelajari tradisi, kuliner, dan kearifan lokal dengan rasa hormat.</p></article>
    <article class="value-card"><span class="value-icon">♧</span><h3>Dukung ekonomi lokal</h3><p>Pilih pemandu, penginapan, dan produk lokal jika memungkinkan.</p></article>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>