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
    <link rel="stylesheet" href="<?= base_url('assets/css/edit.css'); ?>">

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
                        <a href="<?= base_url('edit_profile'); ?>">Profil</a> 
                    <?php else: ?>
                        <a href="<?= base_url('auth'); ?>">Profil</a> 
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="<?php echo site_url ('edit/update'); ?>"  method="post" enctype="multipart/form-data">
            <div class="profile-section">
                <h2>Edit Profil Anda</h2>

                <div class="image-container">
    <div class="image-placeholder">
        <!-- If there's no image uploaded, display noimage.webp -->
        <img id="profileImage" 
             src="<?= ($user['image'] && file_exists('upload/' . $user['image'])) ? base_url('upload/' . $user['image']) : base_url('assets/images/noimage.webp'); ?>" 
             alt="Placeholder Gambar Image">
    </div>
    <label for="button" class="pilih-image">Pilih Logo</label>
    <input type="file" name="image" accept="image/*" id="button" onchange="displayProfileImage(event)" class="d-none">
</div>



                <div class="usrname">
                    <label for="usrname">Username:</label>
                    
                    <input type="text" id="usrname" name="usrname" value="<?= $user['usrname']; ?>">
                </div>

                <div class="nama">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" value="<?= $user['name']; ?>">
                </div>

                <div class="cara-sewa">
                    <label for="cara_sewa">Cara Sewa:</label>
                    <select id="cara_sewa" name="cara_sewa">
                        <option value="dm instagram" <?= ($user['cara_sewa'] == 'dm instagram') ? 'selected' : ''; ?>>Dm Instagram</option>
                        <option value="whatsapp" <?= ($user['cara_sewa'] == 'whatsapp') ? 'selected' : ''; ?>>WhatsApp</option>
                    </select>
                </div>

               <div class="instagram">
                    <label for="instagram">Instagram:</label>
                    
                    <input type="text" id="instagram" name="instagram" value="<?= $user['instagram']; ?>">
                </div>

                <div class="email">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $user['email']; ?>" >
                </div>

                <div class="kota">
                    <label for="kota">Kota:</label>
                    <select id="kota" name="kota">
                        <option value="Jakarta" <?= ($user['kota'] == 'Jakarta') ? 'selected' : ''; ?>>Jakarta</option>
                        <option value="Bandung" <?= ($user['kota'] == 'Bandung') ? 'selected' : ''; ?>>Bandung</option>
                        <option value="Yogyakarta" <?= ($user['kota'] == 'Yogyakarta') ? 'selected' : ''; ?>>Yogyakarta</option>
                        <option value="Semarang" <?= ($user['kota'] == 'Semarang') ? 'selected' : ''; ?>>Semarang</option>
                        <option value="Surabaya" <?= ($user['kota'] == 'Surabaya') ? 'selected' : ''; ?>>Surabaya</option>
                        
                    </select>
                </div>

                <div class="bio">
                    <label for="bio">Bio:</label>
                    <textarea id="bio" name="bio"><?= $user['bio']; ?></textarea>
                </div>

                <!-- Buttons for Adding Catalog and Bundle -->
                <div class="button-container">
    <button type="button" class="tambah-katalog" onclick="window.location.href='<?= base_url('tambah_katalog'); ?>'">Tambah Katalog</button>
    <button type="button" class="edit-katalog" onclick="window.location.href='<?= base_url('my_katalog'); ?>'">Edit Katalog</button>
    <button type="submit" class="simpan" onclick="Swal.fire('Update', 'Berhasil Ditambahkan!', 'success')">Simpan</button>
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
<!-- Button to trigger custom logout modal -->
<button type="button" class="logout" onclick="openLogoutModal()">Log Out</button>

<!-- Custom Logout Modal -->
<div id="logoutModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Ready to Leave?</h5>
            <span class="close" onclick="closeLogoutModal()">&times;</span>
        </div>
        <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" onclick="closeLogoutModal()">Cancel</button>
            <a href="<?= base_url('auth/logout'); ?>"class="btn btn-danger" >Logout</a>
        </div>
    </div>
</div>

<!-- Include jQuery if needed for other scripts -->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script>
// JavaScript functions for opening and closing the modal
function openLogoutModal() {
    document.getElementById("logoutModal").style.display = "block";
}

function closeLogoutModal() {
    document.getElementById("logoutModal").style.display = "none";
}

// Close the modal if the user clicks anywhere outside of it
window.onclick = function(event) {
    var modal = document.getElementById("logoutModal");
    if (event.target == modal) {
        closeLogoutModal();
    }
}
</script>

<style>
/* Modal Background */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fff; /* White background for modal content */
    margin: 15% auto; /* Centered vertically and horizontally */
    padding: 20px;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow effect */
    width: 90%; /* Responsive width */
    max-width: 500px; /* Maximum width for larger screens */
}

/* Modal Header Style */
.modal-header {
    display: flex;
    justify-content: space-between; /* Space between title and close button */
    align-items: center; /* Center items vertically */
}

/* Close Button Style */
.close {
    color: #aaa; /* Light gray color for close button */
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000; /* Darker color on hover/focus */
    text-decoration: none; /* Remove underline on hover/focus */
    cursor: pointer; /* Pointer cursor on hover */
}

/* Modal Body Style */
.modal-body {
    margin-top: 10px; /* Space above the body content */
}

/* Modal Footer Style */
.modal-footer {
    display: flex;
    justify-content: flex-end; /* Align buttons to the right */
}

.btn {
    padding: 10px 15px; /* Padding for buttons */
    border-radius: 5px; /* Rounded corners for buttons */
}

.btn-danger {
    background-color: red; /* Light gray background for cancel button */
    color: white; /* Dark text color for contrast */
}

.btn-primary {
    background-color: #007bff; /* Bootstrap primary color (blue) */
    color: white; /* White text color for contrast */
}

.btn-danger:hover {
    background-color: gray; /* Darker gray on hover for cancel button */
}

.btn-primary:hover {
    background-color: gray; /* Darker blue on hover for logout button */
}
</style>

<!-- Include Bootstrap JS -->
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

                </div>
            </div>
        </form>
    </main>

    <!-- Script untuk menampilkan logo yang dipilih -->
    <script>
        function displayProfileImage(event) {
            const input = event.target;
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profileImage = document.getElementById('profileImage');
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>