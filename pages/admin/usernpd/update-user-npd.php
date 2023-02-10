<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$kode_npd     = $_POST['kode_npd'];
$username   = $_POST['username'];
$password   = md5($_POST['password']);

//query update data ke dalam database berdasarkan ID
$query = "UPDATE npd SET kode_npd = '$kode_npd', username = '$username', password = '$password' WHERE kode_npd = '$kode_npd'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=usernpd");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
