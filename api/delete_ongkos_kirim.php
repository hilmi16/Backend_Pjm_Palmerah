<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $idKota = $_POST['idKota'];
        $delete = "DELETE FROM biayapengiriman WHERE id_kota = '$idKota'";

        if (mysqli_query($con, $delete)){
            $response ['value'] = 1 ;
            $response ['message'] = "Delete Ongkos Kirim Berhasil" ;
            echo json_encode($response);
        }
        else{
            $response ['value'] = 2 ;
            $response ['message'] = "Delete Ongkos Kirim Gagal" ;
            echo json_encode($response);
        }
    }
// End of file delete_ongkos_kirim.php