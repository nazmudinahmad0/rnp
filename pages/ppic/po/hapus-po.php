<?php

include('koneksi.php');

//get id
$kd = $_GET['id'];

$query = "DELETE FROM prod_order WHERE NumDoc = '$kd'";

if($connection->query($query)) {
    header("location: ../../../index.php?page=ppic");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
