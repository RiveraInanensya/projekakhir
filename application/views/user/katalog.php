<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kostum</title>

    <!-- Link ke stylesheet CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/katalog.css'); ?>">

    <!-- Link ke Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <h1>COSRENT</h1>
        <hr>
        <nav>
            <ul>
                <li><a href="<?= base_url('user/home'); ?>">Beranda</a></li>
                <li><a href="<?= base_url('katalog'); ?>">Katalog Kostum</a></li>
                
                <li><a href="<?= base_url('rentalan'); ?>">List Rentalan</a></li>
                <li>
                    <?php if (isset($_SESSION['email'])): ?>
                        <a href="<?= base_url('edit_profile'); ?>">Profile</a>
                    <?php else: ?>
                        <a href="<?= base_url('auth'); ?>">Profile</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <div class="main-content">
        <!-- Dropdown Filter Kategori -->
       
        <div class="filter-section">
        <div id="catalogGrid"></div>
            <label for="filterKategori">Filter Kategori:</label>
            <select id="filterKategori">
                <option value="">Pilih Kategori</option>
                <option value="Kebaya">Kebaya</option>
                <option value="Cheongsam">Cheongsam</option>
                <option value="Dress">Dress</option>
            </select>
        </div>

        <section class="costume-section">
            <h2>Katalog Terbaru</h2>
            <div class="catalog-grid" id="catalogGrid">
                <?php if (!empty($katalogs)): ?>
                    <?php foreach ($katalogs as $katalog): ?>
                        <a href="<?= base_url('katalog/detail/' . $katalog['id']); ?>" class="catalog-link">
                            <div class="catalog-card">
                                <img src="<?= base_url('upload/' . $katalog['image']); ?>" alt="<?= $katalog['nama_karakter']; ?>" class="catalog-image">
                                <div class="catalog-details">
                                    <p class="catalog-title"><?= $katalog['judul_post']; ?></p>
                                    <p class="catalog-owner">@<?= $katalog['username']; ?></p>
                                    <p class="catalog-price"><i class="fas fa-tag"></i> Rp <?= number_format($katalog['harga'], 0, ',', '.'); ?> / 3 hari</p>
                                    <p class="catalog-series"> <i class="fas fa-tv"></i> <?= $katalog['series']; ?></p>
                                    <p class="catalog-location"><i class="fas fa-location-dot"></i> <?= $katalog['lokasi']; ?></p>
                                    <p class="catalog-ukuran">Ukuran: <?= $katalog['ukuran']; ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada katalog tersedia.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <!-- JavaScript untuk Filter Kategori -->
    <script>
document.getElementById('filterKategori').addEventListener('change', function() {
    let kategori = this.value;  // Mengambil nilai kategori yang dipilih
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector('.catalog-grid').innerHTML = xhr.responseText;
        }
    };

    // Mengirim request AJAX ke server untuk mengambil katalog berdasarkan kategori
    xhr.open('GET', `<?= base_url('katalog/filter_ajax/') ?>${kategori}`, true);
    xhr.send();
});
</script>
</body>
</html>
