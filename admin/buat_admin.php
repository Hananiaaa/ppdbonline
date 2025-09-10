<?php
// File ini hanya untuk keperluan development. Hapus atau amankan file ini di lingkungan produksi.

// --- KONFIGURASI ---
$password_to_hash = 'admin123'; // Ganti dengan password yang Anda inginkan
$username = 'admin'; // Ganti dengan username yang Anda inginkan
$role = 'superadmin'; // Role untuk admin
// -------------------

// Generate hash password yang aman
$hashed_password = password_hash($password_to_hash, PASSWORD_DEFAULT);

// Tampilkan hasil
echo "<h2>Informasi Akun Admin Baru</h2>";
echo "<p>Gunakan informasi di bawah ini untuk dimasukkan ke dalam tabel 'admin' di database Anda.</p>";
echo "<hr>";
echo "<p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>";
echo "<p><strong>Password (untuk dimasukkan ke DB):</strong></p>";
echo "<pre style='background-color:#f0f0f0; padding:10px; border:1px solid #ccc; word-wrap:break-word;'>" . htmlspecialchars($hashed_password) . "</pre>";
echo "<p><strong>Role:</strong> " . htmlspecialchars($role) . "</p>";
echo "<hr>";

// Contoh query SQL untuk memasukkan data (JANGAN dijalankan langsung dari sini)
echo "<h3>Contoh Query SQL</h3>";
echo "<p>Anda bisa menggunakan query ini di phpMyAdmin atau konsol MySQL Anda:</p>";
echo "<pre style='background-color:#f0f0f0; padding:10px; border:1px solid #ccc;'>";
echo "INSERT INTO admin (username, password, role) VALUES (
    '" . htmlspecialchars($username) . "',
    '" . htmlspecialchars($hashed_password) . "',
    '" . htmlspecialchars($role) . "'
);";
echo "</pre>";
echo "<p style='color:red;'><strong>PENTING:</strong> Setelah membuat admin baru, hapus atau ganti password admin lama yang menggunakan MD5.</p>";

?>