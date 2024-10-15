<?php
include 'db.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data sepatu berdasarkan ID
$shoe = $db->querySingle("SELECT * FROM shoes WHERE id = $id", true);

if (!$shoe) {
    die("Sepatu tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $original_price = $_POST['original_price'];
    $discount = $_POST['discount'];

    // Perbarui data sepatu
    $db->exec("UPDATE shoes SET name = '$name', original_price = $original_price, discount = $discount WHERE id = $id");

    // Redirect ke halaman index setelah berhasil
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit Sepatu</title>
</head>
<body>
    <div class="container">
        <h1>Edit Sepatu</h1>
        <form method="POST">
            <label for="name">Nama Sepatu:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($shoe['name']) ?>" required>
            <label for="original_price">Harga Asli:</label>
            <input type="number" name="original_price" value="<?= htmlspecialchars($shoe['original_price']) ?>" required>
            <label for="discount">Diskon (%):</label>
            <input type="number" name="discount" value="<?= htmlspecialchars($shoe['discount']) ?>" required>
            <button type="submit" class="btn">Simpan</button>
        </form>
        <a href="index.php" class="btn" style="background-color: #6c757d;">Kembali</a>
    </div>
</body>
</html>
