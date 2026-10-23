<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Budaya Nusantara — JelajahNusa';
include __DIR__ . '/includes/header.php';
$items = [
['title'=>'Batik','region'=>'Jawa','text'=>'Karya tekstil dengan ragam motif dan teknik pewarnaan yang diwariskan lintas generasi. Setiap daerah memiliki ciri khasnya sendiri.','image'=>'https://images.unsplash.com/photo-1605364858914-6af7b2c7b7e5?auto=format&fit=crop&w=1000&q=85'],
['title'=>'Angklung','region'=>'Jawa Barat','text'=>'Alat musik bambu yang dimainkan bersama, mengajarkan harmoni, kerja sama, dan kebersamaan.','image'=>'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1000&q=85'],
['title'=>'Tenun Nusantara','region'=>'Berbagai daerah','text'=>'Tradisi menenun menghasilkan kain dengan motif yang berkaitan dengan identitas, lingkungan, dan nilai masyarakat setempat.','image'=>'https://images.unsplash.com/photo-1590736969955-71cc94901144?auto=format&fit=crop&w=1000&q=85'],
['title'=>'Rumah Adat','region'=>'Seluruh Indonesia','text'=>'Arsitektur tradisional menunjukkan cara masyarakat beradaptasi dengan iklim, bahan lokal, dan kehidupan sosial.','image'=>'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=1000&q=85']
];
?>
<section class="page-hero"><div class="container"><span class="eyebrow dark-eyebrow">WARISAN NUSANTARA</span><h1>Budaya yang hidup,<br><em>cerita yang berlanjut.</em></h1><p>Kenali kekayaan tradisi Indonesia dan hargai masyarakat yang menjaganya.</p></div></section>
<section class="container section culture-grid"><?php foreach($items as $i=>$item): ?><article class="culture-card"><div class="culture-image"><img loading="lazy" src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>"></div><div class="culture-copy"><span class="eyebrow dark-eyebrow"><?= e(strtoupper($item['region'])) ?></span><h2><?= e($item['title']) ?></h2><p><?= e($item['text']) ?></p></div></article><?php endforeach; ?></section>
<section class="story-band"><div class="container story-layout"><div><span class="eyebrow">JAGA WARISAN KITA</span><h2>Datang dengan rasa ingin tahu.<br><em>Pulang dengan rasa hormat.</em></h2></div><div class="story-text"><p>Tradisi bukan sekadar tontonan. Jika berkunjung ke acara adat atau tempat sakral, ikuti arahan warga dan mintalah izin sebelum memotret.</p><a class="btn btn-outline-light" href="destinasi.php">Temukan destinasi ↗</a></div></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>