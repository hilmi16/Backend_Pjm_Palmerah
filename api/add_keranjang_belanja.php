<?php

    include "../config/connect.php";
    header("Access-Control-Allow-Origin: *");
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $response = array();
        $unikID = $_POST['unikID'];
        $idProduk = $_POST['idProduk'];

        $cek = mysqli_query($con, "SELECT * FROM tmpcart WHERE unikID = '$unikID' AND idProduk = '$idProduk'");
        $result = mysqli_fetch_array($cek);

        //kalo udah melihat produk yang sama kondisi dibawah akan mengembalikan response sebuah pesan.
        if (isset($result)) {
            $response ['value'] = 2 ;
                $response ['message'] = "Produk ini telah anda tambahkan di Keranjang Belanja" ;
                echo json_encode($response);

// Apabila tidak ada produk yang sama di dalam keranjang belanja maka program akan menginput data produk kedalam tabel tmpcart.
        } else {
            $cekProduk = mysqli_query($con, "SELECT * FROM products WHERE id = '$idProduk' ");

            $ab = mysqli_fetch_array($cekProduk);

            $harga = $ab['harga_produk'];
            $berat = $ab['berat'];
            $insert = "INSERT into tmpcart VALUE (NULL, '$unikID', '$idProduk', '$berat','1','$harga', NOW())";

            if (mysqli_query($con, $insert)){
                $response ['value'] = 1 ;
                $response ['message'] = "Produk Ditambahkan ke Keranjang Belanja" ;
                echo json_encode($response);
            }
            else{
                $response ['value'] = 2 ;
                $response ['message'] = "Gagal Menambahkan Produk Ke Keranjang Belanja " ;
                echo json_encode($response);
            }
        }
    }
//End of file add_keranjang_belanja.php