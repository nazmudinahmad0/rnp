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
$NoPO             = $_POST['NoPO'];
$DatePO           = $_POST['DatePO'];
$newDate          = date("Y-m-d H:i:s", strtotime($DatePO));
$DatePOSAP        = $_POST['DatePOSAP'];
$sosapdate        = date("Y-m-d H:i:s", strtotime($DatePOSAP));
$LeadTimePPIC     = $_POST['LeadTimePPIC'];
$tanggalan        = date("Y-m-d H:i:s", strtotime($LeadTimePPIC));
$UserID           = $_POST['UserID'];

//query insert data ke dalam database
$query = "INSERT INTO prod_order (NumDoc,CatID,NoPI,NoSO,NoPO,DatePO,DatePOSAP,LeadTimePPIC,UserID) VALUES ('$NumDoc', '$CatID','$NoPI','$NoSO','$NoPO','$newDate','$sosapdate','$tanggalan','$UserID')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($connection->query($query)) {

    //redirect ke halaman index.php 
    //header("location: transaction-so.php");
    $message = 'No Production Order '.$NoPO.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=ppic');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
