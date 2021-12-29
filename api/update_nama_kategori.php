<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $idKategoriProduk = $_POST['idKategoriProduk'];
        $namaKategoriProduk = $_POST['namaKategoriProduk'];
        $update = "UPDATE kategoriproduk SET namaKategori = '$namaKategoriProduk' WHERE id = '$idKategoriProduk' ";

        if (mysqli_query($con, $update)){
            
            $response ['value'] = 1 ;
            $response ['message'] = "Perubahan Nama Kategori Produk Berhasil" ;
            echo json_encode($response);
        }
        else{
            
            $response ['value'] = 2 ;
            $response ['message'] = "Perubahan Nama Kategori Produk Gagal" ;
            echo json_encode($response);
        }
    }
// End of file update_nama_kategori.php