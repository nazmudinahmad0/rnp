<?php

include('koneksi.php');

//get id
$kd = $_GET['id'];

$query = "DELETE FROM proforma_inv WHERE NumDoc = '$kd'";

if($connection->query($query)) {
    header("location: ../../../index.php?page=pi");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
