<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Katalog</title>

    <!-- Link ke stylesheet CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/e_katalog.css'); ?>">

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

    <section class="costume-section">
        <h3>Pilih Katalog untuk Diedit:</h3>
        <div class="catalog-grid" id="catalogGrid">
            <?php if (!empty($katalogs)): ?>
                <?php foreach ($katalogs as $katalog): ?>
                    

                    <div class="catalog-card">
                        <img src="<?= base_url('upload/' . $katalog->image); ?>" alt="<?= $katalog->nama_karakter; ?>" class="catalog-image">
                        <div class="catalog-details">
                            <p class="catalog-title"><?= $katalog->judul_post; ?></p>
                            <p class="catalog-owner">@<?= $katalog->username; ?></p>
                            <p class="catalog-price"><i class="fas fa-tag"></i> Rp <?= number_format($katalog->harga, 0, ',', '.'); ?> / 3 hari</p>
                            <p class="catalog-series"><i class="fas fa-tv"></i> <?= $katalog->series; ?></p>
                            <p class="catalog-location"><i class="fas fa-location-dot"></i> <?= $katalog->lokasi; ?></p>
                            <p class="catalog-ukuran">Ukuran: <?= $katalog->ukuran; ?></p>
                        </div>
                        <!-- Edit and Delete Buttons -->
                        <div class="button-container">
                        <a href="<?= site_url('katalog/edit') . '?id=' . $katalog->id; ?>" class="edit">Edit</a>

                            <button type="button" class="delete" onclick="openDeleteModal()">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No catalogs available to edit.</p>
            <?php endif; ?>

            <!-- Custom Logout Modal -->
<div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Ingin menghapus katalog?</h5>
            <span class="close" onclick="closeDeleteModal()">&times;</span>
        </div>
        <div class="modal-body">
            Klik "Delete" untuk menghapus katalog
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" onclick="closeDeleteModal()">Cancel</button>
            <a href="<?= site_url('katalog/delete_katalog/' . $katalog->id); ?>" class="btn btn-danger">Delete</a>


        </div>
    </div>
</div>

<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script>
// JavaScript functions for opening and closing the modal
function openDeleteModal() {
    document.getElementById("deleteModal").style.display = "block";
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

// Close the modal if the user clicks anywhere outside of it
window.onclick = function(event) {
    var modal = document.getElementById("deletetModal");
    if (event.target == modal) {
        closeDeleteModal();
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
    background-color: #0056b3;
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
    background-color: #0056b3; /* Darker blue on hover for logout button */
}
</style>


        </div>
    </section>
</body>

</html>