<?php 
session_start(); 
require_once '../Database.php'; 
require_once '../AsetModel.php'; 
$db = (new Database())->getConnection(); 
$model = new AsetModel($db); 
$stats = $model->getStats(); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content { margin-left: 270px; padding: 20px; }
        .card-stat { border-left: 5px solid #28a745; border-radius: 10px; }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <h3 class="mb-4">Dashboard</h3>
        
        <!-- Statistik Ringkasan -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card p-3 shadow-sm card-stat"><h6>Total Aset</h6><h3><?= $stats['total'] ?? 0 ?></h3></div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm card-stat"><h6>Kondisi Baik</h6><h3><?= $stats['baik'] ?? 0 ?></h3></div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm card-stat"><h6>Kondisi Rusak</h6><h3><?= $stats['rusak'] ?? 0 ?></h3></div>
            </div>
        </div>

        <!-- Tabel Ringkasan (Opsional: Agar ada fitur Search dan Aksi di Dashboard) -->
        <div class="card p-4 shadow-sm">
            <div class="d-flex justify-content-between mb-3">
                <h5>Data Aset Terkini</h5>
                <a href="preview.php" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> Lihat Laporan</a>
            </div>
            <input type="text" id="searchInput" class="form-control mb-3 w-25" placeholder="🔍 Cari aset...">
            <table class="table table-hover" id="tabelDashboard">
                <thead class="table-success">
                    <tr><th>Nama</th><th>Kondisi</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php 
                    $data = $model->getAll();
                    foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_aset']) ?></td>
                        <td><?= htmlspecialchars($row['kondisi']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Fitur Search
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let val = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tabelDashboard tbody tr');
            rows.forEach(row => row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none');
        });
    </script>
</body>
</html>