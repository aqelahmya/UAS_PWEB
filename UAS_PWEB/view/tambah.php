<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow">
            <h3>Tambah Aset Baru</h3>
            <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>ID Aset</label>
                    <input type="text" name="id" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Aset</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Penanggung Jawab</label>
                    <input type="text" name="pj" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal Update</label>
                    <input type="date" name="tanggal_up" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kondisi</label>
                    <select name="kondisi" class="form-control">
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Foto Aset</label>
                    <input type="file" name="foto" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan Data</button>
                <a href="aset.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>