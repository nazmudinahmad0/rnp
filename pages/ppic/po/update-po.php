<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$NumDoc         = $_POST['NumDoc'];
$CatID          = $_POST['CatID'];
$NoPI           = $_POST['NoPI'];
$NoSO           = $_POST['NoSO'];
$NoPO           = $_POST['NoPO'];
$DatePO         = $_POST['DatePO'];
$newDate        = date("Y-m-d H:i:s", strtotime($DatePO));
$DatePOSAP      = $_POST['DatePOSAP'];
$baruDate       = date("Y-m-d H:i:s", strtotime($DatePOSAP));
$LeadTimePPIC   = $_POST['LeadTimePPIC'];
$tanggalltp     = date("Y-m-d H:i:s", strtotime($LeadTimePPIC));
$UserID         = $_POST['UserID'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE prod_order SET NumDoc = '$NumDoc', CatID = '$CatID', NoPI = '$NoPI', NoSO = '$NoSO', NoPO = '$NoPO', DatePO = '$newDate', DatePOSAP = '$baruDate', LeadTimePPIC = '$tanggalltp', UserID = '$UserID' WHERE NumDoc = '$NumDoc'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=ppic");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
