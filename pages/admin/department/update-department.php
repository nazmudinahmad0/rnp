<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$DeptID     = $_POST['DeptID'];
$DeptName   = $_POST['DeptName'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE department SET DeptName = '$DeptName' WHERE DeptID = '$DeptID'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=department");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
