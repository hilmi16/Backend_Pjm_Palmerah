<?php

include "../config/connect.php";
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $response = array();
    $namaKategoriProduk = $_POST['namaKategoriProduk'];

    $insert = "INSERT into kategoriproduk VALUE (NULL, '$namaKategoriProduk', '1', NOW())";

    if (mysqli_query($con, $insert)){
        $response ['value'] = 1 ;
        $response ['message'] = "Menambahkan Kategori Produk Berhasil" ;
        echo json_encode($response);
    }else{
        $response ['value'] = 2 ;
        $response ['message'] = "Gagal Menambahkan Kategori Produk" ;
        echo json_encode($response);
    }
}
// End of file add_kategori_produk.php