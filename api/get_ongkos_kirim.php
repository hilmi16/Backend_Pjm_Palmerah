<?php

include "../config/connect.php";

$response = array();
$sql = mysqli_query($con, "SELECT * FROM biayapengiriman order by id_kota desc");

while ($a = mysqli_fetch_array($sql)) {
    
    $key["id_kota"] = $a["id_kota"];
    $key["nama_kota"] = $a["nama_kota"];
    $key["ongkos_kirim"] = $a["ongkos_kirim"];
   
    array_push($response, $key);
}
echo json_encode($response);
// End of file get_ongkos_kirim.php