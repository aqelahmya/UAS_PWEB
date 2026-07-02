<?php
require_once '../Database.php';
$db = (new Database())->getConnection();

if (isset($_GET['id']) && isset($_GET['aksi'])) {
    $id = $_GET['id'];
    $aksi = $_GET['aksi'];
    $status_baru = ($aksi == 'setujui') ? 'aktif' : 'ditolak';

    $sql = "UPDATE aset SET status = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$status_baru, $id]);

    header("Location: validasi.php");
    exit;
}
?>