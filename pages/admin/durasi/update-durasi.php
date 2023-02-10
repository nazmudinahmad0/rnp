<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$id_durasi     = $_POST['id_durasi'];
$PI_SO   = $_POST['PI_SO'];
$SO_PO   = $_POST['SO_PO'];
$LTSales_Finish   = $_POST['LTSales_Finish'];


//query update data ke dalam database berdasarkan ID
$query = "UPDATE dedurasi SET PI_SO = '$PI_SO',SO_PO = '$SO_PO',LTSales_Finish = '$LTSales_Finish' WHERE id_durasi = '$id_durasi'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //header("location: ../../../index.php?page=department");
    //redirect ke halaman index.php 
    //header("location: master-durasi.php");
    header("location: ../../../index.php?page=durasi");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
