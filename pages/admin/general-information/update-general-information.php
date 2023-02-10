<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$GenID      = $_POST['GenID'];
$GenName   = $_POST['GenName'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE geninformation SET GenName = '$GenName' WHERE GenID = '$GenID'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=general-information");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
