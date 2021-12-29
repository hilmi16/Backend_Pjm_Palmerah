<?php

include "../config/connect.php";

$response = array();
$sql = mysqli_query($con, "SELECT * FROM users WHERE level = '1' order by id desc");

while ($a = mysqli_fetch_array($sql)) {

    $key["id"] = $a["id"];
    $key["email"] = $a["email"];
    $key["password"] = $a["password"];
    $key["phone"] = $a["phone"];
    $key["namaLengkap"] = $a["namaLengkap"];
    $key["tanggalDibuat"] = $a["tanggalDibuat"];
    $key["status"] = $a["status"];
    $key["level"] = $a["level"];
    $key["kode"] = $a["kode"];

    array_push($response, $key);
}
echo json_encode($response);
// End of file get_users.php