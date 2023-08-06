<?php
require("koneksi.php");

$response = array();
if ($_SERVER['REQUEST_METHOD']=='POST'){

    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];
    $status_pesanan = $_POST["status_pesanan"];

    $perintah = "UPDATE tb_pesanan SET nama ='$nama' , alamat = '$alamat', telepon = '$telepon', status_pesanan ='$status_pesanan'  WHERE id = '$id'";
    $eksekusi = mysqli_query($konek,$perintah);
    $cek=mysqli_affected_rows($konek);

    if ($cek>0) {
        $response["kode"] = 1;
        $response["pesan"] = "Data berhasil diubah";
       
    }else{
        $response["kode"] = 0;
        $response["pesan"] = "Data gagal diuban ";
        
    }
    
}else {
    $response["kode"] = 0;
    $response["pesan"] = "Tidak ada post data";
    
}
echo json_encode($response);
mysqli_close($konek);

?>