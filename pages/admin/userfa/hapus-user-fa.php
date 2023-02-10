<?php

include '../../../config/database.php';

//get id
$kd = $_GET['kd'];
$nama_fa = $_GET['name'];

$query = "DELETE FROM fa WHERE id_fa = '$kd'";

if($kon->query($query)) {
    $message = $nama_fa.' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=userfa');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
