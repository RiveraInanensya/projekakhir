<?php


// Ambil data dari form
$judul_post = $_POST['judul_post'];
$nama_karakter = $_POST['nama_karakter'];
$series = $_POST['series'];
$brand = $_POST['brand'];
$ukuran = $_POST['ukuran'];
$harga = $_POST['harga'];
$url_instagram = $_POST['url_instagram'];
$detail = $_POST['detail'];
$image = $_POST['image'];
$lokasi = $_POST['lokasi'];

// Buat koneksi ke database
$servername = "localhost";
$username = "root"; // Username database
$password = ""; // Password database
$database = "costum"; // Nama database

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


$sql = "INSERT INTO katalog (judul_post, nama_karakter, series, brand, ukuran, harga, url_instagram, detail, image, lokasi) 
        VALUES ('$judul_post', '$nama_karakter', '$series', '$brand', '$ukuran', '$harga', '$url_instagram', '$detail', '$image', '$lokasi')";



// Tutup koneksi
$conn->close();
?>
