<?php
require("koneksi.php");

$response = array();
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $nama=$_POST["nama"];
    $alamat=$_POST["alamat"];
    $telepon=$_POST["telepon"];
    $panjang=$_POST["panjang"];
    $lebar=$_POST["lebar"];
    $bahan=$_POST["bahan"];
    $ketebalan=$_POST["ketebalan"];
    $kode_desain=$_POST["kode_desain"];

    $perintah = "INSERT INTO tb_pesanan (nama,alamat,telepon,panjang,lebar,bahan,ketebalan,kode_desain) VALUES ('$nama','$alamat','$telepon','$panjang','$lebar','$bahan','$ketebalan','$kode_desain')";
    // $perintah = "INSERT INTO tb_pesanan (nama,alamat,telepon,panjang,lebar,bahan,ketebalan,kode_desain) VALUES('$nama',$alamat','$telepon','1','2','3','4','5')";
    $eksekusi = mysqli_query($konek,$perintah);
    $cek=mysqli_affected_rows($konek);

    if ($cek>0) {
        $response["kode"] = 1;
        $response["pesan"] = "Simpan data berhasil";
    }else{
        $response["kode"] = 0;
        $response["pesan"] = "Simpan data gagal";
        
    }
    
}else {
    $response["kode"] = 0;
    $response["pesan"] = "Tidak ada post data";
    
}
echo json_encode($response);
mysqli_close($konek);

?>