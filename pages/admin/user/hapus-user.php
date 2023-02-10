<?php

include '../../../config/database.php';

//get id
$kd = $_GET['kd'];
$nama_sales = $_GET['name'];

$query = "DELETE FROM sales WHERE id_sales = '$kd'";

if($kon->query($query)) {
    $message = $nama_sales.' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=user');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
