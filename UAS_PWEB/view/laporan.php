<?php
session_start();
require_once '../config/Database.php';
require_once '../model/AsetModel.php';

$db = (new Database())->getConnection();
$model = new AsetModel($db);

// Filter berdasarkan kategori yang dipilih user
$kategori = $_GET['kategori'] ?? 'Semua';
$data = ($kategori == 'Semua') ? $model->getAll() : $model->search($kategori);
?>
<div class="card p-4">
    <h3>Laporan Data Aset</h3>
    <form method="GET" class="mb-3">
        <select name="kategori" class="form-select d-inline w-25">
            <option value="Semua">Semua Kategori</option>
            </select>
        <button class="btn btn-primary">Filter</button>
        <a href="export_pdf.php?kategori=<?= $kategori ?>" class="btn btn-danger">Export PDF</a>
        <a href="export_excel.php?kategori=<?= $kategori ?>" class="btn btn-success">Export Excel</a>
    </form>
    </div>