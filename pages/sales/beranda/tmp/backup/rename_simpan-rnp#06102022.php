<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include librari phpmailer
include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');

$email_pengirim = $_POST['EmailSales']; // Isikan dengan email pengirim
$nama_pengirim = 'Ahmad Nazmudin'; // Isikan dengan nama pengirim
$email_penerima = $_POST['EmailRND']; // Ambil email penerima dari inputan form
$subjek = $_POST['subjek']; // Ambil subjek dari inputan form
$pesan = $_POST['pesan']; // Ambil pesan dari inputan form
$code_pro = $_POST['CodeProject'];
$attachment  = isset($_FILES['attachment']['name']) ? $_FILES['attachment']['name'] : ''; // Ambil nama file yang di upload
$attachment1 = isset($_FILES['attachment1']['name']) ? $_FILES['attachment1']['name'] : '';
$attachment2 = isset($_FILES['attachment2']['name']) ? $_FILES['attachment2']['name'] : '';
$attachment3 = isset($_FILES['attachment3']['name']) ? $_FILES['attachment3']['name'] : '';
$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->Username = $email_pengirim; // Email Pengirim
$mail->Password = 'amywmbscgbtvltsm'; // Isikan dengan Password email pengirim
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
// $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

$mail->setFrom($email_pengirim, $nama_pengirim);
$mail->addAddress($email_penerima, '');
$mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

// Load file content.php
ob_start();
include "content.php";

$content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
ob_end_clean();

$mail->Subject = $subjek;
$mail->Body = $content;
$mail->AddEmbeddedImage('image/viro-logo.png', 'logo_viro', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email



//kondisi attachment 1


if(empty($attachment) AND empty($attachment1) AND empty($attachment2) AND empty($attachment3)){ // Jika tanpa attachment
    $send = $mail->send();

    include '../../../config/database.php';
    $for_query = '';
    $to_query = '';
    $from_query = '';

        if(!empty($_POST["language"])){

        foreach($_POST["language"] as $language){

        $for_query .= $language . ', ';

        }
        $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){

        foreach($_POST["frame"] as $frame){
        
        $to_query .= $frame . ', ';
        
        }
        $to_query          = substr($to_query, 0, -2);
        }
if(!empty($_POST["genif"])){

 foreach($_POST["genif"] as $genif){
   
 $from_query .= $genif . ', ';
   
 }
 $from_query          = substr($from_query, 0, -2);
}
$NumDoc             = $_POST['NumDoc'];
$DateRequest        = $_POST['DateRequest'];
$DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
//$EmailSales         = $_POST['EmailSales'];
//$Customer         = $_POST['Customer'];
//$EmailRND           = $_POST['EmailRND'];
$NPDType            = $_POST['NPDType'];
$CodeProject        = $_POST['CodeProject'];
$Prod_Name          = $_POST['Prod_Name'];
$CustName           = $_POST['CustName'];
$CustPhone          = $_POST['CustPhone'];
$DateFeedbackExp    = $_POST['DateFeedbackExp'];
$DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
$PatternFiber       = $_POST['PatternFiber'];
$SpecialSize        = $_POST['SpecialSize'];
$OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
$PackagingDetail    = $_POST['PackagingDetail'];
$Square             = $_POST['Square'];
$Budget             = $_POST['Budget'];
$Location           = $_POST['Location'];
$DateTarget         = $_POST['DateTarget'];
$DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
$ImportantRequest   = $_POST['ImportantRequest'];
//query insert data ke dalam database
$sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
$sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
$sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
$sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
    if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {
        $message = $NumDoc.' Berhasil ditambah';
        echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();;
    }else{ // Jika Email gagal dikirim
        echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
        // echo '<h1>ERROR<br /><small>Error while sending email: '.$mail->getError().'</small></h1>'; // Aktifkan untuk mengetahui error message
    }
}


//kondisi attachment 2

elseif(($attachment) AND empty($attachment1) AND empty($attachment2) AND empty($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


//kondisi attachment 3


elseif(empty($attachment) AND ($attachment1) AND empty($attachment2) AND empty($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment1']['tmp_name'];
    $size = $_FILES['attachment1']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment1); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}



// kondisi attachment 4 


elseif(empty($attachment) AND empty ($attachment1) AND ($attachment2) AND empty($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment2']['tmp_name'];
    $size = $_FILES['attachment2']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment2); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


//kondisi attachment 5



elseif(empty($attachment) AND empty ($attachment1) AND empty ($attachment2) AND ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment3']['tmp_name'];
    $size = $_FILES['attachment3']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment3); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}



// kondisi attachment 6


elseif(($attachment) AND ($attachment1) AND empty ($attachment2) AND empty ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];
    $tmp = $_FILES['attachment1']['tmp_name'];
    $size = $_FILES['attachment1']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment1); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


//kondisi attachment 7


elseif( empty ($attachment) AND ($attachment1) AND  ($attachment2) AND empty ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment1']['tmp_name'];
    $size = $_FILES['attachment1']['size'];
    $tmp = $_FILES['attachment2']['tmp_name'];
    $size = $_FILES['attachment2']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment1); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment2); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


// kondisi attachment 8


elseif( empty ($attachment) AND empty ($attachment1) AND ($attachment2) AND ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment2']['tmp_name'];
    $size = $_FILES['attachment2']['size'];
    $tmp = $_FILES['attachment3']['tmp_name'];
    $size = $_FILES['attachment3']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment2); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment3); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}



//kondisi attachment 9



elseif( ($attachment) AND empty ($attachment1) AND empty ($attachment2) AND ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];
    $tmp = $_FILES['attachment3']['tmp_name'];
    $size = $_FILES['attachment3']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment3); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}



// kondisi attachment 10


elseif( ($attachment) AND ($attachment1) AND ($attachment2) AND empty ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];
    $tmp = $_FILES['attachment1']['tmp_name'];
    $size = $_FILES['attachment1']['size'];
    $tmp = $_FILES['attachment2']['tmp_name'];
    $size = $_FILES['attachment2']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment1);
        $mail->addAttachment($tmp, $attachment2); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


//kondisi attachment 11

elseif( empty ($attachment) AND ($attachment1) AND ($attachment2) AND ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment1']['tmp_name'];
    $size = $_FILES['attachment1']['size'];
    $tmp = $_FILES['attachment2']['tmp_name'];
    $size = $_FILES['attachment2']['size'];
    $tmp = $_FILES['attachment3']['tmp_name'];
    $size = $_FILES['attachment3']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment1); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment2);
        $mail->addAttachment($tmp, $attachment3); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


//kondisi attachment 12


elseif( ($attachment) AND empty ($attachment1) AND ($attachment2) AND ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];
    $tmp = $_FILES['attachment2']['tmp_name'];
    $size = $_FILES['attachment2']['size'];
    $tmp = $_FILES['attachment3']['tmp_name'];
    $size = $_FILES['attachment3']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment2);
        $mail->addAttachment($tmp, $attachment3); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


//kondisi attachment 13



elseif( ($attachment) AND ($attachment1) AND empty ($attachment2) AND ($attachment3) ){ // Jika tanpa attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];
    $tmp = $_FILES['attachment1']['tmp_name'];
    $size = $_FILES['attachment1']['size'];
    $tmp = $_FILES['attachment3']['tmp_name'];
    $size = $_FILES['attachment3']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment1);
        $mail->addAttachment($tmp, $attachment3); // Add file yang akan di kirim
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}









else{ // Jika dengan semua attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];
    $tmp = $_FILES['attachment1']['tmp_name'];
    $size = $_FILES['attachment1']['size'];
    $tmp = $_FILES['attachment2']['tmp_name'];
    $size = $_FILES['attachment2']['size'];
    $tmp = $_FILES['attachment3']['tmp_name'];
    $size = $_FILES['attachment3']['size'];

    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $mail->addAttachment($tmp, $attachment1);
        $mail->addAttachment($tmp, $attachment2);
        $mail->addAttachment($tmp, $attachment3);
        $send = $mail->send();
        include '../../../config/database.php';
        //if(isset($_POST['submit']) && $_POST['submit'] =='Submit' ){
          //  $originalDate = $_POST['datepicker'];
            //$newDate = date("Y-m-d", strtotime($originalDate));
        //get data dari form
        $for_query = '';
        $to_query = '';
        $from_query = '';
        
        if(!empty($_POST["language"])){
        
         foreach($_POST["language"] as $language){
        
          $for_query .= $language . ', ';
        
         }
         $for_query          = substr($for_query, 0, -2);
        }
        if(!empty($_POST["frame"])){
        
         foreach($_POST["frame"] as $frame){
           
          $to_query .= $frame . ', ';
           
         }
         $to_query          = substr($to_query, 0, -2);
        }
        if(!empty($_POST["genif"])){
        
         foreach($_POST["genif"] as $genif){
           
         $from_query .= $genif . ', ';
           
         }
         $from_query          = substr($from_query, 0, -2);
        }
        $NumDoc             = $_POST['NumDoc'];
        $DateRequest        = $_POST['DateRequest'];
        $DR                 = date("Y-m-d H:i:s", strtotime($DateRequest));
        //$EmailSales         = $_POST['EmailSales'];
        //$Customer         = $_POST['Customer'];
        //$EmailRND           = $_POST['EmailRND'];
        $NPDType            = $_POST['NPDType'];
        $CodeProject        = $_POST['CodeProject'];
        $Prod_Name          = $_POST['Prod_Name'];
        $CustName           = $_POST['CustName'];
        $CustPhone          = $_POST['CustPhone'];
        $DateFeedbackExp    = $_POST['DateFeedbackExp'];
        $DFE                = date("Y-m-d H:i:s", strtotime($DateFeedbackExp));
        $PatternFiber       = $_POST['PatternFiber'];
        $SpecialSize        = $_POST['SpecialSize'];
        $OtherLinkDrawing   = $_POST['OtherLinkDrawing'];
        $PackagingDetail    = $_POST['PackagingDetail'];
        $Square             = $_POST['Square'];
        $Budget             = $_POST['Budget'];
        $Location           = $_POST['Location'];
        $DateTarget         = $_POST['DateTarget'];
        $DT                 = date("Y-m-d H:i:s", strtotime($DateTarget));
        $ImportantRequest   = $_POST['ImportantRequest'];
        //query insert data ke dalam database
        $sql1 = "INSERT INTO tdocument (NumDoc,DateRequest,EmailSales,EmailRND,NPDType,CodeProject,Prod_Name,CustName,CustPhone,DateFeedbackExp,PatternFiber,SpecialSize,OtherLinkDrawing,PackagingDetail,Square,Budget,Location,DateTarget,ImportantRequest) VALUES ('$NumDoc', '$DR','$email_pengirim','$email_penerima','$NPDType','$CodeProject','$Prod_Name','$CustName','$CustPhone','$DFE','$PatternFiber','$SpecialSize','$OtherLinkDrawing','$PackagingDetail','$Square','$Budget','$Location','$DT','$ImportantRequest')";
        $sql2 = "INSERT INTO tapplications (NumDoc,AppName) VALUES ('$NumDoc','$for_query')";
        $sql3 = "INSERT INTO tframedetail (NumDoc,FrameName) VALUES ('$NumDoc','$to_query')";
        $sql4 = "INSERT INTO tgeninformation(NumDoc,GenifName) VALUES ('$NumDoc','$from_query')";
        

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($send AND $kon->query($sql1) AND $kon->query($sql2)AND $kon->query($sql3)AND $kon->query($sql4))  {

    //redirect ke halaman index.php 
    //header("location: transaction-pi.php");
    $message = $NumDoc.' Berhasil ditambah';
    echo "<SCRIPT> 
        alert('$message')
        window.location.replace('../../../index.php?page=rnp');
    </SCRIPT>";
    mysql_close();

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}
}else{ // Jika Ukuran file lebih dari 25 MB
    echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
}
}


?>
