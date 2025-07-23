<?php
$conn = mysqli_connect("localhost", "root", "", "form");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tipe = $_POST['tipe_pengguna'];
    $telepon = $_POST['telepon'];
    $bio = $_POST['bio'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $gambar);

    $sql = "INSERT INTO registrasi (nama, email, password, tipe_pengguna, telepon, bio, gambar)
            VALUES ('$nama', '$email', '$password', '$tipe', '$telepon', '$bio', '$gambar')";
    mysqli_query($conn, $sql);

    echo "<script>alert('Registrasi berhasil!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pengguna</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h2>Registrasi Pengguna</h2>
        <form method="POST" enctype="multipart/form-data">
            <h4>Informasi Akun</h4>

            <label>Nama Lengkap:</label>
            <input type="text" name="nama" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Kata Sandi:</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁</span>
            </div>

            <label>Konfirmasi Kata Sandi:</label>
            <div class="password-wrapper">
                <input type="password" id="confirm-password" required>
                <span class="toggle-password" onclick="toggleConfirmPassword()">👁</span>
            </div>

            <label>Tipe Pengguna:</label>
            <label><input type="radio" name="tipe_pengguna" value="Klien" required> Klien</label>
            <label><input type="radio" name="tipe_pengguna" value="Freelancer"> Freelancer</label>

            <h4>Detail Tambahan</h4>

            <label>Nomor Telepon:</label>
            <input type="text" name="telepon" maxlength="13" required>

            <label>Bio (khusus Freelancer):</label>
            <textarea name="bio" required></textarea>

            <label>Gambar Profil:</label>
            <input type="file" name="gambar" accept="image/*" required>

            <button type="submit">Daftar Sekarang</button>
        </form>
    </div>

    <script>
    function togglePassword() {
        const input = document.getElementById("password");
        input.type = input.type === "password" ? "text" : "password";
    }

    function toggleConfirmPassword() {
        const input = document.getElementById("confirm-password");
        input.type = input.type === "password" ? "text" : "password";
    }
    </script>
</body>
</html>
