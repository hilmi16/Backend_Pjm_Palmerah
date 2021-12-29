<?php

include "../config/connect.php";

$response = array();
$unikID = $_GET['unikID'];

// Menjumlahkan total jumlah barang di keranjang belanja
$sql = mysqli_query($con, "SELECT COUNT(*) total FROM `tmpcart` WHERE unikID = '$unikID' ");

while ($a = mysqli_fetch_array($sql)) {

    $key['total'] = $a['total'] ;
    
    array_push($response, $key);
}
echo json_encode($response);
// End of file get_products_total_barang_yang_ada_dikeranjang.php