<?php

include "../config/connect.php";
header("Access-Control-Allow-Origin: *");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $response = array();
    $unikID = $_POST['unikID'];
    $idProduk = $_POST['idProduk'];
    
// Mengecek ketersediaan barang pada tabel tmpcart dan products
    $cek = mysqli_query($con, "SELECT a.*, b.stok FROM tmpcart a LEFT JOIN products b on a.idProduk = b.id WHERE a.unikID = '$unikID' AND a.idProduk = '$idProduk'");
    $result = mysqli_fetch_array($cek);
    $quantity = $result["quantity"];
    $stok = $result["stok"];

    if (isset($result)) {
      
// Jika nilai quantity produk pada keranjang belanja = 1 maka data produk yang ada pada tabel tmpcart akan di hapus berdasarkan unikID device dan idProduk terpilih.

                if ($quantity == "1") {

                    $delete = "DELETE FROM tmpcart WHERE unikID = '$unikID' AND idProduk = '$idProduk' ";

                    if (mysqli_query($con, $delete)) {

                        $response['value'] = 1;
                        $response['message'] = "Data Dihapus dari database Keranjang Belanja";
                        echo json_encode($response);
                    } else {

                        $response['value'] = 2;
                        $response['message'] = "Maaf, terjadi kesalahan silahkan coba kembali";
                        echo json_encode($response);
                    }
                } else {
                
// Apabila barang lebih dari 1 maka dan api ini terpanggil maka jumlah produk pada keranjang belanja berkurang 1 tiap requestnya.

                    $updateCart = "UPDATE tmpcart SET quantity = quantity - 1 WHERE unikID = '$unikID' AND idProduk = '$idProduk' ";

                    if (mysqli_query($con, $updateCart)) {

                        $response['value'] = 1;
                        $response['message'] = "Pengurangan produk berhasil";
                        echo json_encode($response);
                    } else {

                        $response['value'] = 2;
                        $response['message'] = "Maaf, terjadi kesalahan silahkan coba kembali";
                        echo json_encode($response);
                    }
                }
            
      
    } else {

        $response['value'] = 2;
        $response['message'] = "Mohon coba beberapa saat lagi :)";
        echo json_encode($response);
    }
}
// End of file mengurangi_jumlah_barang_di_dalam_keranjang_belanja.php