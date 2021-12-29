<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $noInvoice = $_POST['noInvoice'];
        $buktiTransfer = $_POST['buktiTransfer'];
        $insert = "DELETE FROM konfirmasipembayaran WHERE noInvoice = '$noInvoice'";

        if (mysqli_query($con, $insert)){

            // Menghapus file gambar bukti transfer
            if (file_exists("../products/konfirmasiPembayaran/" . $buktiTransfer)) {
                unlink("../products/konfirmasiPembayaran/" . $buktiTransfer);
              }
        
            $response ['value'] = 1 ;
            $response ['message'] = "Delete Data Konfirmasi Berhasil" ;
            echo json_encode($response);

        } else {
            $response ['value'] = 2 ;
            $response ['message'] = "Delete Data Konfirmasi Gagal" ;
            echo json_encode($response);
        }
    }