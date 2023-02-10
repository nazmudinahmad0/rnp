<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$UserID           = $_POST['UserID'];
$CategoryID         = $_POST['CategoryID'];

//query insert data ke dalam database
$query = "INSERT INTO usercategory (UserID, CategoryID) VALUES ('$UserID', '$CategoryID')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($connection->query($query)) {

    //redirect ke halaman index.php 
    $message = $UserID.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=user-category');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}



?>
