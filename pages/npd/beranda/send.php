<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include librari phpmailer
include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');

$email_pengirim = 'rnp.system@gmail.com'; // Isikan dengan email pengirim
$nama_pengirim = 'Team NPD'; // Isikan dengan nama pengirim
$email_penerima = isset($_POST['EmailSales']) ? $_POST['EmailSales']:''; // Ambil email penerima dari inputan form
$subjek = isset($_POST['subjek']) ? $_POST['subjek']:''; // Ambil subjek dari inputan form
$code_pro = isset($_POST['CodeProject']) ? $_POST['CodeProject']:''  ; // Ambil pesan dari inputan form
$pro_name = isset($_POST['Prod_Name']) ? $_POST['Prod_Name']:''  ; // Ambil pesan dari inputan form
$Comment  = isset($_POST['Comment']) ? $_POST['Comment']:''  ;


/* $pesan = $_POST['pesan']; // Ambil pesan dari inputan form */

$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->Username = $email_pengirim; // Email Pengirim
$mail->Password = 'qcnnzkfgxfqpstrg'; // Isikan dengan Password email pengirim
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
//$mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

$mail->setFrom($email_pengirim, $nama_pengirim);
$mail->addAddress($email_penerima, '');
$mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

// Load file content.php
ob_start();
include "content3.php";

$content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
ob_end_clean();

$mail->Subject = $subjek;
$mail->Body = $content;
$mail->AddEmbeddedImage('image/viro-logo.png', 'logo_viro', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email

$send = $mail->send();

if (isset($_POST['return_data'])) {

//Cek apakah ada kiriman form dari method post
if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {

    include 'database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");
    
    $NumDoc=$_POST["NumDoc"];
    //$Comment=$_POST["Comment"];
    $Comment  = isset($_POST['Comment']) ? $_POST['Comment']:''; //ambil comment dari form inputan
    //$StatusRequest=$_POST["StatusRequest"];
    $StatusRequestNew=$_POST["StatusRequestNew"];
    $StatusDoc=$_POST["StatusDoc"];
    $DateComment=$_POST["DateComment"];
    //$DateVerification=$_POST["DateVerification"];
    //$EmailFA=$_POST["EmailFA"];
    $Dept=$_POST["Dept"];
    //$update_date=$_POST["update_date"];
    $sqlupdate="update tdocument set
                StatusRequest='$StatusRequestNew',
                StatusDoc='$StatusDoc'

               where NumDoc='$NumDoc'";

                $sql = "INSERT INTO thistorycomment (NumDoc,Comment,DateComment,Dept) VALUES ('$NumDoc','$Comment','$DateComment','$Dept')";
    //Menyimpan ke tabel kelas
    $simpan_data=mysqli_query($kon,$sqlupdate);
    $simpan_kelas=mysqli_query($kon,$sql);

    if ($simpan_kelas AND $simpan_data) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../../index.php?page=index-rnp&edit=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../../index.php?page=index-rnp&edit=gagal");
    }
}
}
?>