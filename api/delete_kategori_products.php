<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $idKategoriProduk = $_POST['idKategoriProduk'];
        $delete = "DELETE FROM kategoriproduk WHERE id = '$idKategoriProduk'";

        if (mysqli_query($con, $delete)){
            $response ['value'] = 1 ;
            $response ['message'] = "Delete Kategori Produk Berhasil" ;
            echo json_encode($response);
        }
        else{
            $response ['value'] = 2 ;
            $response ['message'] = "Delete Kategori Produk Gagal Karena Masih Terdapat Produk Pada Kategori Ini" ;
            echo json_encode($response);
        }
    }
// End of file delete_kategori_products.php