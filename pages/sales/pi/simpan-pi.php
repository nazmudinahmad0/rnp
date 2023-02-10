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
//$Customer         = $_POST['Customer'];
$DatePI           = $_POST['DatePI'];
$newDate          = date("Y-m-d H:i:s", strtotime($DatePI));
$LeadTimeMKT      = $_POST['LeadTimeMKT'];
$baruDate          = date("Y-m-d H:i:s", strtotime($LeadTimeMKT));
$UserID           = $_POST['UserID'];

//query insert data ke dalam database
$query = "INSERT INTO proforma_inv (NumDoc,CatID,NoPI,DatePI,LeadTimeMKT,UserID) VALUES ('$NumDoc', '$CatID','$NoPI','$newDate','$baruDate','$UserID')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($connection->query($query)) {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = 'No Proforma Invoice '.$NoPI.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=pi');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>
