<?php
include 'koneksi.php';
$NoPI = $_GET['NoPI'];
$query = mysqli_query($connection, "select * from sales_order where NoPI='$NoPI'");
$sales_order = mysqli_fetch_array($query);
$data = array(
            'NoSO'      =>  $sales_order['NoSO'],
            );
 echo json_encode($data);
?>