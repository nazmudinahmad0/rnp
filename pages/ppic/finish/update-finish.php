<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$NumDoc         = $_POST['NumDoc'];
$CatID          = $_POST['CatID'];
$NoPI           = $_POST['NoPI'];
$DateFinish     = $_POST['DateFinish'];
$newDate        = date("Y-m-d H:i:s", strtotime($DateFinish));
$status_ok      = $_POST['status_ok'];
$UserID         = $_POST['UserID'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE finish SET NumDoc = '$NumDoc', CatID = '$CatID', NoPI = '$NoPI', DateFinish = '$newDate', status_ok = '$status_ok', UserID = '$UserID' WHERE NumDoc = '$NumDoc'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=finish");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
