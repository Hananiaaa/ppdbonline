<?php include 'templates/header.php'; ?>

<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Pendaftaran Berhasil!</h4>
        <p>Terima kasih telah melakukan pendaftaran. Data Anda telah berhasil kami simpan.</p>
        <hr>
        <p class="mb-0">Nomor pendaftaran Anda adalah:</p>
        <h2 class="font-weight-bold text-center my-3"> 
            <?php echo htmlspecialchars($_GET['no_pendaftaran']); ?>
        </h2>
        <p class="text-center font-weight-bold">Harap simpan dan catat nomor pendaftaran ini untuk mengecek status pengumuman Anda.</p>
    </div>
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
        <a href="cek_status.php" class="btn btn-info">Cek Status Sekarang</a>
    </div>
</div>

<?php include 'templates/footer.php'; ?>