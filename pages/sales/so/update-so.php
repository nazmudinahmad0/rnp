<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$NumDoc         = $_POST['NumDoc'];
$CatID          = $_POST['CatID'];
$NoPI           = $_POST['NoPI'];
$NoSO           = $_POST['NoSO'];
$status_so      = $_POST['status_so'];
$DateSO         = $_POST['DateSO'];
$newDate        = date("Y-m-d H:i:s", strtotime($DateSO));
$DateSOSAP      = $_POST['DateSOSAP'];
$Datesap        = date("Y-m-d H:i:s", strtotime($DateSOSAP));
$UserID         = $_POST['UserID'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE sales_order SET NumDoc = '$NumDoc', CatID = '$CatID', NoPI = '$NoPI', NoSO = '$NoSO',status_so = '$status_so', DateSO = '$newDate', DateSOSAP = '$Datesap', UserID = '$UserID' WHERE NoPI = '$NoPI'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=so");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
