<?php
$koneksi = new mysqli("localhost", "root", "", "form");

if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

$pesan = "";

if (isset($_POST['submit'])) {
  $rating = $_POST['rating'];
  $komentar = htmlspecialchars($_POST['komentar']);

  if ($rating != "" && $komentar != "") {
    $sql = "INSERT INTO ulasan (rating, ulasan) VALUES ('$rating', '$komentar')";
    if ($koneksi->query($sql) === TRUE) {
      $pesan = "<p class='sukses'>Ulasan berhasil disimpan!</p>";
    } else {
      $pesan = "<p class='error'>Gagal menyimpan: " . $koneksi->error . "</p>";
    }
  } else {
    $pesan = "<p class='error'>Harap isi rating dan komentar.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beri Ulasan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h2>Beri Ulasan</h2>
    <p>Untuk <strong>[Nama Pengguna Freelancer/Klien]</strong> pada proyek: <strong>Desain Logo Perusahaan Baru</strong></p>

    <?php echo $pesan; ?>

    <form action="" method="POST">
      <label>Rating:</label>
      <div class="rating">
        <span data-value="1">&#9733;</span>
        <span data-value="2">&#9733;</span>
        <span data-value="3">&#9733;</span>
        <span data-value="4">&#9733;</span>
        <span data-value="5">&#9733;</span>
      </div>
      
      <input type="hidden" name="rating" id="rating">

      <label for="komentar">Komentar:</label>
      <textarea name="komentar" id="komentar" placeholder="Ceritakan pengalaman Anda..."></textarea>

      <button type="submit" name="submit">Kirim Ulasan</button>
    </form>
  </div>

  <script>
    const stars = document.querySelectorAll('.rating span');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        const value = star.getAttribute('data-value');
        ratingInput.value = value;
        stars.forEach((s, i) => {
          s.classList.toggle('active', i < value);
        });
      });
    });
  </script>
</body>
</html>
