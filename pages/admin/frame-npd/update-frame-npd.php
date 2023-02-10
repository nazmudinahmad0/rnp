<?php

//include koneksi database
include '../../../config/database.php';

//get data dari form
$FrameID      = $_POST['FrameID'];
$FrameName   = $_POST['FrameName'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE frame_detail SET FrameName = '$FrameName' WHERE FrameID = '$FrameID'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: ../../../index.php?page=frame-detail");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>
