<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$GenID            = $_POST['GenID'];
$GenName         = $_POST['GenName'];

//query insert data ke dalam database
$query = "INSERT INTO geninformation (GenID, GenName) VALUES ('$GenID', '$GenName')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = $GenName.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=general-information');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
