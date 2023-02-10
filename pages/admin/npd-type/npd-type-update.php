<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$NPDTypeID     = $_POST['NPDTypeID'];
$NPDTypeName   = $_POST['NPDTypeName'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE npdtype SET NPDTypeName = '$NPDTypeName' WHERE NPDTypeID = '$NPDTypeID'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=npdtype");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
