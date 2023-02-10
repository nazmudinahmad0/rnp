<?php

include('koneksi.php');

//get id
$kd = $_GET['id'];

$query = "DELETE FROM sales_order WHERE NumDoc = '$kd'";

if($connection->query($query)) {
    header("location: ../../../index.php?page=so");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
