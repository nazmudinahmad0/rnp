<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$AppID      = $_POST['AppID'];
$AppName   = $_POST['AppName'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE application SET AppName = '$AppName' WHERE AppID = '$AppID'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=applications");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
