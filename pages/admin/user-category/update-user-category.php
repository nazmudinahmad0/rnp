<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$UserID     = $_POST['said'];
$CategoryID   = $_POST['CATID'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE usercategory SET CategoryID = '$CategoryID' WHERE UserID = '$UserID'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=user-category");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
