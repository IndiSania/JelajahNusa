<?php
require_once __DIR__ . '/../includes/functions.php'; requireAdmin();
$id=(int)($_GET['id']??0); $editing=$id>0; $error='';
$d=['name'=>'','slug'=>'','province'=>'','region'=>'Jawa','category'=>'Alam','description'=>'','image_url'=>'','map_url'=>'','best_time'=>'','tips'=>'','status'=>'published'];
if($editing){$st=$pdo->prepare("SELECT * FROM destinations WHERE id=?");$st->execute([$id]);$found=$st->fetch();if(!$found){http_response_code(404);exit('Destinasi tidak ditemukan');}$d=$found;}
if($_SERVER['REQUEST_METHOD']==='POST'){
 if(!csrfValid($_POST['csrf']??''))$error='Sesi formulir tidak valid.';
 else{
  foreach($d as $k=>$v) if(isset($_POST[$k])) $d[$k]=trim($_POST[$k]);
  if($d['name']===''||$d['province']===''||$d['description']==='')$error='Nama, provinsi, dan deskripsi wajib diisi.';
  elseif($d['image_url']!==''&&!filter_var($d['image_url'],FILTER_VALIDATE_URL))$error='URL gambar tidak valid.';
  elseif($d['map_url']!==''&&!filter_var($d['map_url'],FILTER_VALIDATE_URL))$error='URL peta tidak valid.';
  else{
   $d['slug']=slugify($d['slug']?:$d['name']);
   $fields=['name','slug','province','region','category','description','image_url','map_url','best_time','tips','status'];
   $values=[];foreach($fields as $f)$values[]=$d[$f];
   if($editing){$values[]=$id;$sql="UPDATE destinations SET name=?,slug=?,province=?,region=?,category=?,description=?,image_url=?,map_url=?,best_time=?,tips=?,status=? WHERE id=?";}
   else{$sql="INSERT INTO destinations (name,slug,province,region,category,description,image_url,map_url,best_time,tips,status) VALUES (?,?,?,?,?,?,?,?,?,?,?)";}
   try{$st=$pdo->prepare($sql);$st->execute($values);header('Location: index.php');exit;}catch(PDOException $e){$error='Gagal menyimpan. Pastikan slug belum digunakan.';}
  }
 }
}
$pageTitle=($editing?'Edit':'Tambah').' Destinasi — JelajahNusa';include __DIR__.'/../includes/header.php';
?>
<section class="page-hero compact-hero"><div class="container"><span class="eyebrow dark-eyebrow">PANEL PENGELOLA</span><h1><?= $editing?'Edit':'Tambah' ?> <em>destinasi.</em></h1></div></section>
<section class="container section form-section"><form class="contact-form wide-form" method="post"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><div class="form-grid"><label>Nama destinasi *<input required name="name" value="<?= e($d['name']) ?>"></label><label>Slug URL<input name="slug" value="<?= e($d['slug']) ?>" placeholder="otomatis-dari-nama"></label><label>Provinsi *<input required name="province" value="<?= e($d['province']) ?>"></label><label>Wilayah<select name="region"><?php foreach(['Jawa','Sumatra','Kalimantan','Sulawesi','Bali & Nusa Tenggara','Maluku & Papua'] as $v): ?><option <?= $d['region']===$v?'selected':'' ?>><?= e($v) ?></option><?php endforeach; ?></select></label><label>Kategori<select name="category"><?php foreach(['Alam','Pantai','Budaya','Sejarah','Kota','Pegunungan'] as $v): ?><option <?= $d['category']===$v?'selected':'' ?>><?= e($v) ?></option><?php endforeach; ?></select></label><label>Status<select name="status"><option value="published" <?= $d['status']==='published'?'selected':'' ?>>published</option><option value="draft" <?= $d['status']==='draft'?'selected':'' ?>>draft</option></select></label><label class="full-field">URL gambar<input type="url" name="image_url" value="<?= e($d['image_url']) ?>" placeholder="https://..."></label><label class="full-field">URL peta Google Maps<input type="url" name="map_url" value="<?= e($d['map_url']) ?>" placeholder="https://maps.google.com/..."></label><label>Waktu terbaik berkunjung<input name="best_time" value="<?= e($d['best_time']) ?>"></label><label class="full-field">Deskripsi *<textarea required name="description" rows="5"><?= e($d['description']) ?></textarea></label><label class="full-field">Tips berkunjung<textarea name="tips" rows="3"><?= e($d['tips']) ?></textarea></label></div><div class="form-actions"><a class="btn btn-light" href="index.php">Batal</a><button class="btn btn-primary">Simpan destinasi</button></div></form></section>
<?php include __DIR__.'/../includes/footer.php'; ?>