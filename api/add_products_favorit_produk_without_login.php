<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $deviceInfo = $_POST['deviceInfo'];
        $idProduk = $_POST['idProduk'];

        $cek = mysqli_query($con, "SELECT * FROM favoritprodukwithoutlogin WHERE deviceID = '$deviceInfo' AND idProduk = '$idProduk'");
        $result = mysqli_fetch_array($cek);

        //kalo udah melihat produk yang sama kondisi dibawah ngapain???
        if (isset($result)) {
        
// Menghapus produk serupa pada tabel favoriteprodukwithoutlogin
 $insert = "DELETE FROM favoritprodukwithoutlogin WHERE deviceID = '$deviceInfo' AND idProduk = '$idProduk'";

            if (mysqli_query($con, $insert)){
                
                $response ['value'] = 1 ;
                $response ['message'] = "Produk Dihapus dari Favorit" ;
                echo json_encode($response);
            }
            else {
                
                $response ['value'] = 2 ;
                $response ['message'] = "Gagal Menghapus Produk Favorit" ;
                echo json_encode($response);
            }

        } else {
        
// Apabila produk belum tersedia pada tabel favoriteprodukwithoutlogin maka akan di tambahkan.
            $insert = "INSERT into favoritprodukwithoutlogin VALUE (NULL, '$deviceInfo', '$idProduk', NOW())";

            if (mysqli_query($con, $insert)){
                
                $response ['value'] = 1 ;
                $response ['message'] = "Produk Ditambahkan ke Favorit" ;
                echo json_encode($response)
            }
            else {
               
                $response ['value'] = 2 ;
                $response ['message'] = "Penambahan Produk Favorit Gagal" ;
                echo json_encode($response);
            }
        }
        


       
    }