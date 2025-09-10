<?php include 'templates/header.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Cek Status Pendaftaran
                </div>
                <div class="card-body">
                    <form action="hasil_cek.php" method="GET">
                        <div class="form-group">
                            <label for="no_pendaftaran">Nomor Pendaftaran</label>
                            <input type="text" class="form-control" id="no_pendaftaran" name="no_pendaftaran" placeholder="Masukkan Nomor Pendaftaran Anda" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Cek Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>