<?php

include '../../../config/database.php';

//get id
$kd = $_GET['id'];
$AppName  = $_GET['name'];

$query = "DELETE FROM application WHERE AppID  = '$kd'";

if($kon->query($query)) {
    $message = $AppName .' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=applications');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
