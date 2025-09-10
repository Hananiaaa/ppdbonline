<?php
include 'config/database.php';
include 'templates/header.php';

$hasil = null;
$error = false;

if (isset($_GET['no_pendaftaran']) && !empty($_GET['no_pendaftaran'])) {
    $no_pendaftaran = $_GET['no_pendaftaran'];

    // Ambil semua data siswa untuk ditampilkan
    $stmt = $koneksi->prepare("SELECT * FROM calon_siswa WHERE no_pendaftaran = ?");
    $stmt->bind_param("s", $no_pendaftaran);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hasil = $result->fetch_assoc();
    } else {
        $error = "Nomor pendaftaran tidak ditemukan.";
    }
    $stmt->close();
} else {
    // Kondisi jika halaman diakses tanpa nomor pendaftaran
    // Tidak perlu pesan error spesifik di sini, form cek akan ditampilkan di cek_status.php
}

$koneksi->close();
?>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Hasil Pengecekan Status Pendaftaran</h3>
        </div>
        <div class="card-body">
            <?php if ($hasil): ?>
                <?php 
                    $status = $hasil['status_pendaftaran'];
                    $nama = htmlspecialchars($hasil['nama_lengkap']);
                    $alert_class = '';
                    $status_text = '';

                    if ($status == 'diterima') {
                        $alert_class = 'alert-success';
                        $status_text = 'DITERIMA';
                        $heading = "Selamat, $nama!";
                        $message = "Anda dinyatakan <strong>DITERIMA</strong> sebagai calon siswa baru di SMPN 1 Bawang.";
                    } elseif ($status == 'ditolak') {
                        $alert_class = 'alert-danger';
                        $status_text = 'DITOLAK';
                        $heading = "Mohon Maaf, $nama.";
                        $message = "Berdasarkan hasil seleksi, Anda dinyatakan <strong>TIDAK DITERIMA</strong>.";
                    } else {
                        $alert_class = 'alert-info';
                        $status_text = 'MENUNGGU VERIFIKASI';
                        $heading = "Status Pendaftaran Anda, $nama.";
                        $message = "Saat ini status pendaftaran Anda adalah <strong>MENUNGGU VERIFIKASI</strong>.";
                    }
                ?>
                <div class="alert <?php echo $alert_class; ?>">
                    <h4 class="alert-heading"><?php echo $heading; ?></h4>
                    <p><?php echo $message; ?></p>
                </div>

                <hr>

                <h4>Ringkasan Data Pendaftaran Anda:</h4>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">No. Pendaftaran</th><td>: <?php echo htmlspecialchars($hasil['no_pendaftaran']); ?></td></tr>
                            <tr><th>Nama Lengkap</th><td>: <?php echo htmlspecialchars($hasil['nama_lengkap']); ?></td></tr>
                            <tr><th>Tempat, Tgl Lahir</th><td>: <?php echo htmlspecialchars($hasil['tempat_lahir']) . ', ' . date('d F Y', strtotime($hasil['tanggal_lahir'])); ?></td></tr>
                            <tr><th>Jenis Kelamin</th><td>: <?php echo htmlspecialchars($hasil['jenis_kelamin']); ?></td></tr>
                            <tr><th>Agama</th><td>: <?php echo htmlspecialchars($hasil['agama']); ?></td></tr>
                            <tr><th>NISN</th><td>: <?php echo htmlspecialchars($hasil['nisn']); ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">Alamat</th><td>: <?php echo htmlspecialchars($hasil['alamat']); ?></td></tr>
                            <tr><th>No. HP</th><td>: <?php echo htmlspecialchars($hasil['no_hp']); ?></td></tr>
                            <tr><th>Email</th><td>: <?php echo htmlspecialchars($hasil['email']); ?></td></tr>
                            <tr><th>Asal Sekolah</th><td>: <?php echo htmlspecialchars($hasil['asal_sekolah']); ?></td></tr>
                            <tr><th>Nama Orang Tua</th><td>: <?php echo htmlspecialchars($hasil['nama_orang_tua']); ?></td></tr>
                            <tr><th>Jalur Pendaftaran</th><td>: <?php echo htmlspecialchars($hasil['jalur_pendaftaran']); ?></td></tr>
                        </table>
                    </div>
                </div>

            <?php elseif ($error): ?>
                <div class="alert alert-warning">
                    <p><?php echo $error; ?></p>
                </div>
            <?php else: ?>
                 <div class="alert alert-light">
                    <p>Silakan masukkan nomor pendaftaran Anda pada halaman <a href="cek_status.php">Cek Pengumuman</a> untuk melihat status.</p>
                </div>
            <?php endif; ?>

            <hr>
            <a href="cek_status.php" class="btn btn-secondary mt-3">Cek Nomor Lain</a>
            <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>