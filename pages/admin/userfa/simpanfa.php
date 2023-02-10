<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$id_fa           = $_POST['id_fa'];
$kode_fa         = $_POST['kode_fa'];
$nama_fa         = $_POST['nama_fa'];
$username        = $_POST['username'];
$password        = md5($_POST['password']);
$DeptID          = $_POST['DeptID'];
//query insert data ke dalam database
$query = "INSERT INTO fa (id_fa,DeptID,kode_fa,nama_fa,username,password) VALUES ('$id_fa', '$DeptID','$kode_fa','$nama_fa','$username','$password')";
//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = 'User '.$nama_fa.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=userfa');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
