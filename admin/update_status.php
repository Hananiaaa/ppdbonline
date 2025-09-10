<?php
session_start();
include '../config/database.php';

// Security check: ensure admin is logged in
if (!isset($_SESSION['admin_login'])) {
    header("Location: index.php");
    exit;
}

// Check if it is a POST request and if the CSRF token is valid
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    if (isset($_POST['id_siswa']) && isset($_POST['status'])) {
        $id_siswa = $_POST['id_siswa'];
        $new_status = $_POST['status'];

        // Validate status to prevent arbitrary values
        $allowed_statuses = ['diterima', 'ditolak', 'menunggu'];
        if (in_array($new_status, $allowed_statuses)) {
            
            $stmt = $koneksi->prepare("UPDATE calon_siswa SET status_pendaftaran = ? WHERE id_siswa = ?");
            $stmt->bind_param("si", $new_status, $id_siswa);
            
            if ($stmt->execute()) {
                // Redirect back to dashboard after update
                header("Location: dashboard.php?update=sukses");
                exit();
            } else {
                // Handle error
                header("Location: dashboard.php?update=gagal");
                exit();
            }
            $stmt->close();
        } else {
            // Status is not allowed
            header("Location: dashboard.php?update=gagal");
            exit();
        }
    }
}

// If the request is not valid, just redirect to the dashboard
header("Location: dashboard.php");
exit();
?>