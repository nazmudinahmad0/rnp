<?php
include 'koneksi.php';
$NoPI = $_GET['NoPI'];
$query = mysqli_query($koneksi, "select * from proforma_inv where NoPI='$NoPI'");
$proforma_inv = mysqli_fetch_array($query);
$data = array(
            'CatID'    =>  $proforma_inv['CatID'],);
 echo json_encode($data);
?>