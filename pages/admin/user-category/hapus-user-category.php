<?php

include('koneksi.php');

//get id
$kd = $_GET['id'];

$query = "DELETE FROM usercategory WHERE UserID = '$kd'";

if($connection->query($query)) {
    header("location: ../../../index.php?page=user-category");
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
