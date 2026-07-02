<?php 
session_start(); 
// Cek login
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }

require_once '../Database.php'; 
$db = (new Database())->getConnection(); 

// Mengambil data, pastikan nama tabel 'aset' benar
$query = "SELECT * FROM aset ORDER BY id ASC";
$stmt = $db->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-success"><i class="fas fa-box-open me-2"></i>Aset Barang</h3>
                <div>
                    <a href="tambah.php" class="btn btn-primary btn-sm"><i class="fas fa-plus me-2"></i>Tambah</a>
                    <button onclick="window.print()" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf me-2"></i>PDF</button>
                    <button onclick="downloadExcel()" class="btn btn-success btn-sm"><i class="fas fa-file-excel me-2"></i>Excel</button>
                </div>
            </div>

            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari nama aset..." onkeyup="filterTable()">
            </div>

            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Foto</th><th>ID</th><th>Nama</th><th>PJ</th><th>Tgl</th><th>Kondisi</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if($data && count($data) > 0): foreach($data as $row): ?>
                    <tr>
                        <td><img src="../uploads/<?= htmlspecialchars($row['foto'] ?? 'default.png') ?>" width="50"></td>
                        <td><?= htmlspecialchars($row['id'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['nama_aset'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['penanggung_jawab'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['tanggal_up'] ?? '-') ?></td>
                        <td>
                            <span class="badge bg-<?= ($row['kondisi']=='Baik')?'success':'danger' ?>">
                                <?= htmlspecialchars($row['kondisi'] ?? '-') ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; else: echo "<tr><td colspan='7' class='text-center'>Data tidak ditemukan atau kosong.</td></tr>"; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script>
        function filterTable() {
            let val = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.getElementById("tableBody").getElementsByTagName("tr");
            for (let r of rows) {
                let name = r.getElementsByTagName("td")[2].textContent.toLowerCase();
                r.style.display = name.includes(val) ? "" : "none";
            }
        }
        function downloadExcel() {
            XLSX.writeFile(XLSX.utils.table_to_book(document.querySelector(".table")), 'Data_Aset.xlsx');
        }
    </script>
</body>
</html>