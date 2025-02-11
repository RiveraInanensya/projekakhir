<body>
    <h1>Katalog Rentalan</h1>
    <div class="katalog-container">
        <?php if (!empty($katalog)): ?>
            <?php foreach ($katalog as $item): ?>
                <a href="<?= base_url('katalog/detail/' . $katalog['id']); ?>" class="catalog-link">
                            <div class="catalog-card">
                                <img src="<?= base_url('upload/' . $katalog['image']); ?>" alt="<?= $katalog['nama_karakter']; ?>" class="catalog-image">
                                <div class="catalog-details">
                                    <p class="catalog-title"><?= $katalog['judul_post']; ?></p>
                                    <p class="catalog-owner">@<?= $katalog['url_instagram']; ?></p>
                                    <p class="catalog-price"><i class="fas fa-tag"></i> Rp <?= number_format($katalog['harga'], 0, ',', '.'); ?> / 3 hari</p>
                                    <p class="catalog-series"> <i class="fas fa-tv"></i> <?= $katalog['series']; ?></p>
                                    <p class="catalog-location"><i class="fas fa-location-dot"></i> <?= $katalog['lokasi']; ?></p>
                                    <p class="catalog-ukuran">Ukuran: <?= $katalog['ukuran']; ?></p>
                                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Katalog tidak tersedia.</p>
        <?php endif; ?>
    </div>
</body>
</html>