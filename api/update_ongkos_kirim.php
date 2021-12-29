<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $idKota = $_POST['idKota'];
        $namaKota = $_POST['namaKota'];
        $ongkosKirim= $_POST['ongkosKirim'];
        $update = "UPDATE biayapengiriman SET nama_kota = '$namaKota', ongkos_kirim = '$ongkosKirim' WHERE id_kota = '$idKota' ";

        if (mysqli_query($con, $update)){
            
            $response ['value'] = 1 ;
            $response ['message'] = "Perubahan Nama Kota & Ongkos Kirim Berhasil" ;
            echo json_encode($response);
        }
        else{
            
            $response ['value'] = 2 ;
            $response ['message'] = "Perubahan Nama Kota & Ongkos Kirim Gagal" ;
            echo json_encode($response);
        }
    }
// End of file update_ongkos_kirim.php