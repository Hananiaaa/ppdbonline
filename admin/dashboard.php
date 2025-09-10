<?php
session_start();
// Enforce login
if (!isset($_SESSION['admin_login'])) {
    header('Location: index.php');
    exit;
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

include '../config/database.php';
include '../templates/header_admin.php';

// Fetch all students
$result = $koneksi->query("SELECT * FROM calon_siswa ORDER BY tanggal_daftar DESC");

?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Pendaftar</h5>
        </div>
        <div class="card-body">
            <?php if(isset($_GET['update'])): ?>
                <div class="alert alert-<?php echo $_GET['update'] == 'sukses' ? 'success' : 'danger'; ?>">
                    Status berhasil diperbarui.
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No. Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Jalur</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['no_pendaftaran']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                                    <td><?php echo htmlspecialchars($row['jalur_pendaftaran']); ?></td>
                                    <td>
                                        <?php 
                                            $status = $row['status_pendaftaran'];
                                            $badge_class = 'badge-secondary';
                                            if ($status == 'diterima') $badge_class = 'badge-success';
                                            if ($status == 'ditolak') $badge_class = 'badge-danger';
                                            echo "<span class='badge $badge_class'>".ucfirst($status)."</span>";
                                        ?>
                                    </td>
                                    <td>
                                        <form action="update_status.php" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin MENERIMA siswa ini?');">
                                            <input type="hidden" name="id_siswa" value="<?php echo $row['id_siswa']; ?>">
                                            <input type="hidden" name="status" value="diterima">
                                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                            <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                        </form>
                                        <form action="update_status.php" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin MENOLAK siswa ini?');">
                                            <input type="hidden" name="id_siswa" value="<?php echo $row['id_siswa']; ?>">
                                            <input type="hidden" name="status" value="ditolak">
                                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data pendaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include '../templates/footer.php'; ?>