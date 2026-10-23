<?php
// Sesuaikan pengaturan database dengan XAMPP kamu.
$dbHost = 'localhost';
$dbName = 'jelajahnusa';
$dbUser = 'root';
$dbPass = '';
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];
try {
  $pdo = new PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4", $dbUser, $dbPass, $options);
} catch (PDOException $e) {
  http_response_code(500);
  exit('Koneksi database gagal. Periksa includes/config.php dan pastikan database sudah diimpor dari database/jelajahnusa.sql.');
}
