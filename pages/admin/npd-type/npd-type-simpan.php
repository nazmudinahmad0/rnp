<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$NPDTypeID           = $_POST['NPDTypeID'];
$NPDTypeName         = $_POST['NPDTypeName'];

//query insert data ke dalam database
$query = "INSERT INTO npdtype (NPDTypeID, NPDTypeName) VALUES ('$NPDTypeID', '$NPDTypeName')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = $NPDTypeName.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=npdtype');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
