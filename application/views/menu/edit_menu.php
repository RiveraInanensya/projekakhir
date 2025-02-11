<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>

<body>
    <div class="container">
        <h1><?= $title; ?></h1>
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>

        <?= form_open('menu/edit/' . $menu['menu']); ?>
            <div class="form-group">
                <label for="menu">Menu</label>
                <input type="text" class="form-control" id="menu" name="menu" value="<?= $menu['menu']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Menu</button>
        <?= form_close(); ?>

        <br>
        <a href="<?= base_url('menu'); ?>" class="btn btn-secondary">Back</a>
    </div>
</body>

</html>