<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$AppID            = $_POST['AppID'];
$AppName         = $_POST['AppName'];

//query insert data ke dalam database
$query = "INSERT INTO application (AppID, AppName) VALUES ('$AppID', '$AppName')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = $AppName.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=applications');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
