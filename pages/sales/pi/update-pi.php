<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$NumDoc         = $_POST['NumDoc'];
$CatID          = $_POST['CatID'];
$NoPI           = $_POST['NoPI'];
$Customer       = $_POST['Customer'];
$DatePI         = $_POST['DatePI'];
$newDate          = date("Y-m-d H:i:s", strtotime($DatePI));
$LeadTimeMKT    = $_POST['LeadTimeMKT'];
$baruDate          = date("Y-m-d H:i:s", strtotime($LeadTimeMKT));

//query update data ke dalam database berdasarkan ID
$query = "UPDATE proforma_inv SET NumDoc = '$NumDoc', CatID = '$CatID', NoPI = '$NoPI', Customer = '$Customer', DatePI = '$newDate', LeadTimeMKT = '$baruDate' WHERE NumDoc = '$NumDoc'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=pi");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
