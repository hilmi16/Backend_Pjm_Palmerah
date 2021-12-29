<?php
include "../config/connect.php";

$noInvoice = $_GET['noInvoice'];
$level = $_GET['level'];

//Mengambil kode registrasi ids user berdasarkan level user.
$result = mysqli_query($con, "SELECT * FROM users WHERE level = '$level' ");  
$tokens = array(); 
while ($a = mysqli_fetch_array($result)) {

  $key = $a["kode"];
  array_push($tokens, $key);
}
// Memgencode token
$js0n= json_encode($tokens);

// Menginisialisi curl
$curl = curl_init();

// Membuat option curl
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\r\n \"registration_ids\": $js0n,\r\n    \"notification\": {\r\n   \"title\": \"noInvoice : $noInvoice\",\r\n   \"body\": \"Telah melakukan konfirmasi pembayaran silahkan check pada menu daftar konfirmasi pembayaran\"\r\n }\r\n \r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: key=AAAA0Mw52CI:APA91bHx4mfAYM9Ho8-_-cEmtfLxmszYlK-b96T9SeC_Pdk_mylRqmPeklpl2n3eJkqigoEll2q5fyA2Svz8ejP73aq0CFDBh1r-T_jwOtPp5qj_duzkjtePFPO6JchG0o5p_V3eFrRm",
    "cache-control: no-cache"
  ),
));

// Mengeksekusi fcm
$response = curl_exec($curl);

// menutup curl
curl_close($curl);

echo $response;
//End of file SendNotificationKonfirmasiPembayaran.php