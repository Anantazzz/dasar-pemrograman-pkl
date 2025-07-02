<?php

//if/else
$nilai = 75;

if ($nilai >= 80) {
    echo "Bagus sekali";    
} elseif ($nilai >= 70) {
    echo "Baik";
} else {
    echo "Perlu belajar lagi";
}

echo "<br><br>";

//Switch
$hari = "Rabu";
echo "Hari ini: $hari =";
switch ($hari) {
    case "Selasa":
        echo "Semangat belajar";
        break;
        case "Kamis":
            echo "Lusa weekend!!!";
            break;
            default:
            echo "Bad day👎";
}

echo "<br><br>";

//Ternary
$umur = 12;
echo "Status umur: " . (($umur >= 20) ? "Dewasa" : "Remaja");
?>