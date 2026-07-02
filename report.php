<?php
session_start();
require_once '../config/Database.php';
require_once '../model/AsetModel.php';

$db = (new Database())->getConnection();
$model = new AsetModel($db);
$data = $model->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2 class="mb-4">Laporan Data Aset Barang</h2>
    <a href="export_pdf.php" class="btn btn-danger mb-3">Download PDF</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama_aset'] ?></td>
                <td><?= $row['kategori'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>