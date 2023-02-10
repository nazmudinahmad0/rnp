<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$id_sales           = $_POST['id_sales'];
$kode_sales         = $_POST['kode_sales'];
$nama_sales         = $_POST['nama_sales'];
$username           = $_POST['username'];
$password           = md5($_POST['password']);
$DeptID             = $_POST['DeptID'];
$sales_category     = $_POST['sales_category'];
//query insert data ke dalam database
$query = "INSERT INTO sales (id_sales,DeptID,kode_sales,nama_sales,username,password,sales_category) VALUES ('$id_sales', '$DeptID','$kode_sales','$nama_sales','$username','$password','$sales_category')";
//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = 'User '.$nama_sales.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=user');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
