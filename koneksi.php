<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Pecah data berdasarkan kode postgresql Anda
$host     = 'db.mqxpzsnunxfpizajvsrd.supabase.co';
$port     = '5432';
$dbname   = 'postgres';
$user     = 'postgres';
$password = 'sidratulmuntaha'; // <-- Ganti dengan password akun Supabase Anda

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $db = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    // Teks konfirmasi (bisa dihapus jika sudah lancar)
    // echo "Koneksi Cloud Supabase Sukses Terbuka!";
} catch (PDOException $e) {
    die("Koneksi cloud database gagal: " . $e->getMessage());
}
?>
