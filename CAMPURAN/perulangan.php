<?php

//For 
 echo "<h2>Perulangan FOR</h2>";
 for ($i = 1; $i <= 5; $i++) {
    echo "Angka ke-$i <br>";
 }
 
 //While
    echo "<h2>Perulangan While</h2>";
    $x = 1;
    while ($x <= 7) {
        echo "x sekarang: $x <br>";
        $x++;
    }

    //Foreach
    echo "<h3>Perulangan Foreach</h3>";
    $buah = ["Pisang", "Markisa", "Apel"];

    foreach ($buah as $item) {
        echo  "Buah: $item <br>";
    }
?>