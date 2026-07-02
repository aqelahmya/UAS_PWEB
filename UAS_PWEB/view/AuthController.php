<?php
// view/AuthController.php
session_start();

// Perbaikan: Hapus '/config' karena Database.php berada langsung di folder UAS_PWEB/
require_once '../Database.php';

class AuthController {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $hashedPassword]);
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            // Berhasil: Arahkan ke dashboard di folder yang sama
            header("Location: dashboard.php");
            exit;
        } else {
            // Gagal: Kembali ke login di folder yang sama
            echo "<script>alert('Login Gagal! Username atau Password salah.'); window.location='login.php';</script>";
        }
    }
}

$auth = new AuthController();

if (isset($_POST['login'])) {
    $auth->login($_POST['username'], $_POST['password']);
}

if (isset($_POST['register'])) {
    $success = $auth->register($_POST['username'], $_POST['password']);
    if ($success) {
        echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi Gagal!'); window.location='registrasi.php';</script>";
    }
}
?>