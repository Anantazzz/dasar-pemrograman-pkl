<?php
require 'data-bbm.php';

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

do{
echo "=== DAFTAR HARGA BBM ===\n";
foreach ($hargaBBM as $key => $data) {
    echo "$key. {$data['nama']} -  " . formatRupiah($data['harga']) . "\n";
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
    if (!is_numeric($beli) || $beli < 0) {
        echo "Input tidak valid. Pastikan anda masukan angka positif.\n";
    }
} while (!is_numeric($beli) || $beli < 0); 

$diskon = 0;
$diskonPersen = 0;

$rawDiskon = readline("Masukkan diskon (atau tekan Enter jika tidak ada): ");

if (trim($rawDiskon) !== '') {
    if (!str_ends_with($rawDiskon, '%')) {
        echo "Diskon harus diakhiri dengan tanda %.\n";
        exit;
    }

    $inputDiskon = str_replace('%', '', $rawDiskon);

    if (!is_numeric($inputDiskon) || $inputDiskon < 0 || $inputDiskon > 100) {
        echo "Diskon harus berupa angka antara 0–100%.\n";
        exit;
    }

    $diskonPersen = (float)$inputDiskon;
    $diskon = ($diskonPersen / 100) * $harga;
}
$hargaDiskonPerLiter = $harga - $diskon;
$hargaSetelahDiskon = $hargaDiskonPerLiter;
$totalBeli = $beli;

$ppn = 0.11 * $totalBeli;
$totalBayar = $totalBeli + $ppn;

do{
    $jumlahUang = readline("Masukan jumlah uang yang dibayar:");
    if (!is_numeric($jumlahUang) || $jumlahUang < 0) {
        echo "Input tidak valid. Pastikan anda masukan angka positif.\n";
    }
} while (!is_numeric($jumlahUang) || $jumlahUang < 0);

if ($jumlahUang < $totalBayar){
    echo "Jumlah uang tidak cukup untuk pembayaran total.\n";
    exit;
}

$kembalian = 0;
$liter = 0;

$kembalian = $jumlahUang - $totalBayar;
$liter = $beli / $hargaDiskonPerLiter;

echo "=== Struk Pembelian BBM ===\n";
echo "Jenis BBM        : $jenis\n";
echo "Harga perliter   : " . formatRupiah($harga) . "\n";
if ($diskonPersen > 0) {
echo "Diskon           : {$diskonPersen}%\n";
echo "Harga Diskon     : " . formatRupiah($hargaDiskonPerLiter) . "\n";
}
echo "Nominal beli     : " . formatRupiah($beli) . "\n";
echo "PPN (11%)        : " . formatRupiah($ppn) . "\n";
echo "Total dibayar    : " . formatRupiah($totalBayar) . "\n";
echo "Liter didapat    : " . number_format($liter, 1, ',', '.') . " liter\n";
echo "Uang dibayar     : " . formatRupiah($jumlahUang) . "\n";
echo "Kembalian        : " . formatRupiah($kembalian) . "\n";

$lanjut = readline("\nIngin transaksi lagi? (y/n): ");
} while (strtolower($lanjut) == 'y');
?>
