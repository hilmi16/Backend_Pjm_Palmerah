<?php
include "../config/connect.php";
header("Access-Control-Allow-Origin: *");

    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $nama_produk = $_POST['nama_produk'];
        $berat = $_POST['berat'];
        $quantity = $_POST['quantity'];
        $harga = $_POST['harga_produk'];
        $descripsi_produk = $_POST['deskripsi_produk'];
        $idKategori = $_POST['idKategori'];
        
        // Menyimpan file gambar
        $image = date("Ymdhis").str_replace(" ", "", basename($_FILES["image"]['name']));
        $path = __DIR__."/../products/".$image;
        move_uploaded_file($_FILES['image'] ['tmp_name'], $path);

        $insert = "INSERT into products VALUE (NULL, '$idKategori', '$nama_produk','$berat', '$quantity', '$harga', NOW(), '$image', '1', '$descripsi_produk')";

        if (mysqli_query($con, $insert)){
           
            $response ['value'] = 1 ;
            $response ['message'] = "Input Produk Ke Database Berhasil" ;
            echo json_encode($response);
        }
        else{
         
            $response ['value'] = 2 ;
            $response ['message'] = "Input Produk Ke Database Gagal" ;
            echo json_encode($response);
        }
    }
// End of file add_products.php