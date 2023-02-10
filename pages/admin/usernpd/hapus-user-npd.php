<?php

include '../../../config/database.php';

//get id
$kd = $_GET['kd'];
$nama_npd = $_GET['name'];

$query = "DELETE FROM npd WHERE id_npd = '$kd'";

if($kon->query($query)) {
    $message = $nama_npd.' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=usernpd');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
