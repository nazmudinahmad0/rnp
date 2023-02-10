<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$DeptID           = $_POST['DeptID'];
$DeptName         = $_POST['DeptName'];

//query insert data ke dalam database
$query = "INSERT INTO department (DeptID, DeptName) VALUES ('$DeptID', '$DeptName')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = $DeptName.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=department');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
