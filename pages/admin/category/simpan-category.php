<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$CatID           = $_POST['CatID'];
$CatName         = $_POST['CatName'];

//query insert data ke dalam database
$query = "INSERT INTO category (CatID, CatName) VALUES ('$CatID', '$CatName')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($connection->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-category.php");
    $message = $CatName.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=category');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
