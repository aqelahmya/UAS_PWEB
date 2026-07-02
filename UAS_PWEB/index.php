<?php
session_start();

// Cek apakah ada session yang aktif
if (isset($_SESSION['username'])) {
    // Kalau sudah login, masuk ke dashboard
    header("Location: view/dashboard.php");
} else {
    // Kalau belum login, masuk ke login
    header("Location: view/login.php");
}
exit();
?>