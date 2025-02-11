<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSRENT</title>

    <!-- Link ke stylesheet CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

    <!-- Link ke Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <h1>COSRENT</h1>
        <hr>
        </hr>
        <nav>
    <ul>
        <li><a href="<?= base_url('user/home'); ?>">Beranda</a></li>
        <li><a href="<?= base_url('katalog'); ?>">Katalog Kostum</a></li>
        <li><a href="<?= base_url('bundle'); ?>">List Bundle</a></li>
        <li><a href="<?= base_url('rentalan'); ?>">List Rentalan</a></li>
        <li>
            <?php if (isset($_SESSION['email'])): ?>
                <a href="<?= base_url('edit_profile'); ?>">Profile</a> <!-- Jika sudah login -->
            <?php else: ?>
                <a href="<?= base_url('auth'); ?>">Profile</a> <!-- Jika belum login -->
            <?php endif; ?>
        </li>
    </ul>
</nav>