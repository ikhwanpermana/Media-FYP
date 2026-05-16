<?php
require_once 'koneksi.php';
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = $_POST['title'];
    $category = $_POST['category'];
    $content  = $_POST['content'];

    if (!empty($title) && !empty($category) && !empty($content)) {
        try {
            $sql = "INSERT INTO articles (title, category, content, views) VALUES (:title, :category, :content, 0)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':title'    => $title,
                ':category' => $category,
                ':content'  => $content
            ]);
            $pesan = "<div style='color: green; font-weight: bold; margin-bottom: 15px;'>🔥 Berita FYP Berhasil Ditambahkan!</div>";
        } catch (PDOException $e) {
            $pesan = "<div style='color: red; margin-bottom: 15px;'>Gagal menyimpan: " . $e->getMessage() . "</div>";
        }
    } else {
        $pesan = "<div style='color: red; margin-bottom: 15px;'>Semua kolom wajib diisi!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Berita FYP</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .box { max-width: 500px; background: white; padding: 20px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, select, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { height: 120px; }
        button { background-color: #ff0050; color: white; border: none; padding: 12px; font-weight: bold; width: 100%; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
<div class="box">
    <h2>Tulis Berita Viral 🔥</h2>
    <?= $pesan; ?>
    <form action="input-berita.php" method="POST">
        <label>Judul Berita</label>
        <input type="text" name="title" placeholder="Ketik judul yang bikin penasaran..." required>
        
        <label>Kategori</label>
        <select name="category" required>
            <option value="Hiburan">Hiburan / Gosip</option>
            <option value="Teknologi">Teknologi / Gadget</option>
            <option value="Politik">Politik</option>
        </select>

        <label>Isi Berita</label>
        <textarea name="content" placeholder="Tulis berita lengkap di sini..." required></textarea>

        <button type="submit">Publish Sekarang</button>
    </form>
    <p><a href="index.php">➡️ Lihat Halaman Depan Website</a></p>
</div>
</body>
</html>
