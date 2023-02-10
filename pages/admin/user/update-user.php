<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$kode_sales     = $_POST['kode_sales'];
$username   = $_POST['username'];
$password   = md5($_POST['password']);

//query update data ke dalam database berdasarkan ID
$query = "UPDATE sales SET kode_sales = '$kode_sales', username = '$username', password = '$password' WHERE kode_sales = '$kode_sales'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=user");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
