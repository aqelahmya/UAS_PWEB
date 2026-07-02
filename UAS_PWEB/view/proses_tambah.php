<?php
require_once '../Database.php';
$db = (new Database())->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. VALIDASI: Cek apakah input kosong
    if (empty($_POST['id']) || empty($_POST['nama']) || empty($_FILES['foto']['name'])) {
        echo "<script>alert('Semua data wajib diisi!'); window.location='tambah.php';</script>";
        exit;
    }

    // 2. VALIDASI: Cek ekstensi file (agar hanya gambar yang bisa diupload)
    $nama_file = $_FILES['foto']['name'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', $nama_file);
    $ekstensi = strtolower(end($x));

    if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
        echo "<script>alert('File harus berupa JPG, JPEG, atau PNG!'); window.location='tambah.php';</script>";
        exit;
    }

    // 3. PROSES UPLOAD & SIMPAN
    $lokasi_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi_tmp, "../uploads/" . $nama_file);

    $sql = "INSERT INTO aset (id, nama_aset, penanggung_jawab, tanggal_up, kondisi, foto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_POST['id'], $_POST['nama'], $_POST['pj'], $_POST['tanggal_up'], $_POST['kondisi'], $nama_file]);

    header("Location: aset.php");
    exit;
}
?>