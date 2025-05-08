<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];
    $stmt = $conn->prepare("INSERT INTO tamu (name, komentar) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $pesan);
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM tamu ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form active">
        <h2>Selamat Datang, <?= $_SESSION['name']; ?>!</h2>
        <form method="post">
            <input type="text" name="nama" placeholder="Nama Anda" required>
            <input type="text" name="pesan" placeholder="Pesan" required>
            <button type="submit" name="submit">Kirim</button>
        </form>

        <h2>Daftar Buku Tamu:</h2>
        <?php while($row = $result->fetch_assoc()): ?>
            <div style="background:#fff;padding:10px;margin-top:10px;border-radius:10px;">
                <strong><?= htmlspecialchars($row['nama']) ?></strong><br>
                <p><?= htmlspecialchars($row['komentar']) ?></p>
            </div>
        <?php endwhile; ?>

        <br><a href="logout.php"><button>Logout</button></a>
    </div>
</div>
</body>
</html>
