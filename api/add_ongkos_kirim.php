<?php

include "../config/connect.php";
header("Access-Control-Allow-Origin: *");
if ($_SERVER['REQUEST_METHOD']== 'POST') {
    # code...
    $response = array();
    $namaKota = $_POST['namaKota'];
    $ongkosKirim = $_POST['ongkosKirim'];
    $insert = "INSERT into biayapengiriman VALUE (NULL, '$namaKota', '$ongkosKirim')";

    if (mysqli_query($con, $insert)){
        $response ['value'] = 1 ;
        $response ['message'] = "Input Ongkos Kirim Ke Database Berhasil" ;
        echo json_encode($response);

    } else{
        $response ['value'] = 2 ;
        $response ['message'] = "Input Ongkos Kirim Ke Database Gagal" ;
        echo json_encode($response);
    }
}
// End of file add_ongkos_kirim.php