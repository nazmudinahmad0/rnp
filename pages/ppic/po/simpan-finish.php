<?php

//include koneksi database
include('koneksi.php');
//if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
  //  $originalDate = $_POST['datepicker'];
    //$newDate = date("Y-m-d", strtotime($originalDate));
//get data dari form
$NumDoc           = $_POST['NumDoc'];
$CatID            = $_POST['CatID'];
$NoPI             = $_POST['NoPI'];
$DateFinish       = $_POST['DateFinish'];
$newDate          = date("Y-m-d H:i:s", strtotime($DateFinish));
$status_ok        = $_POST['status_ok'];
$UserID           = $_POST['UserID'];

//query insert data ke dalam database
$query = "INSERT INTO finish (NumDoc,CatID,NoPI,DateFinish,status_ok,UserID) VALUES ('$NumDoc', '$CatID','$NoPI','$newDate','$status_ok','$UserID')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($connection->query($query)) {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = 'No Proforma Invoice '.$NoPI.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=finish');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
