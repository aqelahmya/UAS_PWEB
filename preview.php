<?php
session_start();
require_once '../Database.php';
require_once '../AsetModel.php';
$db = (new Database())->getConnection();
$model = new AsetModel($db);
$data_aset = $model->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Preview Laporan Aset</title>
</head>
<body class="p-5 bg-light">
    <div class="card p-4 shadow-sm">
        <!-- Header dengan tombol Export yang berdampingan -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-success"><i class="fas fa-file-alt"></i> Pratinjau Laporan Aset</h3>
            <div>
                <button onclick="window.print()" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button>
                <button onclick="downloadExcel()" class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</button>
            </div>
        </div>
        
        <table class="table table-bordered" id="tabelPreview">
            <thead class="table-success">
                <tr><th>ID</th><th>Nama</th><th>Merek</th><th>Harga</th><th>Lokasi</th><th>PJ</th></tr>
            </thead>
            <tbody>
                <?php foreach($data_aset as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($row['nama_aset'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($row['merek_tipe'] ?? '-') ?></td>
                    <td>Rp <?= number_format((float)($row['harga_perolehan'] ?? 0), 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row['lokasi'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($row['penanggung_jawab'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script>
    function downloadExcel() {
        var wb = XLSX.utils.table_to_book(document.getElementById('tabelPreview'), {sheet: "Laporan Aset"});
        XLSX.writeFile(wb, 'Laporan_Aset.xlsx');
    }
    </script>
</body>
</html>