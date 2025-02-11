<?php
// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$instagram = $_POST['instagram'];
$bio = $_POST['bio'];
$usrname = $_POST['usrname'];
$cara_sewa = $_POST['cara_sewa'];
$kota = $_POST['kota'];
$image = $_POST['image'];

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


$email = $_POST['email']; 

// Update data ke tabel user
$sql = "UPDATE user SET 
            name = '$name', 
            email = '$email', 
            kota = '$kota', 
            usrname = '$usrname', 
            bio = '$bio', 
            cara_sewa = '$cara_sewa', 
            image = '$image'  
        WHERE email = '$email'";





// Tutup koneksi
$conn->close();
?>
