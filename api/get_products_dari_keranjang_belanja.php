<?php

include "../config/connect.php";

$response = array();

// Mendapatkan id unik device
$unikID = $_GET['unikID'];

// Mengambil data produk dan keranjang belanja berdasarkan id produk dan unik id device.
$sql = mysqli_query($con, "SELECT b.*, a.quantity FROM tmpcart a LEFT JOIN products b on a.idProduk = b.id WHERE a.unikID = '$unikID' ");

while ($a = mysqli_fetch_array($sql)) {

// Jika stok produk kurang dari sama dengan 0 maka barang di hapus dari keranjang belanja
   if((int)$a["stok"] <= 0  ){
      
  $idP = $a["id"];
      $hapusBarangHabis = mysqli_query($con, "DELETE FROM tmpcart WHERE  idProduk = '$idP'");
      
   } else {

// Apabila quantity pembelian produk lebih dari stok barang maka quantity produk pada keranjang belanja akan berkurang.
      if((int)$a["quantity"] > (int)$a["stok"]){
          $idP = $a["id"];
          $stokSaatIni = (int)$a["stok"];
           $kurangiQuantityPembelian = mysqli_query($con, "UPDATE tmpcart SET quantity = quantity - $stokSaatIni WHERE  idProduk = '$idP'");
       $key["id"] = $a["id"];
       $key["nama_produk"] = $a["nama_produk"];
       $key["harga_produk"] = (int)$a["harga_produk"];
       $key["waktu_input_produk"] = $a["waktu_input_produk"];
       $key["cover_produk"] = $a["cover_produk"];
       $key["status"] = $a["status"];
       $key["quantity"] = $a["quantity"] ;

       array_push($response, $key);
      } else {
       $key["id"] = $a["id"];
       $key["nama_produk"] = $a["nama_produk"];
       $key["harga_produk"] = (int)$a["harga_produk"];
       $key["waktu_input_produk"] = $a["waktu_input_produk"];
       $key["cover_produk"] = $a["cover_produk"];
       $key["status"] = $a["status"];
       $key["quantity"] = $a["quantity"];

       array_push($response, $key);}
      }
}
echo json_encode($response);
// End of file get_products_dari_keranjang_belanja.php