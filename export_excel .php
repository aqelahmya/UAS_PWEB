<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_aset.xls");

// Ambil data dan tampilkan dalam bentuk table HTML biasa
// Browser akan otomatis menganggap ini file Excel
echo "<table border='1'><tr><th>ID</th><th>Nama</th><th>Kategori</th></tr>";
// ... (loop data)
echo "</table>";
?>