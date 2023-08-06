<?php
require("koneksi.php");
$perintah = "SELECT * FROM tb_pesanan";
$eksekusi = mysqli_query($konek,$perintah);
$cek = mysqli_affected_rows($konek);

if($cek > 0 ){
    $response ["kode"] = 1;
    $response["pesan"] = "Data tersedia";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["id"] = $ambil->id;
        $F["nama"] = $ambil->nama;
        $F["alamat"] = $ambil->alamat;
        $F["telepon"] = $ambil->telepon;
        $F["panjang"] = $ambil->panjang;
        $F["lebar"] = $ambil->lebar;
        $F["bahan"] = $ambil->bahan;
        $F["ketebalan"] = $ambil->ketebalan;
        $F["kode_desain"] = $ambil->kode_desain;

        array_push($response["data"],$F);
    }
}else{
    $response ["kode"] = 0;
    $response["pesan"] = "Data tidak tersedia";
    
}

echo json_encode($response);
mysqli_close($konek);