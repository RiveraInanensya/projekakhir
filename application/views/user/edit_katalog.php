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
    <title>Edit Katalog</title>

    <!-- Link to CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/edit_katalog.css'); ?>">
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
                        <a href="<?= base_url('edit_profile'); ?>">Profil</a> 
                    <?php else: ?>
                        <a href="<?= base_url('auth'); ?>">Profil</a> 
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <div class="profile-section">
        <h2>Edit Katalog</h2>


        <form method="post" action="<?= base_url('katalog/update/' . $katalog->id); ?>"
        method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= isset($katalog->id) ? $katalog->id : ''; ?>">

    <div class="image-container">
        <div class="image-placeholder">
            <img id="profileImage" 
                 src="<?= isset($katalog->image) && file_exists('upload/' . $katalog->image) ? base_url('upload/' . $katalog->image) : base_url('assets/images/noimage.webp'); ?>" 
                 alt="Placeholder Gambar Image" 
                 style="width: 150px; height: 150px; object-fit: cover;">
            <label for="imageUpload" class="pilih-image" style="color: #ffff;">Pilih Foto</label>
            <input type="file" name="image" accept="image/*" id="imageUpload" onchange="displayProfileImage(event)" class="d-none">
        </div>
    </div>

    <label for="judul_post">Judul Post</label>
    <input type="text" id="judul_post" name="judul_post" value="<?= $katalog->judul_post ?? '' ?>" required><br>

    <label for="nama_karakter">Nama</label>
    <input type="text" id="nama_karakter" name="nama_karakter" value="<?= $katalog->nama_karakter ?? '' ?>" required><br>

    <label for="series">Series</label>
    <select name="series" id="series" required>
        <option value="No Series" <?= isset($katalog->series) && $katalog->series == 'No Series' ? 'selected' : ''; ?>>No Series</option>
        <option value="Kebaya" <?= isset($katalog->series) && $katalog->series == 'Kebaya' ? 'selected' : ''; ?>>Kebaya</option>
        <option value="Cheongsam" <?= isset($katalog->series) && $katalog->series == 'CHeongsam' ? 'selected' : ''; ?>>Cheongsam</option>
        <option value="Dress" <?= isset($katalog->series) && $katalog->series == 'Dress' ? 'selected' : ''; ?>>Dress</option>
    </select><br>

    <label for="brand">Brand</label>
    <select name="brand" id="brand" required>
        <option value="No Brand" <?= isset($katalog->brand) && $katalog->brand == 'No Brand' ? 'selected' : ''; ?>>No Brand</option>
        <option value="Maker" <?= isset($katalog->brand) && $katalog->brand == 'Maker' ? 'selected' : ''; ?>>Maker</option>
        <option value="Wudu" <?= isset($katalog->brand) && $katalog->brand == 'Wudu' ? 'selected' : ''; ?>>Wudu</option>
        <option value="Mangu" <?= isset($katalog->brand) && $katalog->brand == 'Mangu' ? 'selected' : ''; ?>>Mangu</option>
    </select><br>

    <label for="ukuran">Ukuran</label>
    <select name="ukuran" id="ukuran" required>
        <option value="S" <?= isset($katalog->ukuran) && $katalog->ukuran == 'S' ? 'selected' : ''; ?>>S</option>
        <option value="M" <?= isset($katalog->ukuran) && $katalog->ukuran == 'M' ? 'selected' : ''; ?>>M</option>
        <option value="L" <?= isset($katalog->ukuran) && $katalog->ukuran == 'L' ? 'selected' : ''; ?>>L</option>
        <option value="XL" <?= isset($katalog->ukuran) && $katalog->ukuran == 'XL' ? 'selected' : ''; ?>>XL</option>
    </select><br>

    <label for="harga">Harga</label>
    <input type="text" id="harga" name="harga" value="<?= $katalog->harga ?? '' ?>" required><br>

    <label for="usernam">Username</label>
    <input type="text" id="username" name="username" value="<?= $katalog->username ?? '' ?>" required><br>
    
    <label for="url_instagram">Instagram</label>
    <input type="text" id="url_instagram" name="url_instagram" value="<?= $katalog->url_instagram ?? '' ?>" required><br>

    <label for="detail">Detail</label>
    <textarea id="detail"name="detail" required><?= $katalog->detail ?? '' ?></textarea><br>

    <label for="lokasi">Lokasi</label>
    <select name="lokasi" id="lokasi" required>
        <option value="Jakarta" <?= isset($katalog->lokasi) && $katalog->lokasi == 'Jakarta' ? 'selected' : ''; ?>>Jakarta</option>
        <option value="Bandung" <?= isset($katalog->lokasi) && $katalog->lokasi == 'Bandung' ? 'selected' : ''; ?>>Bandung</option>
        <option value="Yogyakarta" <?= isset($katalog->lokasi) && $katalog->lokasi == 'Yogyakarta' ? 'selected' : ''; ?>>Yogyakarta</option>
        <option value="Semarang" <?= isset($katalog->lokasi) && $katalog->lokasi == 'Semarang' ? 'selected' : ''; ?>>Semarang</option>
        <option value="Surabaya" <?= isset($katalog->lokasi) && $katalog->lokasi == 'Surabaya' ? 'selected' : ''; ?>>Surabaya</option>
    </select><br>

    <div class="button-container">
        <button type="submit" class="save" onclick="Swal.fire('Katalog', 'Berhasil', 'success')">Save</button>
        <script src="<?=base_url(); ?>assets/js/sweetalert2.all.min.js"></script> 
    </div>
</form>

    </div>

    <!-- JavaScript -->
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this catalog?")) {
                window.location.href = "<?= site_url('user/delete_katalog?id='); ?>" + id;
            }
        }

        function displayProfileImage(event) {
            var image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>
</html>