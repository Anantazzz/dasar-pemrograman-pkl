<?php

//Function argument
function sapaNama($nama) {
    echo "Halo, $nama!<br>";
}
sapaNama("Ananta");
sapaNama("Budi");

//Function return value
function luasPersegi($sisi) {
  return $sisi * $sisi;
}

$hasil = luasPersegi(5);
echo "Luas persegi: $hasil"; 

?>