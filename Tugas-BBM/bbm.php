<?php
require 'data_bbm.php';

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

do{
echo "=== DAFTAR HARGA BBM ===\n";
foreach ($hargaBBM as $key => $data) {
    $hargaFormatted = formatRupiah($data['harga']);
    echo "$key. {$data['nama']} - $hargaFormatted\n";
}
do{
    $pilihan = readline("Masukan nomor pilihan BBM (1-4): ");
    if (!is_numeric($pilihan) || !array_key_exists($pilihan, $hargaBBM)) {
        echo "Input tidak valid. Pilih antara 1 sampai 4.\n";
    }
} while (!array_key_exists($pilihan, $hargaBBM));

$jenis = $hargaBBM[$pilihan]['nama'];
$harga = $hargaBBM[$pilihan]['harga'];

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

$kembalian = 0;
$liter = 0;

$kembalian = $jumlahUang - $beli;
$liter = $beli / $harga;

echo "=== Struk Pembelian BBM ===\n";
echo "Jenis BBM        : $jenis\n";
echo "Harga perliter   : " . formatRupiah($harga) . "\n";
echo "Nominal beli     : " . formatRupiah($beli) . "\n";
echo "Liter dapat      : " . number_format($liter, 1, ',', '.') . " liter\n";
echo "Uang dibayar     : " . formatRupiah($jumlahUang) . "\n";
echo "Kembalian        : " . formatRupiah($kembalian) . "\n";

$lanjut = readline("\nIngin transaksi lagi? (y/n): ");
} while (strtolower($lanjut) == 'y');
?>
