<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "form";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proyek = "Desain Logo Perusahaan Baru"; 
    $penawaran = intval($_POST['penawaran']);
    $pesan = $conn->real_escape_string($_POST['pesan']);
    $durasi = intval($_POST['durasi']);

    if ($penawaran < 0 || $durasi < 0 || floor($durasi) != $durasi) {
        $error = "Input tidak valid!";
    } else {
        $sql = "INSERT INTO pengajuan (proyek, penawaran, pesan, durasi)
                VALUES ('$proyek', $penawaran, '$pesan', $durasi)";
        if ($conn->query($sql) === TRUE) {
            $success = "Penawaran berhasil diajukan!";
        } else {
            $error = "Gagal mengirim: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Penawaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
       <h2 style="text-align: center;">Pengajuan Penawaran</h2>
        <p class="center-text">Untuk Proyek: <strong>Desain Logo Perusahaan Baru</strong></p>

        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

        <form method="POST" action="">
            <label>Jumlah Penawaran Anda (IDR):</label>
            <input type="number" name="penawaran" placeholder="Contoh: 4500000" required min="0" step="1">

            <label>Pesan / Proposal Anda:</label>
            <textarea name="pesan" placeholder="Saya sangat tertarik dengan proyek ini dan yakin bisa memberikan hasil terbaik..." required></textarea>

            <label>Perkiraan Durasi Pengerjaan (Hari):</label>
            <input type="number" name="durasi" placeholder="Contoh: 7" required min="1" step="1">

            <button type="submit">Ajukan Penawaran</button>
        </form>
    </div>
</body>
</html>
