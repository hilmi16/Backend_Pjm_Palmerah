<?php

include "../config/connect.php";
header("Access-Control-Allow-Origin: *");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $response = array();
    $unikID = $_POST['unikID'];
    $idProduk = $_POST['idProduk'];

    $cek = mysqli_query($con, "SELECT a.*, b.stok FROM tmpcart a LEFT JOIN products b on a.idProduk = b.id WHERE a.unikID = '$unikID' AND a.idProduk = '$idProduk'");
    $result = mysqli_fetch_array($cek);
    $quantity = $result["quantity"];
    $stok = $result["stok"];

    if (isset($result)) {

// Kondisi di bawah ini digunakan untuk memastikan jumlah barang yang ditambahkan pada keranjang belanja tidak melebihi stok barang yang tersedia
        if ($quantity !=  $stok) {
                $insert = "UPDATE tmpcart SET quantity = quantity + 1 WHERE unikID = '$unikID' AND idProduk = '$idProduk'  ";
                
                if (mysqli_query($con, $insert)) {
                    $response['value'] = 1;
                    $response['message'] = "Data Ditambahkan ke database Keranjang Belanja";
                    echo json_encode($response);
                } else {
                    $response['value'] = 2;
                    $response['message'] = "Terjadi Kesalahan";
                    echo json_encode($response);
                }
        } else {
            $response['value'] = 2;
            $response['message'] = "Stok Tersedia Hanya : $stok barang";
            echo json_encode($response);
        }
    } else {

        $response['value'] = 2;
        $response['message'] = "Terjadi Kesalahanl";
        echo json_encode($response);
    }
}
// End of file menambah_jumlah_barang_di_dalam_keranjang_belanja.php