<?php

include '../../../config/database.php';

//get id
$kd = $_GET['id'];
$NPDTypeName  = $_GET['name'];

$query = "DELETE FROM npdtype WHERE NPDTypeID  = '$kd'";

if($kon->query($query)) {
    $message = $NPDTypeName .' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=npdtype');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
