<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $original_price = $_POST['original_price'];
    $discount = $_POST['discount'];
    $image = '';

    // Proses upload gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = 'uploads/';
        $targetFile = $targetDir . $imageName;

        // Memindahkan file ke folder 'uploads'
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $targetFile; // Simpan path gambar
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload gambar.";
        }
    }

    // Menyimpan data sepatu ke database
    $stmt = $db->prepare("INSERT INTO shoes (name, original_price, discount, image) VALUES (:name, :original_price, :discount, :image)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':original_price', $original_price, SQLITE3_FLOAT);
    $stmt->bindValue(':discount', $discount, SQLITE3_INTEGER);
    $stmt->bindValue(':image', $image, SQLITE3_TEXT);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Kesalahan saat menyimpan data: " . $db->lastErrorMsg();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tambah Merek Sepatu</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Merek Sepatu</h1>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Merek Sepatu:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="original_price">Harga Asli:</label>
                <input type="number" id="original_price" name="original_price" required>
            </div>
            <div class="form-group">
                <label for="discount">Diskon (%):</label>
                <input type="number" id="discount" name="discount" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar Sepatu:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn">Simpan</button>
            <a href="index.php" class="btn btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>
