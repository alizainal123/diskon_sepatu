<?php
include 'db.php';

$results = $db->query("SELECT * FROM shoes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Manajemen Diskon Sepatu</title>
</head>
<body>
    <div class="container">
        <h1>Daftar Merek Sepatu</h1>
        <a href="add.php" class="btn">Tambah Merek Sepatu</a>
        <div class="shoe-list">
            <?php while ($shoe = $results->fetchArray(SQLITE3_ASSOC)): ?>
                <div class="shoe-item">
                    <div class="shoe-image">
                        <?php if ($shoe['image']): ?>
                            <img src="<?php echo htmlspecialchars($shoe['image']); ?>" alt="<?php echo htmlspecialchars($shoe['name']); ?>" class="shoe-img">
                        <?php endif; ?>
                    </div>
                    <div class="shoe-details">
                        <h2><?php echo htmlspecialchars($shoe['name']); ?></h2>
                        <p class="original-price">Harga Asli: RP <?php echo number_format($shoe['original_price'], 2); ?></p>
                        <p class="discount">Diskon: <?php echo htmlspecialchars($shoe['discount']); ?>%</p>
                        <p class="final-price">
                            Harga Setelah Diskon: RP <?php echo number_format($shoe['original_price'] * (1 - $shoe['discount'] / 100), 2); ?>
                        </p>
                    </div>
                    <div class="shoe-actions">
                        <a href="edit.php?id=<?php echo $shoe['id']; ?>" class="action-btn">Edit</a>
                        <a href="delete.php?id=<?php echo $shoe['id']; ?>" class="action-btn delete" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
