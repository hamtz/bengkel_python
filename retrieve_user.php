<?php
require("koneksi.php");
$perintah = "SELECT * FROM tb_user";
$eksekusi = mysqli_query($konek,$perintah);
$cek = mysqli_affected_rows($konek);

if($cek > 0 ){
    $response ["kode"] = 1;
    $response["pesan"] = "Data tersedia";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["id"] = $ambil->id;
        $F["username"] = $ambil->username;
        $F["password"] = $ambil->password;
        $F["role"] = $ambil->role;

        array_push($response["data"],$F);
    }
}else{
    $response ["kode"] = 0;
    $response["pesan"] = "Data tidak tersedia";
    
}

echo json_encode($response);
mysqli_close($konek);


