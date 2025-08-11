<?php
// Ganti dengan detail koneksi database Anda
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u371035293_formdaftar');
define('DB_PASSWORD', 'AMEmantap2025$');
define('DB_NAME', 'u371035293_formdaftar');

// Membuat koneksi
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
?>

