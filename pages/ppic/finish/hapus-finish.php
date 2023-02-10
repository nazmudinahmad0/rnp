<?php

include('koneksi.php');

//get id
$kd = $_GET['id'];

$query = "DELETE FROM finish WHERE NumDoc = '$kd'";

if($connection->query($query)) {
    header("location: ../../../index.php?page=finish");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
