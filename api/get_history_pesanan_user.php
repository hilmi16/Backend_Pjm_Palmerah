<?php
include "../config/connect.php";

$idUser = $_GET['idUsers'];
$response = array();

// Mengambil data Invoice berdasarkan iduser
$sql = mysqli_query($con, "SELECT DISTINCT * FROM invoice WHERE idUsers = '$idUser' ORDER BY tanggalTransaksi DESC");
        
        while ($a = mysqli_fetch_array($sql)) {
                $noInvoice = $a['noInvoice'];
                $key["noInvoice"] = $noInvoice;
                $key["namaPenerima"] = $a["namaPenerima"];
                $key["alamatPenerima"] = $a["alamatPenerima"];
                $key["nomorPenerima"] = $a["nomorPenerima"];
                $key["tanggalTransaksi"] = $a["tanggalTransaksi"];
                $key["idUsers"] = $a["idUsers"];
                $key["status"] = $a["status"];  
                $key['detail'] = array();

// Mengambil data invoice detail berdasarkan No invoice
                $cek = mysqli_query($con, "SELECT a.*, b.nama_produk, b.cover_produk FROM invoicedetail a LEFT JOIN products b on a.idProduk = b.id WHERE a.noInvoice = '$noInvoice' ");

                while ($b = mysqli_fetch_array($cek)) {
                    $key['detail'][] = array(
                        "idProduk" => $b['idProduk'],
                        "quantity" => $b['quantity'],
                        "harga" => $b['harga'],
                        "diskon" => $b['diskon'],
                        "nama_produk" => $b['nama_produk'],
                        "cover_produk" => $b['cover_produk'],
                    );
                }
            
                array_push($response, $key);
            }
            echo json_encode($response);
// End of file get_history_pesanan_user.php