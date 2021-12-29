<?php
include "../config/connect.php";
if ($_SERVER["REQUEST_METHOD"]=="POST") {
   
    $response = array();
    $email = $_POST['email'];
    $token = $_POST['token'];

    $cekEmail = mysqli_query($con, "SELECT * from users WHERE email = '$email' ");
    $cek = mysqli_fetch_array($cekEmail);
    if (isset($cek)) {
  
       $update = mysqli_query($con, "UPDATE users SET kode='$token'  WHERE email='$email' ");

       $response ['id'] = $cek['id']; 
       $response ['namaLengkap'] = $cek['namaLengkap'];
       $response ['email'] = $cek['email'];
       $response ['phone'] = $cek['phone'];
       $response ['tanggalDibuat'] = $cek['tanggalDibuat'];
       $response ['level'] = $cek['level'];

       $response ['value'] = 1;
       $response ['message'] = "Berhasil Login";
       echo json_encode($response);
       
    } else {
        $response ['value'] = 0;
        $response ['message'] = "Email Belum Terdaftar Silahkan Isi Form Registrasi";
        echo json_encode($response);
    }
    
}
?>
// End of file cekEmail.php