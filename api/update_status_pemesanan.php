<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $noInvoice = $_POST['noInvoice'];
        $status = $_POST['status'];
        $update = "UPDATE invoice SET status = '$status' WHERE noInvoice = '$noInvoice' ";

        if (mysqli_query($con, $update)){
            
            $response ['value'] = 1 ;
            $response ['message'] = "Perubahan Status Pemesanan Berhasil" ;
            echo json_encode($response);
        }
        else{
            
            $response ['value'] = 2 ;
            $response ['message'] = "Perubahan Status Pemesanan Gagal" ;
            echo json_encode($response);
        }
    }
// End of file update_status_pemesanan.php