<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $idProduk = $_POST['idProduk'];
        $nama_produk = $_POST['nama_produk'];
        $berat = $_POST['berat'];
        $quantity = $_POST['quantity'];
        $harga = $_POST['harga_produk'];
        $descripsi_produk = $_POST['deskripsi_produk'];
        $idKategori = $_POST['idKategori'];
        

        $update = "UPDATE products SET idKategori = '$idKategori', nama_produk = '$nama_produk', berat = '$berat' , stok = '$quantity', harga_produk = '$harga', waktu_input_produk = NOW(), deskripsi_produk = '$descripsi_produk' WHERE id = '$idProduk' ";

        if (mysqli_query($con, $update)){      
            $response ['value'] = 1 ;
            $response ['message'] = "Edit Produk Berhasil" ;
            echo json_encode($response);


        } else {
            $response ['value'] = 2 ;
            $response ['message'] = "Edit Produk Gagal" ;
            echo json_encode($response);
        }
    }
// End of file edit_products.php