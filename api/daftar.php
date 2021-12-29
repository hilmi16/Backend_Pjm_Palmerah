<?php

include "../config/connect.php";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    # code...
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $namaLengkap = $_POST['namaLengkap'];
    $phone = $_POST['phone'];
    $token = $_POST['token'];
    $NoHp = mysqli_query($con, "SELECT * from users WHERE phone = '$phone'");
    
    $cekNomorHp = mysqli_fetch_array($NoHp);
    
// Apabila nomor hp telah tergistrasi di aplikasi maka akan mengembalikan pesan "Nomor Ponsel Anda Sudah Terdaftar".
      if (isset($cekNomorHp)) {
       $response ['value'] = 0;
       $response ['message'] = "Nomor Ponsel Anda Sudah Terdaftar";
       echo json_encode($response);
    } else {
       $insert = "INSERT INTO users VALUE(NULL, '$email', '$password', '$phone', '$namaLengkap', NOW(), '1', '1', '$token')";
       if (mysqli_query($con, $insert)) {
           $response ['value'] = 1;
           $response ['message'] = "Akun anda berhasi terdaftar silahkan signin kembali";
           echo json_encode($response);
       } else {
           $response ['value'] = 0;
           $response ['message'] = "Failed";
           echo json_encode($response);
       }
       
    }
    
}
?>
// End of file daftar.php