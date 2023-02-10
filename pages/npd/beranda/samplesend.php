<?php

    //PHP MAILER START
    session_start();

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
    //$pesan = isset($_POST['pesan']) ? $_POST['pesan']:''; // Ambil subjek dari inputan form
    $code_pro = isset($_POST['CodeProject']) ? $_POST['CodeProject']:''  ; // Ambil pesan dari inputan form
    $pro_name = isset($_POST['Prod_Name']) ? $_POST['Prod_Name']:''  ; // Ambil pesan dari inputan form

    $Comment  = isset($_POST['Comment']) ? $_POST['Comment']:''  ;
    //$code_pro = $_POST['CodeProject'];
    //$pro_name = $_POST['Prod_Name'];
    //$code_pro = $_POST['CodeProject'];
    $attachment  = isset($_FILES['attachment']['name']) ? $_FILES['attachment']['name'] : ''; // Ambil nama file yang di upload
    $attachment1 = isset($_FILES['attachment1']['name']) ? $_FILES['attachment1']['name'] : ''; // Ambil nama file yang di upload
    //$comment     = isset($_POST['comment']) ? $_POST['comment']:''; //Ambil comment dari inputan form

    //$email_pengirim = 'infobaik111@gmail.com'; // Isikan dengan email pengirim
    //$nama_pengirim = 'Ahmad Nazmudin'; // Isikan dengan nama pengirim
    //$email_penerima = $_POST['email_penerima']; // Ambil email penerima dari inputan form
    //$subjek = $_POST['subjek']; // Ambil subjek dari inputan form
    //$pesan = $_POST['pesan']; // Ambil pesan dari inputan form
    //$attachment = $_FILES['attachment']['name']; // Ambil nama file yang di upload

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
    include "content4.php";

    $content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
    ob_end_clean();

    $mail->Subject = $subjek;
    $mail->Body = $content;
    $mail->AddEmbeddedImage('image/viro-logo.png', 'logo_viro', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email

    if(empty($attachment) AND empty($attachment1)){
        $send = $mail->send();

        
    
        if (isset($_POST['edit_kelas'])) {

        //Cek apakah ada kiriman form dari method post
        if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {

            include '../../../config/database.php';
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");
            
            $NumDoc=$_POST["NumDoc"];
            $DateVerification=$_POST["DateVerification"];
            $DateEstBOM=$_POST["DateEstBOM"];
            $EmailSales=$_POST["EmailSales"];
            $StatusRequest=$_POST["StatusRequest"];
            $StatusDoc=$_POST["StatusDoc"];
            $DateComment=$_POST["DateComment"];
            $Dept = 'NPD';
            $comment = 'NPD Send Sample';
      
            $sql="update tdocument set
            NumDoc='$NumDoc',
            DateVerification='$DateVerification',
            DateEstBOM='$DateEstBOM',
            EmailSales='$EmailSales',
            StatusRequest='$StatusRequest',
            StatusDoc='$StatusDoc'
            where NumDoc='$NumDoc'";

            $querysample = "INSERT INTO thistorycomment (NumDoc,Comment,DateComment,Dept) VALUES ('$NumDoc','$comment','$DateComment','$Dept')";
        
            //Menyimpan ke tabel kelas
            $simpan_kelas=mysqli_query($kon,$sql);
            $simpan_send_sample=mysqli_query($kon,$querysample);

            if ($simpan_kelas AND $simpan_send_sample) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../../index.php?page=index-rnp&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../../index.php?page=index-rnp&edit=gagal");
            }
        }
    }
    }
    elseif (empty($attachment) AND ($attachment1)){
        $tmp = $_FILES['attachment1']['tmp_name'];
        $size = $_FILES['attachment1']['size'];
    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment1);
        $send = $mail->send();

        if (isset($_POST['edit_kelas'])) 
        {
            //Cek apakah ada kiriman form dari method post
            if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {
            
            include '../../../config/database.php';
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");
                        
            $NumDoc=$_POST["NumDoc"];
            $DateVerification=$_POST["DateVerification"];
            $DateEstBOM=$_POST["DateEstBOM"];
            $EmailSales=$_POST["EmailSales"];
            $StatusRequest=$_POST["StatusRequest"];
            $StatusDoc=$_POST["StatusDoc"];
            $DateComment=$_POST["DateComment"];
            $Dept = 'NPD';
            $comment = 'NPD Send Sample';
               
            $sql="update tdocument set
            NumDoc='$NumDoc',
            DateVerification='$DateVerification',
            DateEstBOM='$DateEstBOM',
            EmailSales='$EmailSales',
            StatusRequest='$StatusRequest',
            StatusDoc='$StatusDoc'
            where NumDoc='$NumDoc'";

            $querysample = "INSERT INTO thistorycomment (NumDoc,Comment,DateComment,Dept) VALUES ('$NumDoc','$comment','$DateComment','$Dept')";
                    
            //Menyimpan ke tabel kelas
            $simpan_kelas=mysqli_query($kon,$sql);
            $simpan_send_sample=mysqli_query($kon,$querysample);
         
            if ($simpan_kelas AND $simpan_send_sample) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../../index.php?page=index-rnp&edit=berhasil");
            }
            else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../../index.php?page=index-rnp&edit=gagal");
            }
          }
        }


    }else {
        echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
    }

    
    }

    //kondisi 2


    elseif (($attachment) AND empty($attachment1)){
        $tmp = $_FILES['attachment']['tmp_name'];
        $size = $_FILES['attachment']['size'];
    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment);
        $send = $mail->send();

        if (isset($_POST['edit_kelas'])) 
        {
                    //Cek apakah ada kiriman form dari method post
                    if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {
            
                        include '../../../config/database.php';
                        //Memulai transaksi
                        mysqli_query($kon,"START TRANSACTION");
                        
                        $NumDoc=$_POST["NumDoc"];
                        $DateVerification=$_POST["DateVerification"];
                        $DateEstBOM=$_POST["DateEstBOM"];
                        $EmailSales=$_POST["EmailSales"];
                        $StatusRequest=$_POST["StatusRequest"];
                        $StatusDoc=$_POST["StatusDoc"];
                        $DateComment=$_POST["DateComment"];
                        $Dept = 'NPD';
                        $comment = 'NPD Send Sample';

                
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateVerification='$DateVerification',
                        DateEstBOM='$DateEstBOM',
                        EmailSales='$EmailSales',
                        StatusRequest='$StatusRequest',
                        StatusDoc='$StatusDoc'
                        where NumDoc='$NumDoc'";

                        $querysample = "INSERT INTO thistorycomment (NumDoc,Comment,DateComment,Dept) VALUES ('$NumDoc','$comment','$DateComment','$Dept')";
                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
                        $simpan_send_sample=mysqli_query($kon,$querysample);
            
                                    if ($simpan_kelas AND $simpan_send_sample) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=index-rnp&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=index-rnp&edit=gagal");
                                    }
                    }
        }


    }else {
        echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
    }

    }
    //kondisi 3

    else {
        $tmp = $_FILES['attachment']['tmp_name'];
        $size = $_FILES['attachment']['size'];
        $tmp = $_FILES['attachment1']['tmp_name'];
        $size = $_FILES['attachment1']['size'];
    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment);
        $mail->addAttachment($tmp, $attachment1);
        $send = $mail->send();

        if (isset($_POST['edit_kelas'])) 
        {
                    //Cek apakah ada kiriman form dari method post
                    if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {
            
                        include '../../../config/database.php';
                        //Memulai transaksi
                        mysqli_query($kon,"START TRANSACTION");
                        
                        $NumDoc=$_POST["NumDoc"];
                        $DateVerification=$_POST["DateVerification"];
                        $DateEstBOM=$_POST["DateEstBOM"];
                        $EmailSales=$_POST["EmailSales"];
                        $StatusRequest=$_POST["StatusRequest"];
                        $StatusDoc=$_POST["StatusDoc"];
                        $DateComment=$_POST["DateComment"];
                        $Dept = 'NPD';
                        $comment = 'NPD Send Sample';

                
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateVerification='$DateVerification',
                        DateEstBOM='$DateEstBOM',
                        EmailSales='$EmailSales',
                        StatusRequest='$StatusRequest',
                        StatusDoc='$StatusDoc'
                        where NumDoc='$NumDoc'";

                        $querysample = "INSERT INTO thistorycomment (NumDoc,Comment,DateComment,Dept) VALUES ('$NumDoc','$comment','$DateComment','$Dept')";

                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
                        $simpan_send_sample=mysqli_query($kon,$querysample);
            
                                    if ($simpan_kelas AND $simpan_send_sample) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=index-rnp&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=index-rnp&edit=gagal");
                                    }
                    }
        }


    }else {
        echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
    }

    
    }
    

    //$send = $mail->send();
    //$kirim = $mail->kirim();
        

?>