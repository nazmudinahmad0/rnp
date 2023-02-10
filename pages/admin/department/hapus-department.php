<?php

include '../../../config/database.php';

//get id
$kd = $_GET['id'];
$DeptName = $_GET['name'];

$query = "DELETE FROM department WHERE DeptID = '$kd'";

if($kon->query($query)) {
    $message = $DeptName.' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=department');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
