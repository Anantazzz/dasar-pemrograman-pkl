<?php
$koneksi = new mysqli("localhost", "root", "", "form");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$judul = $_POST['judul'];
$ringkasan = $_POST['ringkasan'];
$keahlian = isset($_POST['keahlian']) ? json_encode($_POST['keahlian']) : null;
$warna = $_POST['warna_tema'];
$proyek = !empty($_POST['data_proyek']) ? $_POST['data_proyek'] : '[]';
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$terbuka = isset($_POST['terbuka']) ? 1 : 0;
$layanan_array = $_POST['layanan'] ?? [];
$layanan_json = json_encode($layanan_array); 
$setuju = isset($_POST['setuju']) ? 1 : 0;

$stmt = $koneksi->prepare("INSERT INTO portofolio (judul, ringkasan, keahlian, warna, proyek, longitude, latitude, terbuka, layanan, setuju) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssisi", 
    $judul, 
    $ringkasan, 
    $keahlian, 
    $warna, 
    $proyek, 
    $longitude, 
    $latitude, 
    $terbuka, 
    $layanan_json, 
    $setuju
);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;

    if (!empty($_FILES['gambar']['name'][0])) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        foreach ($_FILES['gambar']['name'] as $key => $name) {
            $tmp_name = $_FILES['gambar']['tmp_name'][$key];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $new_name = uniqid() . '.' . $ext;
            $target = $upload_dir . $new_name;

            if (move_uploaded_file($tmp_name, $target)) {
                $koneksi->query("INSERT INTO portofolio_gambar (portofolio_id, nama_file) VALUES ($last_id, '$new_name')");
            }
        }
    }

    echo "✅ Data berhasil disimpan!";
    echo "<br><a href='form_portofolio.php'>⬅️ Kembali ke form</a>";
} else {
    echo "❌ Gagal simpan: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>
