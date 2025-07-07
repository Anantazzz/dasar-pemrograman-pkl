<?php
echo "=== DAFTAR HARGA BBM ===\n";
echo "1. Pertamax - Rp 12.500\n";
echo "2. Pertalite - Rp 10.000\n";
echo "3. Dexlite - Rp 13.000\n";
echo "4. Solar - Rp 6.000\n";

$kembalian = 0;
$liter = 0;

$hargaBBM = [
    "Pertamax" => 12500,
    "Pertalite" => 10000,
    "Dexlite" => 13000,
    "Solar" => 6000
];

$jenis = readline("Masukan jenis BBM (misal: Pertamax):");
if (!array_key_exists($jenis, $hargaBBM)) {
    echo "Jenis BBM tidak valid. Silakan pilih dari daftar yang tersedia.\n";
    exit;
}

//Validasi input
do{
    $beli = readline("Masukan nominal pembelian BBM:");
    if (!is_numeric($beli)) {
        echo "Input tidak valid. Pastikan anda masukan angka.\n";
    }
} while (!is_numeric($beli)); 

do{
    $jumlahUang = readline("Masukan jumlah uang yang dibayar:");
    if (!is_numeric($jumlahUang)) {
        echo "Input tidak valid. Pastikan anda masukan angka.\n";
    }
} while (!is_numeric($jumlahUang));

if ($jumlahUang < $beli){
    echo "Jumlah uang tidak cukup untuk pembelian BBM.\n";
    exit;
}

$kembalian = $jumlahUang - $beli;
$liter = $beli / $hargaBBM[$jenis];

echo "=== Struk Pembelian BBM ===\n";
echo "Jenis BBM : $jenis\n";
echo "Harga perliter : Rp " . number_format($hargaBBM[$jenis], 0, ',', '.') . "\n";
echo "Nominal beli : Rp " . number_format($beli, 0, ',', '.') . "\n";
echo "Liter dapat : " . number_format($liter, 1, ',', '.') . " liter\n";
echo "Uang dibayar : Rp " . number_format($jumlahUang, 0, ',', '.') . "\n";
echo "Kembalian : Rp " . number_format($kembalian, 0, ',', '.') . "\n";
?>
