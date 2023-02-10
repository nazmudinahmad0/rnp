<?php

include '../../../config/database.php';

//get id
$kd = $_GET['id'];
$FrameName  = $_GET['name'];

$query = "DELETE FROM frame_detail WHERE FrameID   = '$kd'";

if($kon->query($query)) {
    $message = $FrameName .' Berhasil di Hapus.';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=frame-detail');
    </SCRIPT>";
    mysql_close();
} else {
    echo "DATA GAGAL DIHAPUS!";
}

?>
