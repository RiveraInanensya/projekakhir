<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php if (isset($user) && isset($user['image'])): ?>
                    <img src="<?= base_url('assets/images/profile/') . $user['image']; ?>" class="card-img">
                <?php else: ?>
                    <p>User data tidak ditemukan.</p>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= isset($user['name']) ? $user['name'] : 'Nama tidak tersedia'; ?></h5>
                    <p class="card-text"><?= isset($user['email']) ? $user['email'] : 'Email tidak tersedia'; ?></p>
                    <p class="card-text">
                        <small class="text-muted">
                            Member since <?= isset($user['date_created']) ? date('d F Y', $user['date_created']) : 'Tanggal tidak tersedia'; ?>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

