<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$id_npd           = $_POST['id_npd'];
$kode_npd         = $_POST['kode_npd'];
$nama_npd         = $_POST['nama_npd'];
$username         = $_POST['username'];
$password         = md5($_POST['password']);
$DeptID           = $_POST['DeptID'];
$plant            = $_POST['plant'];
//query insert data ke dalam database
$query = "INSERT INTO npd (id_npd,DeptID,kode_npd,nama_npd,username,password,plant) VALUES ('$id_npd', '$DeptID','$kode_npd','$nama_npd','$username','$password','$plant')";
//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = 'User '.$nama_npd.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=usernpd');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
