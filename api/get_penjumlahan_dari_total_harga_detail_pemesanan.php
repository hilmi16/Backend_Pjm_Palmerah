<?php

include "../config/connect.php";

$response = array();
$noInvoice = $_GET['noInvoice'];

// Menjumlahkan total harga dari invoicedetail
$sql = mysqli_query($con, "SELECT sum(a.harga) total FROM invoicedetail a  WHERE a.noInvoice = '$noInvoice' ");

while ($a = mysqli_fetch_array($sql)) {
    
    $key["total"] = $a["total"];
   
    array_push($response, $key);
}
echo json_encode($response);
//End of file get_penjumlahan_dari_total_harga_detail_pemesanan.php