<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Katalog</title>

    <!-- Link ke stylesheet CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/tambah_katalog.css'); ?>">

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
                <li><a href="<?= base_url('edit_profile'); ?>">Profil</a> </li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="form-container">
            <form action="<?php echo site_url('katalog/submit_katalog'); ?>" method="post" enctype="multipart/form-data">

                <div class="profile-section">
                    <h2>Masukkan Informasi Kostum</h2>
                    <div class="image-container">
                        <div class="image-placeholder">
                            <img id="profileImage"
                                src="<?= ($katalog['image'] && file_exists('upload/' . $katalog['image'])) ? base_url('upload/' . $katalog['image']) : base_url('assets/images/noimage.webp'); ?>"
                                alt="Placeholder Gambar Image" style="width: 150px; height: 150px;">
                        </div>
                        <label for="button" class="pilih-image">Pilih Foto</label>
                        <input type="file" name="image" accept="image/*" id="button" onchange="displayProfileImage(event)" class="d-none">
                    </div>

                    <div class="nama_karakter">
                        <label for="nama_karakter">Nama</label>
                        <input type="text" name="nama_karakter" id="nama_karakter" value="<?= $katalog['nama_karakter']; ?>" required>
                    </div>

                    <div class="judul_post">
                        <label for="judul_post">Judul Post</label>
                        <input type="text" name="judul_post" id="judul_post" value="<?= $katalog['judul_post']; ?>" required>
                    </div>

                    <div class="brand">
                        <label for="brand">Brand</label>
                        <select name="brand" id="brand" required>
                            <option value="No Brand">No Brand</option>
                            <option value="Maker">Maker</option>
                            <option value="Wudu">Wudu</option>
                            <option value="Mangu">Mangu</option>
                        </select>
                    </div>

                    <div class="lokasi">
                        <label for="lokasi">Lokasi</label>
                        <select name="lokasi" id="lokasi" required>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Semarang">Semarang</option>
                            <option value="Surabaya">Surabaya</option>
                        </select>
                    </div>

                    <div class="series">
                        <label for="series">Series</label>
                        <select name="series" id="series" required>
                            <option value="No Series">No Series</option>
                            <option value="Kebaya">Kebaya</option>
                            <option value="Cheongsam">Cheongsam</option>
                            <option value="Dress">Dress</option>
                        </select>
                    </div>

                    <div class="ukuran">
                        <label for="ukuran">Ukuran</label>
                        <select name="ukuran" id="ukuran" required>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>

                    <div class="harga">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" id="harga" value="<?= $katalog['harga']; ?>" required>
                    </div>

                    <div class="detail">
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" required><?= isset($katalog['detail']) ? $katalog['detail'] : ''; ?></textarea>
                    </div>

                    <div class="username">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" 
           value="<?= htmlspecialchars($katalog['username']); ?>" readonly>
</div>

<div class="url_instagram">
    <label for="url_instagram">URL Instagram</label>
    <input type="text" name="url_instagram" id="url_instagram" 
           value="<?= htmlspecialchars($katalog['url_instagram']); ?>" readonly>
</div>



                </div> <!-- End of profile-section -->

                <!-- Button Container -->
                <div class="button-container">
                    <button type="submit" class="save" onclick="Swal.fire('Katalog', 'Berhasil', 'success')">Save</button>
                </div> <!-- End of button-container -->

            </form> <!-- End of form -->
            <!-- Include SweetAlert script -->
            <script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
    </main>

    <script>
        function displayProfileImage(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function() {
                const profileImage = document.getElementById("profileImage");
                profileImage.src = reader.result;
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    </main>
</body>

</html>