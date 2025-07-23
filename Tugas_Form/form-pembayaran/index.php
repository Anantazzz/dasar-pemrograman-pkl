<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Proyek</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proyek = $_POST['proyek'];
    $jumlah = intval($_POST['jumlah']);
    $metode = $_POST['metode'];
    $setuju = isset($_POST['setuju']) ? 1 : 0;

    if ($jumlah < 0 || $jumlah % 100 != 0) {
        echo "<p class='error'>Jumlah pembayaran harus kelipatan 100 dan tidak boleh negatif.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO pembayaran (proyek, jumlah, metode, setuju) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $proyek, $jumlah, $metode, $setuju);
        $stmt->execute();
    }
}
?>

<div class="card">
    <h2>Pembayaran Proyek</h2>
    <form method="POST">
        <p>Proyek: <strong>Pembangunan Aplikasi E-commerce</strong></p>
        <input type="hidden" name="proyek" value="Pembangunan Aplikasi E-commerce">

        <label>Jumlah Pembayaran (IDR):</label>
        <input type="number" name="jumlah" step="100" min="0" required>

        <label>Metode Pembayaran:</label>
        <select name="metode">
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="Transfer Bank">Tunai</option>
        </select>

        <div class="agreement">
            <label for="setuju">Saya setuju dengan syarat dan ketentuan pembayaran:</label>
            <label class="switch">
                <input type="checkbox" name="setuju" id="setuju">
                <span class="slider round"></span>
            </label>
        </div>

        <button type="submit">Lanjutkan Pembayaran</button>
    </form>
</div>
</body>
</html>
