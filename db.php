<?php
// Membuat koneksi ke database SQLite
$db = new SQLite3('shoes.db');


$db->exec("CREATE TABLE IF NOT EXISTS shoes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    original_price REAL NOT NULL,
    discount INTEGER NOT NULL,
    image TEXT
)");
?>
