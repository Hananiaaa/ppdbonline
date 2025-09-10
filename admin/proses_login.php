<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    // Ambil data admin berdasarkan username
    $stmt = $koneksi->prepare("SELECT id_admin, username, password, role FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verifikasi password
        $password_valid = false;

        // Cek dengan password_verify (untuk hash modern)
        if (password_verify($password_input, $admin['password'])) {
            $password_valid = true;
        } 
        // Cek dengan MD5 (untuk password lama)
        else if (md5($password_input) === $admin['password']) {
            $password_valid = true;
        }

        if ($password_valid) {
            // Regenerate session ID untuk mencegah session fixation
            session_regenerate_id(true);

            // Set session variables
            $_SESSION['admin_login'] = true;
            $_SESSION['admin_id'] = $admin['id_admin'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_role'] = $admin['role'];

            // Cek jika password perlu di-rehash (jika masih menggunakan MD5 atau algoritma lama)
            if (password_needs_rehash($admin['password'], PASSWORD_DEFAULT)) {
                $new_hash = password_hash($password_input, PASSWORD_DEFAULT);
                $rehash_stmt = $koneksi->prepare("UPDATE admin SET password = ? WHERE id_admin = ?");
                $rehash_stmt->bind_param("si", $new_hash, $admin['id_admin']);
                $rehash_stmt->execute();
                $rehash_stmt->close();
            }

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Jika password salah
            header("Location: index.php?error=1");
            exit();
        }
    } else {
        // Jika username tidak ditemukan
        header("Location: index.php?error=1");
        exit();
    }

    $stmt->close();
    $koneksi->close();
} else {
    header("Location: index.php");
    exit();
}
?>