<?php

include "../config/connect.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $token = $_POST['token'];

// Apakah email dan password terdaftar ? 
    $cek = mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
    $result = mysqli_fetch_array($cek);

    if(isset($result)){
    // Apabila email dan password tersedia maka program akan mengupdate kode ids user setiap user login.    
     $update = mysqli_query($con, "UPDATE users SET kode='$token'  WHERE email='$email'");

       $response ['id']            = $result['id']; 
       $response ['namaLengkap']   = $result['namaLengkap'];
       $response ['email']         = $result['email'];
       $response ['phone']         = $result['phone'];
       $response ['tanggalDibuat'] = $result['tanggalDibuat'];
       $response ['level']         = $result['level'];

        $response['value']   = 1;
        $response['message'] = 'Login Berhasil';
        echo json_encode($response);

    } else{
            $response['value'] = 0;
            $response['message'] = "Email/Password Salah Harap Periksa Kembali";
            echo json_encode($response);
        }
    }
?>
// End of file login.php