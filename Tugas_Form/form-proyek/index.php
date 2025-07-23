<?php
$conn = new mysqli("localhost", "root", "", "form");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $detail = $_POST["detail"];
    $deskripsi = $_POST["deskripsi"];
    $kategori = $_POST["kategori"];
    $anggaran = $_POST["anggaran"];
    $batas_akhir = $_POST["batas_akhir"];
    $lokasi = $_POST["lokasi"];

    $fileName = "";
    if (isset($_FILES["lampiran"]) && $_FILES["lampiran"]["error"] == 0) {
        $allowed = ['image/png', 'image/jpeg', 'application/pdf'];
        if (in_array($_FILES["lampiran"]["type"], $allowed)) {
            $fileName = basename($_FILES["lampiran"]["name"]);
            move_uploaded_file($_FILES["lampiran"]["tmp_name"], "uploads/" . $fileName);
        }
    }

    $stmt = $conn->prepare("INSERT INTO proyek (detail, deskripsi, kategori, anggaran, batas_akhir, file_lampiran, lokasi) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $detail, $deskripsi, $kategori, $anggaran, $batas_akhir, $fileName, $lokasi);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Posting Proyek Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data" class="card">
        <h2>Posting Proyek Baru</h2>

        <label>Detail Proyek</label>
        <textarea name="detail" required></textarea>

        <label>Deskripsi Proyek:</label>
        <textarea name="deskripsi" required></textarea>

        <label>Kategori Proyek:</label>
        <select name="kategori" required>
            <option value="" disabled selected>-- Pilih Kategori --</option>
            <option value="Penulisan Konten">Penulisan Konten</option>
            <option value="Desain Grafis">Desain Grafis</option>
            <option value="Pengembangan Web">Pengembangan Web</option>
        </select>

        <label>Anggaran Proyek (IDR):</label>
        <input type="number" name="anggaran" required>

        <label>Batas Akhir Penawaran:</label>
        <input type="datetime-local" name="batas_akhir" required>

        <label>Lampiran Proyek:</label>
        <input type="file" name="lampiran" accept=".png,.jpg,.jpeg,.pdf">

        <label>Lokasi Pengerjaan:</label>
        <div class="radio-group">
            <label><input type="radio" name="lokasi" value="Remote" required> Remote</label>
            <label><input type="radio" name="lokasi" value="Onsite" required> Onsite</label>
        </div>

        <button type="submit">Posting Proyek</button>

        <?php if (isset($_GET['success'])): ?>
            <p class="success">✅ Proyek berhasil diposting!</p>
        <?php endif; ?>
    </form>
</body>
</html>
