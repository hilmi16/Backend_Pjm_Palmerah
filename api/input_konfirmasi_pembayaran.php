<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $noInvoice = $_POST['noInvoice'];
        $nama = $_POST['nama'];
        $noHP = $_POST['noHP'];
        $tanggal = $_POST['tanggal'];
      
// Menyimpan gambar konfirmasi pembayaran
        $image = date("Ymdhis").str_replace(" ", "", basename($_FILES["image"]['name']));
        $path = __DIR__."/../products/konfirmasiPembayaran/".$image;
        move_uploaded_file($_FILES['image'] ['tmp_name'], $path);

        $insert = "INSERT into konfirmasipembayaran VALUE (NULL, '$noInvoice', '$nama','$noHP', '$tanggal', NOW(), '$image')";

        if (mysqli_query($con, $insert)){
            $response ['value'] = 1 ;
            $response ['message'] = "Konfirmasi Pembayaran Berhasil" ;
            echo json_encode($response);

        } else{
            $response ['value'] = 2 ;
            $response ['message'] = "Konfirmasi Pembayaran Gagal" ;
            echo json_encode($response);
        }
    }
// End of file input_konfirmasi_pembayaran.php