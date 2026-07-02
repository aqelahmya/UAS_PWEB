<?php
session_start();
require_once '../Database.php';
require_once '../AsetModel.php';

$db = (new Database())->getConnection();
$model = new AsetModel($db);

// 1. Ambil ID dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Error: ID tidak ditemukan!");
}

// 2. Ambil data aset berdasarkan ID
$aset = $model->getById($id);

if (!$aset) {
    die("Error: Data tidak ditemukan di database!");
}

// 3. Proses Update jika tombol ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->update($id, $_POST['nama'], $_POST['merek'], $_POST['harga'], $_POST['lokasi'], $_POST['kondisi'], $_POST['pj']);
    header("Location: aset.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="card p-4 shadow w-50 mx-auto">
        <h3>Edit Aset</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Nama Aset</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($aset['nama_aset'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label>Merek/Tipe</label>
                <input type="text" name="merek" class="form-control" value="<?= htmlspecialchars($aset['merek_tipe'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($aset['harga_perolehan'] ?? 0) ?>">
            </div>
            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($aset['lokasi'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label>Kondisi</label>
                <select name="kondisi" class="form-control">
                    <option value="Baik" <?= ($aset['kondisi'] ?? '') == 'Baik' ? 'selected' : '' ?>>Baik</option>
                    <option value="Rusak" <?= ($aset['kondisi'] ?? '') == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Penanggung Jawab</label>
                <input type="text" name="pj" class="form-control" value="<?= htmlspecialchars($aset['penanggung_jawab'] ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="aset.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>