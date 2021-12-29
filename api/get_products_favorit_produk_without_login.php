<?php

include "../config/connect.php";

$response = array();

$deviceInfo = $_GET['deviceInfo'];

// Mengambil data produk favorit
$sql = mysqli_query($con, "SELECT b.* FROM favoritprodukwithoutlogin a left join products b on a.idProduk = b.id WHERE a.deviceID = '$deviceInfo' ");

while ($a = mysqli_fetch_array($sql)) {

    $key["id"] = $a["id"];
    $key["nama_produk"] = $a["nama_produk"];
    $key["stok"] = $a["stok"];
    $key["harga_produk"] = (int)$a["harga_produk"];
    $key["waktu_input_produk"] = $a["waktu_input_produk"];
    $key["cover_produk"] = $a["cover_produk"];
    $key["status"] = $a["status"];
    $key["deskripsi_produk"] = $a["deskripsi_produk"];

    array_push($response, $key);
}
echo json_encode($response);
// End of file get_products_favorit_produk_without_login.php