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
$NoSO             = $_POST['NoSO'];
$status_so        = $_POST['status_so'];
$DateSO           = $_POST['DateSO'];
$newDate          = date("Y-m-d H:i:s", strtotime($DateSO));
$DateSOSAP        = $_POST['DateSOSAP'];
$sosapdate        = date("Y-m-d H:i:s", strtotime($DateSOSAP));
$UserID           = $_POST['UserID'];

//query insert data ke dalam database
$query = "INSERT INTO sales_order (NumDoc,CatID,NoPI,NoSO,status_so,DateSO,DateSOSAP,UserID) VALUES ('$NumDoc', '$CatID','$NoPI','$NoSO','$status_so','$newDate','$sosapdate','$UserID')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($connection->query($query)) {

    //redirect ke halaman index.php 
    //header("location: transaction-so.php");
    $message = 'No Sales Order '.$NoSO.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=beranda-admin-sales');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
