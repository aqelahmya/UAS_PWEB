<?php
require_once '../config/Database.php';

if (isset($_POST['daftar'])) {
    $db = (new Database())->getConnection();
    $username = $_POST['username'];
    // Gunakan password_hash untuk keamanan tingkat lanjut (nilai plus!)
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username, $password]);
    echo "<script>alert('Registrasi berhasil!'); window.location='login.php';</script>";
}
?>
<form method="POST" class="p-5">
    <h3>Registrasi Pengguna</h3>
    <input type="text" name="username" placeholder="Nama Lengkap/Username" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
</form>