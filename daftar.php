<?php include 'templates/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Formulir Pendaftaran Siswa Baru</h3>
        </div>
        <div class="card-body">
            <p class="card-text">Silakan isi data berikut dengan benar sesuai dengan dokumen yang berlaku.</p>
            <hr>
            <form action="proses_daftar.php" method="POST" enctype="multipart/form-data">
                
                <h5 class="mt-4">Data Diri Calon Siswa</h5>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" required pattern="[0-9]{10}" title="NISN harus terdiri dari 10 angka">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4">Data Kontak dan Alamat</h5>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_hp">Nomor HP (WhatsApp)</label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Contoh: email@example.com" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, dan kota/kabupaten" required></textarea>
                </div>

                <h5 class="mt-4">Data Akademik dan Orang Tua</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_orang_tua">Nama Orang Tua / Wali</label>
                            <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" required>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4">Jalur Pendaftaran</h5>
                <div class="form-group">
                    <label for="jalur_pendaftaran">Pilih Jalur Pendaftaran</label>
                    <select class="form-control" id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                        <option value="">-- Pilih Jalur --</option>
                        <option value="Prestasi Akademik">Prestasi Akademik</option>
                        <option value="Prestasi Non Akademik">Prestasi Non Akademik</option>
                        <option value="Afirmasi">Afirmasi (KIP/Keluarga Tidak Mampu)</option>
                        <option value="Zonasi">Zonasi</option>
                    </select>
                </div>

                <!-- Conditional Fields -->
                <div class="card mt-3" id="conditional_fields_card" style="display: none;">
                    <div class="card-body bg-light">
                        <div id="prestasi_akademik_fields" style="display: none;">
                            <div class="form-group">
                                <label for="nilai_rapor">Nilai Rata-rata Rapor (Semester 1-5)</label>
                                <input type="number" step="0.01" class="form-control" id="nilai_rapor" name="nilai_rapor" placeholder="Contoh: 85.75">
                            </div>
                        </div>
                        <div id="prestasi_non_akademik_fields" style="display: none;">
                            <div class="form-group">
                                <label for="prestasi">Deskripsi Prestasi Non Akademik</label>
                                <textarea class="form-control" id="prestasi" name="prestasi" rows="3" placeholder="Contoh: Juara 1 Lomba Catur Tingkat Kabupaten"></textarea>
                            </div>
                        </div>
                        <div id="afirmasi_fields" style="display: none;">
                            <div class="form-group">
                                <label for="dokumen_kip">Upload Scan Kartu Indonesia Pintar (KIP) atau Surat Keterangan Tidak Mampu (SKTM)</label>
                                <input type="file" class="form-control-file" id="dokumen_kip" name="dokumen_kip">
                                <small class="form-text text-muted">Format: JPG, PNG, PDF. Maksimal 5MB.</small>
                            </div>
                        </div>
                        <div id="zonasi_fields" style="display: none;">
                            <p class="text-info mb-0">Pastikan alamat yang Anda masukkan di atas sudah sesuai dengan Kartu Keluarga untuk verifikasi jalur zonasi.</p>
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Daftar Sekarang</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('jalur_pendaftaran').addEventListener('change', function () {
            var style = this.value;
            var card = document.getElementById('conditional_fields_card');
            var pa_fields = document.getElementById('prestasi_akademik_fields');
            var pna_fields = document.getElementById('prestasi_non_akademik_fields');
            var afirmasi_fields = document.getElementById('afirmasi_fields');
            var zonasi_fields = document.getElementById('zonasi_fields');

            // Hide all first
            pa_fields.style.display = 'none';
            pna_fields.style.display = 'none';
            afirmasi_fields.style.display = 'none';
            zonasi_fields.style.display = 'none';

            if (style === 'Prestasi Akademik') {
                card.style.display = 'block';
                pa_fields.style.display = 'block';
            } else if (style === 'Prestasi Non Akademik') {
                card.style.display = 'block';
                pna_fields.style.display = 'block';
            } else if (style === 'Afirmasi') {
                card.style.display = 'block';
                afirmasi_fields.style.display = 'block';
            } else if (style === 'Zonasi') {
                card.style.display = 'block';
                zonasi_fields.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    </script>
</div>

<?php include 'templates/footer.php'; ?>
