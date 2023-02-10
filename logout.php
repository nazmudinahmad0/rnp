<?php
    //Memulai session
    session_start();

    if (isset($_SESSION['id_guru'])){

        $_SESSION['id_guru']='';
        $_SESSION['kode_guru']='';
    
        //Hapus session
        unset($_SESSION['id_guru']);
        unset($_SESSION['kode_guru']);

    }


    session_unset();
    session_destroy();

    header('Location:login.php');

?>