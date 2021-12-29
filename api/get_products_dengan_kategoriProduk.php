<?php

include "../config/connect.php";

$response = array();

$sql = mysqli_query($con, "SELECT * FROM kategoriproduk order by id asc" );

while ($a = mysqli_fetch_array($sql)) {
    $idKategori = $a['id'];
    $key['id'] = $idKategori;
    $key['namaKategori'] = $a['namaKategori'];
    $key['waktuDibuat'] = $a['waktuDibuat'];
    $key['status'] = $a['status'];
    
     $key['products'] = array();
     
     $query = mysqli_query($con, "SELECT * FROM products WHERE idKategori='$idKategori'");
    
while ($b = mysqli_fetch_array($query)) {
         $key["products"][]= array(
             'id' =>$b['id'],
             'idKategori' =>$b['idKategori'],
             'nama_produk' =>$b['nama_produk'],
             'stok' =>$b['stok'],
             'harga_produk' =>(int)$b['harga_produk'],
             'waktu_input_produk' =>$b['waktu_input_produk'],
             'cover_produk' =>$b['cover_produk'],
             'status' =>$b['status'],
             'deskripsi_produk' =>$b['deskripsi_produk'],
         );
     }
    array_push($response, $key);
}
echo json_encode($response);
// End of file get_products_dengan_kategoriProduk.php