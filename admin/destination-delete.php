<?php
require_once __DIR__ . '/../includes/functions.php'; requireAdmin();
if($_SERVER['REQUEST_METHOD']!=='POST'||!csrfValid($_POST['csrf']??'')){http_response_code(405);exit('Permintaan tidak valid.');}
$id=(int)($_POST['id']??0);$st=$pdo->prepare("DELETE FROM destinations WHERE id=?");$st->execute([$id]);header('Location: index.php');exit;
?>