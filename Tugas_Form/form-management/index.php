<?php
$conn = new mysqli("localhost", "root", "", "form");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['judul_tugas'])) {
    $proyek = "Pembangunan Aplikasi E-commerce";
    $judul_tugas = $_POST['judul_tugas'];
    $deskripsi_tugas = $_POST['deskripsi_tugas'];
    $batas_akhir = $_POST['batas_akhir'];
    $status = $_POST['status'];
    $progress = $_POST['progress'];

    $conn->query("DELETE FROM management WHERE proyek = '$proyek'");

    for ($i = 0; $i < count($judul_tugas); $i++) {
        if (trim($judul_tugas[$i]) == "") continue;

        $stmt = $conn->prepare("INSERT INTO management (proyek, judul_tugas, deskripsi_tugas, batas_akhir, status, progress) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $proyek, $judul_tugas[$i], $deskripsi_tugas[$i], $batas_akhir[$i], $status[$i], $progress[$i]);
        $stmt->execute();
    }

    header("Location: index.php?success=1");
    exit;
}

$data = $conn->query("SELECT * FROM management WHERE proyek = 'Pembangunan Aplikasi E-commerce'");
$tugas = $data->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Tugas Proyek</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post">
        <div class="card">
            <h2>Manajemen Tugas Proyek</h2>
            <p>Proyek: <strong>Pembangunan Aplikasi E-commerce</strong></p>

            <table>
                <thead>
                    <tr>
                        <th>JUDUL TUGAS</th>
                        <th>DESKRIPSI TUGAS</th>
                        <th>BATAS AKHIR</th>
                        <th>STATUS</th>
                        <th>PROGRES (%)</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody id="taskBody">
                    <?php foreach ($tugas as $row): ?>
                    <tr>
                        <td><input type="text" name="judul_tugas[]" value="<?= htmlspecialchars($row['judul_tugas']) ?>"></td>
                        <td><input type="text" name="deskripsi_tugas[]" value="<?= htmlspecialchars($row['deskripsi_tugas']) ?>"></td>
                        <td><input type="date" name="batas_akhir[]" value="<?= $row['batas_akhir'] ?>"></td>
                        <td>
                            <select name="status[]">
                                <option <?= $row['status'] == "Belum Mulai" ? "selected" : "" ?>>Belum Mulai</option>
                                <option <?= $row['status'] == "Dalam Proses" ? "selected" : "" ?>>Dalam Proses</option>
                                <option <?= $row['status'] == "Selesai" ? "selected" : "" ?>>Selesai</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="progress[]" value="<?= $row['progress'] ?>">
                            <input type="range" min="0" max="100" value="<?= $row['progress'] ?>" oninput="this.previousElementSibling.value = this.value">
                        </td>
                        <td><span class="delete" onclick="hapusBaris(this)">X</span></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><input type="text" name="judul_tugas[]" placeholder="Judul Tugas"></td>
                        <td><input type="text" name="deskripsi_tugas[]" placeholder="Deskripsi detail"></td>
                        <td><input type="date" name="batas_akhir[]"></td>
                        <td>
                            <select name="status[]">
                                <option>Belum Mulai</option>
                                <option>Dalam Proses</option>
                                <option>Selesai</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="progress[]" value="0">
                            <input type="range" min="0" max="100" value="0" oninput="this.previousElementSibling.value = this.value">
                        </td>
                        <td><span class="delete" onclick="hapusBaris(this)">X</span></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="add" onclick="tambahTugas()">+ Tambah Tugas</button>
            <button type="submit" class="submit">Simpan Perubahan Tugas</button>

            <?php if (isset($_GET['success'])): ?>
                <p class="success">✅ Tugas berhasil diperbarui!</p>
            <?php endif; ?>
        </div>
    </form>

<script>
function tambahTugas() {
    const tbody = document.getElementById('taskBody');
    const row = tbody.rows[tbody.rows.length - 1].cloneNode(true);
    const inputs = row.querySelectorAll('input, select');

    inputs.forEach(input => {
        if (input.type === 'text' || input.tagName === 'SELECT') input.value = '';
        if (input.type === 'date') input.value = '';
        if (input.type === 'hidden') input.value = '0';
        if (input.type === 'range') input.value = 0;
    });

    tbody.appendChild(row);
}

function hapusBaris(el) {
    const row = el.closest('tr');
    if (document.querySelectorAll('#taskBody tr').length > 1) row.remove();
}
</script>
</body>
</html>
