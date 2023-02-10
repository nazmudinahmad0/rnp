<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$CatID     = $_POST['CatID'];
$CatName   = $_POST['CatName'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE category SET CatName = '$CatName' WHERE CatID = '$CatID'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=category");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
