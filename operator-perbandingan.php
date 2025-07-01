<?php
$x = 25;
$y = 15;

$samadengan = $x == $y;
$tidaksama = $x != $y;
$lebih_kecil = $x < $y;
$lebih_besar = $x > $y;
$lebih_kecil_samadengan = $x <= $y;
$lebih_besar_samadengan = $x >= $y;

echo "Hasil perbandingan satu adalah $samadengan <br>";
echo "Hasil perbandingan dua adalah $tidaksama <br>";
echo "Hasil perbandingan tiga adalah $lebih_kecil <br>";
echo "Hasil perbandingan empat adalah $lebih_besar <br>";
echo "Hasil perbandingan lima adalah $lebih_kecil_samadengan <br>";
echo "Hasil perbandingan enam adalah $lebih_besar_samadengan";
?>