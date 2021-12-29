<?php

include "../config/connect.php";

$response = array();
$unikID = $_GET['unikID'];

// Menjumlahkan perkalian antara jumlah pembelian dengan harga satuan
$sql = mysqli_query($con, "SELECT sum(a.quantity * a.harga) total FROM tmpcart a  WHERE a.unikID = '$unikID' ");

while ($a = mysqli_fetch_array($sql)) {

    $key["total"] = $a["total"];
   
    array_push($response, $key);
}
echo json_encode($response);
// End of file get_penjumlahan_dari_quantity_barang.php