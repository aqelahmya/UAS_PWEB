<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../model/AsetModel.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
// Ambil data berdasarkan kategori yang dikirim via URL
$kategori = $_GET['kategori'];
// ... (Logika ambil data sama seperti di laporan.php)

$html = "<h3>Laporan Aset Kategori: $kategori</h3><table border='1'>...</table>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("laporan_aset.pdf");
?>