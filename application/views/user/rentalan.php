<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Rentalan</title>
    
    <!-- Link to your stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/css/rentalan.css'); ?>">
    
    <!-- Font Awesome for icons -->
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
                        <a href="<?= base_url('edit_profile'); ?>">Profile</a> <!-- Logged in -->
                    <?php else: ?>
                        <a href="<?= base_url('auth'); ?>">Profile</a> <!-- Not logged in -->
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <div class="rentalan-container">
    <?php foreach ($users as $user): ?>
            <div class="user-card">
            <div class="profile-image">
    <img src="<?= base_url('upload/' . $user['image']); ?>">
</div>

                <div class="user-info">
                    <h3 class="user-name"><?= htmlspecialchars($user['name']); ?></h3>
                    <p class="user-username">@<?= htmlspecialchars($user['usrname']); ?></p>
                    <p class="user-bio"><?= htmlspecialchars($user['bio']); ?></p>
                    <a href="<?= base_url('rentalan/view_katalog/' . $user['id']); ?>" class="btn">Lihat Katalog</a>


                </div>
            </div>
            <?php endforeach; ?>
    </div>

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
