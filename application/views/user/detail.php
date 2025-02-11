<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kostum</title>

    <!-- Link ke stylesheet CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/detail.css'); ?>">

    <!-- Link ke Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <h1>COSRENT</h1>
        <hr></hr>
        <nav>
            <ul>
                <li><a href="<?= base_url('user/home'); ?>">Beranda</a></li>
                <li><a href="<?= base_url('katalog'); ?>">Katalog Kostum</a></li>
                <li><a href="<?= base_url('rentalan'); ?>">List Rentalan</a></li>
                <li>
                    <?php if (isset($_SESSION['email'])): ?>
                        <a href="<?= base_url('edit_profile'); ?>">Profile</a> <!-- Logged in -->
                    <?php else: ?>
                        <a href="<?= base_url('auth'); ?>">Profile</a> <!-- Not logged in -->
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <div class="catalog-detail">
    <h2><?php echo $katalog->judul_post; ?></h2>

    <!-- Costume Image -->
    <div class="costume-image">
        <img src="<?php echo base_url('upload/') . $katalog->image; ?>" alt="Kostum Image">
    </div>

    <!-- Costume Details -->
    <div class="costume-info">
        <h3><?php echo $katalog->nama_karakter; ?></h3>
        <p><strong><i class="fas fa-tag"></i> Harga:</strong> Rp <?php echo number_format($katalog->harga, 0, ',', '.'); ?></p>
        <p><strong><i class="fas fa-location-dot"></i> Lokasi:</strong> <?php echo $katalog->lokasi; ?></p>
        <p><strong>Brand:</strong> <?php echo $katalog->brand; ?></p>
        <p><strong><i class="fas fa-tv"></i> Series:</strong> <?php echo $katalog->series; ?></p>
        <p><strong>Ukuran:</strong> <?php echo $katalog->ukuran; ?></p>
    </div>

    <!-- Detail Description -->
    <div class="costume-detail">
        <h4>Detail</h4>
        <p><?php echo $katalog->detail; ?></p>
    </div>

    <!-- Rental & Instagram Section -->
    <a href="<?php echo $katalog->url_instagram; ?>" target="_blank" class="instagram-btn">Instagram</a>
    <a href="<?= base_url('katalog'); ?>" class="btn">Kembali ke Katalog</a>
</div>

</body>
</html>
