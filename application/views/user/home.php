<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSRENT</title>

    <!-- Link to your stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

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


    <div class="container">
   <main>
       <section class="intro">
           <div class="text-container">
               <h2>Cosrent</h2>
               <h2>Hadir dengan berbagai macam koleksi pakaian.</h2>
               <h3>Temukan, sewa, dan wujudkan style unikmu !</h3>
               <a href="<?= base_url('katalog'); ?>" class="btn">All Catalogue</a>
           </div>

           <div class="contact-form-container">
               <div class="contact-form">
                   <h1>How To Rental?</h1>
                  
                   <ul class="criteria">
                       <li><img src="<?= base_url('assets/images/checklist.png'); ?>" alt="Checklist Icon"> Cari katalog.</li>
                       <li><img src="<?= base_url('assets/images/checklist.png'); ?>" alt="Checklist Icon"> Hubungi perental dengan klik kontak yang tersedia.</li>
                       <li><img src="<?= base_url('assets/images/checklist.png'); ?>" alt="Checklist Icon"> Isi form sesuai kebijakan para rentalan.</li>
                       <li><img src="<?= base_url('assets/images/checklist.png'); ?>" alt="Checklist Icon"> Lakukan payment.</li>
                       <li><img src="<?= base_url('assets/images/checklist.png'); ?>" alt="Checklist Icon"> Selesai.</li>
                   </ul>

                   <button type="button" id="tombol" onclick="window.location.href='<?= base_url('rentalan'); ?>'">List Rentalan</button>
               </div>
           </div>
       </section>
   </main>
</div>

       
        
      

</html>
