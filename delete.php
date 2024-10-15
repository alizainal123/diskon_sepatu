<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // query untuk menghapus data
    $stmt = $db->prepare("DELETE FROM shoes WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Sepatu berhasil dihapus.'); window.location.href='index.php';</script>";
    } else {
        echo "Kesalahan saat menghapus data: " . $db->lastErrorMsg();
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
