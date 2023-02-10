<?php

include '../../../config/database.php';

//get id
$kd = $_GET['id'];
$GenName   = $_GET['name'];

$query = "DELETE FROM geninformation WHERE GenID   = '$kd'";

if($kon->query($query)) {
    $message = $GenName .' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=general-information');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
