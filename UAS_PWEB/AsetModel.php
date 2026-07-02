<?php
class AsetModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Mengambil semua data untuk tabel
    public function getAll() {
        $sql = "SELECT * FROM aset ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil satu data berdasarkan ID (Penting untuk Fitur Edit)
    public function getById($id) {
        $sql = "SELECT * FROM aset WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Statistik untuk Dashboard
    public function getStats() {
        $sql = "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN kondisi = 'Baik' THEN 1 ELSE 0 END) as baik,
                SUM(CASE WHEN kondisi = 'Rusak' THEN 1 ELSE 0 END) as rusak
                FROM aset";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambah data baru
    public function tambah($nama, $merek, $harga, $lokasi, $kondisi, $pj) {
        $sql = "INSERT INTO aset (nama_aset, merek_tipe, harga_perolehan, lokasi, kondisi, penanggung_jawab) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nama, $merek, $harga, $lokasi, $kondisi, $pj]);
    }

    // Update data (Untuk fitur edit)
    public function update($id, $nama, $merek, $harga, $lokasi, $kondisi, $pj) {
        $sql = "UPDATE aset SET nama_aset=?, merek_tipe=?, harga_perolehan=?, lokasi=?, kondisi=?, penanggung_jawab=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nama, $merek, $harga, $lokasi, $kondisi, $pj, $id]);
    }

    // Menghapus data
    public function delete($id) {
        $sql = "DELETE FROM aset WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>