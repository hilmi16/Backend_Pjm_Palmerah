<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();

        $idProduk = $_POST['idProduk'];
        $cover_produk = $_POST['cover_produk'];
       

        $insert = "DELETE FROM products WHERE id = '$idProduk'";

        if (mysqli_query($con, $insert)){
            if (file_exists("../products/" . $cover_produk)) {
                unlink("../products/" . $cover_produk); 
              }
            $deleteFavorit = mysqli_query($con, "DELETE FROM favoritprodukwithoutlogin WHERE idProduk = '$idProduk'");
            $response ['value'] = 1 ;
            $response ['message'] = "Delete Produk Berhasil" ;
            echo json_encode($response);
        } else {
            $response ['value'] = 2 ;
            $response ['message'] = "Gagal Menghapus Produk " ;
            echo json_encode($response);
        }
    }
// End of file delete_products.php