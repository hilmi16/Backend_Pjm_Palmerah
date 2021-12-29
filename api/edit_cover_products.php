<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $idProduk = $_POST['idProduk'];

        $image = date("Ymdhis").str_replace(" ", "", basename($_FILES["image"]['name']));
        $path = __DIR__."/../products/".$image;
        move_uploaded_file($_FILES['image'] ['tmp_name'], $path);

        $insert = "UPDATE products SET  cover_produk = '$image' WHERE id = '$idProduk' ";

        if (mysqli_query($con, $insert)){
           
            $response ['value'] = 1 ;
            $response ['message'] = "Berhasil Mengganti Cover Produk" ;
            echo json_encode($response);
        }
        else{
            
            $response ['value'] = 2 ;
            $response ['message'] = "Gagal Mengganti Cover Produk" ;
            echo json_encode($response);
        }
    }
// End of file edit_cover_products.php