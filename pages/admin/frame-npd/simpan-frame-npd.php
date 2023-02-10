<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$FrameID            = $_POST['FrameID'];
$FrameName         = $_POST['FrameName'];

//query insert data ke dalam database
$query = "INSERT INTO frame_detail (FrameID, FrameName) VALUES ('$FrameID', '$FrameName')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    //header("location: tambah-department.php");
    $message = $FrameName.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=frame-detail');
    </SCRIPT>";
    mysql_close();
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
