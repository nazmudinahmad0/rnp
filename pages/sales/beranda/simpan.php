<?php 
	include "koneksi.php";
	
	$id = $_POST['id'];
	$nama=$_POST['nama'];
	$namakabupaten=$_POST['namakabupaten'];
	$query = "update proforma_inv set DatePI='".$nama."',LeadTimeMKT='".$namakabupaten."' where NoPI=".$id;
	
	$update = mysqli_query($conn,$query);
	
	echo json_encode(array('st'=>1));
?>