<?php

    $host="localhost";

    $user="root";

    $password="";

    $db="db_fns";

    $kon = mysqli_connect($host,$user,$password,$db);

    if (!$kon){
	echo 'Database Connected....!';

          die("Koneksi gagal:".mysqli_connect_error());

    }

?>