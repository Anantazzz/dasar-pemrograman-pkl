<?php
if (isset($_POST['nama']) && isset($_POST['umur'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    echo "Halo! $nama, umur kamu $umur tahun.";
}else {
    echo "Form belum lengkap!!!";
}
?>