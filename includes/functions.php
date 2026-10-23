<?php
if (session_status() === PHP_SESSION_NONE) {
  session_name('jelajahnusa_session');
  session_set_cookie_params(['httponly'=>true,'samesite'=>'Lax','secure'=>!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off']);
  session_start();
}
require_once __DIR__ . '/config.php';
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function shortText(string $text, int $length=120): string { return mb_strlen($text)>$length ? mb_substr($text,0,$length-1).'…' : $text; }
function imageFallback(): string { return 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1000&q=85'; }
function getDestinations(PDO $pdo, array $filters=[]): array {
  $sql="SELECT * FROM destinations WHERE status='published'";$params=[];
  if(!empty($filters['q'])){$sql.=" AND (name LIKE ? OR province LIKE ? OR description LIKE ?)";$term='%'.$filters['q'].'%';array_push($params,$term,$term,$term);}
  if(!empty($filters['region'])){$sql.=" AND region=?";$params[]=$filters['region'];}
  if(!empty($filters['category'])){$sql.=" AND category=?";$params[]=$filters['category'];}
  $sql.=" ORDER BY featured DESC, name ASC";
  if(isset($filters['limit'])){$sql.=" LIMIT ".max(1,min(50,(int)$filters['limit']));}
  $stmt=$pdo->prepare($sql);$stmt->execute($params);return $stmt->fetchAll();
}
function csrfToken(): string { if(empty($_SESSION['csrf_token']))$_SESSION['csrf_token']=bin2hex(random_bytes(32));return $_SESSION['csrf_token']; }
function csrfValid(string $token): bool { return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'],$token); }
function requireAdmin(): void { if(empty($_SESSION['admin_id'])){header('Location: login.php');exit;} }
function slugify(string $text): string { $text=iconv('UTF-8','ASCII//TRANSLIT//IGNORE',$text);$text=strtolower($text);$text=preg_replace('/[^a-z0-9]+/','-',$text);return trim($text,'-') ?: 'destinasi'; }
