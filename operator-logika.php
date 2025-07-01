<?php
$x = 15;
$y = 10;

$samadengan = $x == $y;
$lebih_kecil = $x < $y;
$lebih_besar = $x > $y;
$tidaksama = $x != $y;

$nilaiand = $samadengan && $tidaksama;
$nilaior = $samadengan || $tidaksama;
$nilainot1 = !$samadengan;
$nilainot2 = ! $tidaksama;

echo "Nilai And adalah $nilaiand <br>";
echo "Nilai Or adalah $nilaior <br>";
echo "Nilai Not 1 adalah $nilainot1 <br>";
echo "Nilai Not 2 adalah $nilainot2 <br>";
?>