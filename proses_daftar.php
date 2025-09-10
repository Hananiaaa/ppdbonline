<?php
include 'config/database.php';

// Fungsi untuk menampilkan pesan error dan menghentikan skrip
function handleError($message) {
    // Di lingkungan produksi, Anda mungkin ingin mencatat error ini alih-alih menampilkannya.
    die("Error: " . $message);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan sanitasi semua data dari form untuk mencegah XSS
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
    $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $agama = htmlspecialchars($_POST['agama']);
    $nisn = htmlspecialchars($_POST['nisn']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $email = htmlspecialchars($_POST['email']);
    $asal_sekolah = htmlspecialchars($_POST['asal_sekolah']);
    $nama_orang_tua = htmlspecialchars($_POST['nama_orang_tua']);
    $jalur_pendaftaran = htmlspecialchars($_POST['jalur_pendaftaran']);

    // Validasi dasar untuk field baru
    $required_fields = [
        $nama_lengkap, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, 
        $nisn, $alamat, $no_hp, $email, $asal_sekolah, $nama_orang_tua, $jalur_pendaftaran
    ];
    foreach ($required_fields as $field) {
        if (empty($field)) {
            handleError("Semua field wajib diisi.");
        }
    }

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        handleError("Format email tidak valid.");
    }

    // Inisialisasi variabel jalur spesifik
    $nilai_rapor = NULL;
    $prestasi = NULL;
    $dokumen_kip_path = NULL;

    // Generate nomor pendaftaran unik (sementara)
    $no_pendaftaran_sementara = "TEMP-" . uniqid();

    // Logika berdasarkan jalur pendaftaran
    if ($jalur_pendaftaran == 'Prestasi Akademik') {
        if (!empty($_POST['nilai_rapor']) && is_numeric($_POST['nilai_rapor'])) {
            $nilai_rapor = (float)$_POST['nilai_rapor'];
        } else {
            handleError("Nilai rapor tidak valid.");
        }
    } elseif ($jalur_pendaftaran == 'Prestasi Non Akademik') {
        $prestasi = htmlspecialchars($_POST['prestasi']);
        if (empty($prestasi)) {
            handleError("Deskripsi prestasi tidak boleh kosong.");
        }
    } elseif ($jalur_pendaftaran == 'Afirmasi') {
        if (isset($_FILES['dokumen_kip']) && $_FILES['dokumen_kip']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                if (!mkdir($target_dir, 0755, true)) {
                    handleError("Gagal membuat direktori uploads.");
                }
            }

            $file = $_FILES['dokumen_kip'];
            $max_file_size = 5 * 1024 * 1024; // 5MB
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
            $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if ($file['size'] > $max_file_size) {
                handleError("Ukuran file terlalu besar. Maksimal 5MB.");
            }

            if (!in_array($file_extension, $allowed_extensions)) {
                handleError("Tipe file tidak diizinkan. Hanya JPG, JPEG, PNG, dan PDF.");
            }

            $new_filename = uniqid('kip_', true) . '.' . $file_extension;
            $dokumen_kip_path = $target_dir . $new_filename;

            if (!move_uploaded_file($file["tmp_name"], $dokumen_kip_path)) {
                handleError("Gagal mengunggah file.");
            }
        } else {
            handleError("Dokumen KIP/SKTM wajib diunggah untuk jalur Afirmasi.");
        }
    }

    // Query menggunakan prepared statements untuk keamanan
    $sql = "INSERT INTO calon_siswa (no_pendaftaran, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, nisn, alamat, no_hp, email, asal_sekolah, nama_orang_tua, jalur_pendaftaran, nilai_rapor, prestasi, dokumen_kip, status_pendaftaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'menunggu')";
    $stmt = $koneksi->prepare($sql);
    if ($stmt === false) {
        handleError("Gagal mempersiapkan statement: " . $koneksi->error);
    }

    // Sesuaikan tipe data: s=string, d=double/float
    $stmt->bind_param("sssssssssssssdss", 
        $no_pendaftaran_sementara, $nama_lengkap, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, 
        $nisn, $alamat, $no_hp, $email, $asal_sekolah, $nama_orang_tua, 
        $jalur_pendaftaran, $nilai_rapor, $prestasi, $dokumen_kip_path
    );

    if ($stmt->execute()) {
        $last_id = $stmt->insert_id;
        // Buat nomor pendaftaran final
        $no_pendaftaran_final = "PPDB25-" . str_pad($last_id, 4, '0', STR_PAD_LEFT);

        // Update record dengan nomor pendaftaran final
        $update_stmt = $koneksi->prepare("UPDATE calon_siswa SET no_pendaftaran = ? WHERE id_siswa = ?");
        if ($update_stmt === false) {
            handleError("Gagal mempersiapkan statement update: " . $koneksi->error);
        }
        
        $update_stmt->bind_param("si", $no_pendaftaran_final, $last_id);
        if (!$update_stmt->execute()) {
            handleError("Gagal mengupdate nomor pendaftaran: " . $update_stmt->error);
        }
        $update_stmt->close();

        // Redirect ke halaman sukses
        header("Location: sukses_daftar.php?no_pendaftaran=" . $no_pendaftaran_final);
        exit();
    } else {
        handleError("Gagal mengeksekusi statement: " . $stmt->error);
    }

    $stmt->close();
    $koneksi->close();
} else {
    // Jika bukan metode POST, redirect ke halaman daftar
    header("Location: daftar.php");
    exit();
}
?>