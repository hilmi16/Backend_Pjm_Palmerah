<?php

include "../config/connect.php";

$response = array();
$sql = mysqli_query($con, "SELECT * FROM konfirmasipembayaran order by id desc");

while ($a = mysqli_fetch_array($sql)) {

    $key["noInvoice"] = $a["noInvoice"];
    $key["nama"] = $a["nama"];
    $key["phone"] = $a["phone"];
    $key["tanggalPembelian"] = $a["tanggalPembelian"];
    $key["tanggalKonfirmasi"] = $a["tanggalKonfirmasi"];
    $key["buktiTransfer"] = $a["buktiTransfer"];

    array_push($response, $key);
}
echo json_encode($response);
// End of file get_konfirmasi_pembayaran.php