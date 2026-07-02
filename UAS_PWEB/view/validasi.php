<?php 
session_start(); 
require_once '../Database.php'; 
$db = (new Database())->getConnection();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <?php include 'sidebar.php'; ?>
    
    <div style="margin-left: 270px; padding: 20px;">
        <div class="card p-4 shadow-sm">
            <h3 class="text-success mb-4"><i class="fas fa-check-circle me-2"></i>Validasi Aset Baru</h3>
            
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr><th>ID</th><th>Nama Aset</th><th>Penanggung Jawab</th><th>Tanggal</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php 
                    // Mengambil data yang masih pending
                    $query = $db->query("SELECT * FROM aset WHERE status = 'pending'");
                    $data = $query->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($data) > 0):
                        foreach($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['nama_aset'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['penanggung_jawab'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['tanggal_beli'] ?? '') ?></td>
                            <td>
                                <a href="proses_validasi.php?id=<?= $row['id'] ?>&aksi=setujui" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Setujui</a>
                                <a href="proses_validasi.php?id=<?= $row['id'] ?>&aksi=tolak" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Tolak</a>
                            </td>
                        </tr>
                    <?php endforeach; 
                    else: echo "<tr><td colspan='5' class='text-center'>Tidak ada data yang menunggu validasi</td></tr>";
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>