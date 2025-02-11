<?php
$judul_post = $_POST['judul_post'];
$nama_karakter = $_POST['nama_karakter'];
$brand = $_POST['brand'];
$harga = $_POST['harga'];
$ukuran = $_POST['ukuran'];
$series = $_POST['series'];
$lokasi = $_POST['lokasi'];
$detail = $_POST['detail'];
$url_instagram = $_POST['url_instagram'];



$servername = "localhost";
$username = "root"; // Username database
$password = ""; // Password database
$database = "costum"; // Nama database

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_POST['id']; 

// Update data ke tabel user
$sql = "UPDATE katalog SET 
            judul_post = '$judul_post', 
            nama_karakter = '$nama_karakter', 
            brand = '$brand', 
            harga = '$harga', 
            ukuran = '$ukuran', 
            series = '$series', 
            lokasi = '$lokasi', 
            detail = '$detail', 
            url_instagram = '$url_instagram',  
            image = '$image'  
        WHERE id = '$id'";



// Tutup koneksi
$conn->close();
?>