<?php
include "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    
    $response = array();
    $idUser = $_POST['idUser'];
    $unikID = $_POST['unikID'];
    $namaPenerima = $_POST['namaPenerima'];
    $alamatPenerima = $_POST['alamatPenerima'];
    $nomorPenerima = $_POST['nomorPenerima'];
    $ongkosKirim = $_POST['ongkosKirim'];
    $invoice = date('Ymdhis');


//Cek apakah barang sudah ada di keranjang?
    $cekTmpCart = mysqli_query($con, "SELECT * FROM tmpcart WHERE unikID = '$unikID'");
    $cek = mysqli_fetch_array($cekTmpCart);

        if (isset ($cek)) {
//Jika ada didalam keranjang belanja berdasarkan unik_id device maka masuk ke invoice   

            $InsertInvoice = "INSERT INTO invoice VALUE('$invoice', '$namaPenerima', '$alamatPenerima', '$nomorPenerima', NOW(), '$idUser', '0' )";
            
/*Apabila barang sudah masuk tabel invoice maka program akan mengecek stok produk apabila stok produk habis atau tidak tersedia maka data yang di input pada variable $InsertInvoice akan di hapus selain itu maka data detail produk yang di beli akan masuk kedalam invoice detail dan mengurangi stok produk yang ada*/

                if (mysqli_query($con, $InsertInvoice)) {
                   
                    $TmpCart = mysqli_query($con, "SELECT * FROM tmpcart WHERE unikID = '$unikID'");
                  while ($a = mysqli_fetch_array($TmpCart)) {
                    
                     $idProduk = $a['idProduk'];
                     $quantity = $a['quantity'];
                     $berat = $a['berat'];
                     $harga = $a['harga'];
                     
                       $cekqtyProduk = mysqli_query($con, "SELECT * FROM products WHERE id = '$idProduk'");
                        $cekQty = mysqli_fetch_array($cekqtyProduk);
                        if (isset ($cekQty)) {
                            if((int)$cekQty["stok"] <= 0 || (int)$quantity > (int)$cekQty["stok"]){
                                $deleteInvoice = mysqli_query($con,"DELETE FROM invoice WHERE noInvoice ='$invoice'");
              
                            }else{ $insertDetail = mysqli_query($con, "INSERT INTO invoicedetail VALUE ('$invoice', '$idProduk', ($berat*$quantity) , '$quantity', ($ongkosKirim*$berat), ($harga*$quantity+$ongkosKirim*$berat),'0')");
                     $updateqtyProduk = mysqli_query($con, "UPDATE products SET stok = stok - '$quantity' WHERE  id = '$idProduk' ");  }
                        }else {
            
            $response['value'] = 3;
            $response['message'] = "Terjadi Kesalahan Pada Keranjang Belanja";
            echo json_encode($response);
        }
                       
                     
                  }
//mengosongkan keranjang belanja setelah checkout berhasil                     
                    $delete = mysqli_query($con,"DELETE FROM tmpcart WHERE unikID ='$unikID'");
                    $response['value'] = 1;
                    $response['message'] = "Berhasil Checkout Silahkan Lakukan Pembayaran";
                    echo json_encode($response);
                  
                } else {
                   
                    $response['value'] = 0;
                    $response['message'] = "Silahkan Coba Untuk Beberapa Saat Lagi";
                    echo json_encode($response);
                }
                
        } else {
            # code...
            $response['value'] = 0;
            $response['message'] = "Terjadi Kesalahan Saat Melakukan Checkout";
            echo json_encode($response);
        }
    
}
//End of file checkout.php
