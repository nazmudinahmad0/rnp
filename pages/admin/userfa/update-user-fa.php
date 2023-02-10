<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$kode_fa     = $_POST['kode_fa'];
$username   = $_POST['username'];
$password   = md5($_POST['password']);

//query update data ke dalam database berdasarkan ID
$query = "UPDATE fa SET kode_fa = '$kode_fa', username = '$username', password = '$password' WHERE kode_fa = '$kode_fa'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=userfa");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
