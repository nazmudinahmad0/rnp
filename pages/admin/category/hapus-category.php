<?php

include('koneksi.php');

//get id
$kd = $_GET['id'];

$query = "DELETE FROM category WHERE CatID = '$kd'";

if($connection->query($query)) {
    header("location: ../../../index.php?page=category");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
