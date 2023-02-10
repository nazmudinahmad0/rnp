<?php
    //PHP MAILER START
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Include librari phpmailer
    include('phpmailer/Exception.php');
    include('phpmailer/PHPMailer.php');
    include('phpmailer/SMTP.php');

    $email_pengirim = 'npd@virobuild.com'; // Isikan dengan email pengirim
    $nama_pengirim = 'Team Sales'; // Isikan dengan nama pengirim
    $email_penerima = isset($_POST['EmailFA']) ? $_POST['EmailFA']:''; // Ambil email penerima dari inputan form
    $subjek = isset($_POST['subjek']) ? $_POST['subjek']:''; // Ambil subjek dari inputan form
    //$pesan = isset($_POST['pesan']) ? $_POST['pesan']:''; // Ambil subjek dari inputan form
    $code_pro = isset($_POST['CodeProject']) ? $_POST['CodeProject']:''  ; // Ambil pesan dari inputan form
    $pro_name = isset($_POST['Prod_Name']) ? $_POST['Prod_Name']:''  ; // Ambil pesan dari inputan form
    //$code_pro = $_POST['CodeProject'];
    //$pro_name = $_POST['Prod_Name'];
    //$code_pro = $_POST['CodeProject'];
    $attachment  = isset($_FILES['attachment']['name']) ? $_FILES['attachment']['name'] : ''; // Ambil nama file yang di upload
    $attachment1  = isset($_FILES['attachment1']['name']) ? $_FILES['attachment1']['name'] : ''; // Ambil nama file yang di upload

    //$email_pengirim = 'infobaik111@gmail.com'; // Isikan dengan email pengirim
    //$nama_pengirim = 'Ahmad Nazmudin'; // Isikan dengan nama pengirim
    //$email_penerima = $_POST['email_penerima']; // Ambil email penerima dari inputan form
    //$subjek = $_POST['subjek']; // Ambil subjek dari inputan form
    //$pesan = $_POST['pesan']; // Ambil pesan dari inputan form
    //$attachment = $_FILES['attachment']['name']; // Ambil nama file yang di upload


    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->Host = 'smtpout.secureserver.net';
    $mail->Username = $email_pengirim; // Email Pengirim
    $mail->Password = 'asianreed'; // Isikan dengan Password email pengirim
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
            $EmailFA=$_POST["EmailFA"];
            $StatusRequest=$_POST["StatusRequest"];
            $StatusDoc=$_POST["StatusDoc"];
            $CodeProject=$_POST["CodeProject"];
            $DateRequest=$_POST["DateRequest"];
            $EmailSales=$_POST["EmailSales"];
            $EmailRND=$_POST["EmailRND"];
            $NPDType=$_POST["NPDType"];
           // $CodeProject=$_POST["CodeProject"];
            $Prod_Name=$_POST["Prod_Name"];
            $CustName=$_POST["CustName"];
            $CustPhone=$_POST["CustPhone"];
            $DateFeedbackExp=$_POST["DateFeedbackExp"];
            $AppName=$_POST["AppName"];
            $PatternFiber=$_POST["PatternFiber"];
            $FrameName=$_POST["FrameName"];
            $SpecialSize=$_POST["SpecialSize"];
            $OtherLinkDrawing=$_POST["OtherLinkDrawing"];
            $GenifName=$_POST["GenifName"];
            $PackagingDetail=$_POST["PackagingDetail"];
            $Square=$_POST["Square"];
            $Budget=$_POST["Budget"];
            $Location=$_POST["Location"];
            $DateTarget=$_POST["DateTarget"];
            $ImportantRequest=$_POST["ImportantRequest"];
            $AppName=implode(",",$_POST["AppName"]);
            $FrameName=implode(",",$_POST["FrameName"]);
            $GenifName=implode(",",$_POST["GenifName"]);


      
            $sql="update tdocument 
            LEFT JOIN tapplications ON tdocument.NumDoc = tapplications.NumDoc
            LEFT JOIN tframedetail ON tdocument.NumDoc = tframedetail.NumDoc
            LEFT JOIN tgeninformation ON tdocument.NumDoc = tgeninformation.NumDoc 
            set
            tdocument.DateVerification='$DateVerification',
            tdocument.DateEstBOM='$DateEstBOM',
            tdocument.EmailFA='$EmailFA',
            tdocument.StatusRequest='$StatusRequest',
            tdocument.StatusDoc='$StatusDoc',
            tdocument.CodeProject='$CodeProject',
            tdocument.DateRequest='$DateRequest',
            tdocument.EmailSales='$EmailSales',
            tdocument.EmailRND='$EmailRND',
            tdocument.NPDType='$NPDType',
            tdocument.Prod_Name='$Prod_Name',
            tdocument.CustName='$CustName',
            tdocument.CustPhone='$CustPhone',
            tdocument.DateFeedbackExp='$DateFeedbackExp',
            tapplications.AppName='$AppName',
            tdocument.PatternFiber='$PatternFiber',
            tframedetail.FrameName='$FrameName',
            tdocument.SpecialSize='$SpecialSize',
            tdocument.OtherLinkDrawing='$OtherLinkDrawing',
            tgeninformation.GenifName='$GenifName',
            tdocument.PackagingDetail='$PackagingDetail',
            tdocument.Square='$Square',
            tdocument.Budget='$Budget',
            tdocument.Location='$Location',
            tdocument.DateTarget='$DateTarget',
            tdocument.ImportantRequest='$ImportantRequest'

            where tdocument.NumDoc='$NumDoc'";
        
            //Menyimpan ke tabel kelas
            $simpan_kelas=mysqli_query($kon,$sql);

            if ($simpan_kelas) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../../index.php?page=beranda-sales&edit=gagal");
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
                        $EmailFA=$_POST["EmailFA"];
                        $StatusRequest=$_POST["StatusRequest"];
                        $StatusDoc=$_POST["StatusDoc"];
                        $CodeProject=$_POST["CodeProject"];
                        $DateRequest=$_POST["DateRequest"];
                        $EmailSales=$_POST["EmailSales"];
                        $EmailRND=$_POST["EmailRND"];
                        $NPDType=$_POST["NPDType"];
                       // $CodeProject=$_POST["CodeProject"];
                        $Prod_Name=$_POST["Prod_Name"];
                        $CustName=$_POST["CustName"];
                        $CustPhone=$_POST["CustPhone"];
                        $DateFeedbackExp=$_POST["DateFeedbackExp"];
                        $AppName=$_POST["AppName"];
                        $PatternFiber=$_POST["PatternFiber"];
                        $FrameName=$_POST["FrameName"];
                        $SpecialSize=$_POST["SpecialSize"];
                        $OtherLinkDrawing=$_POST["OtherLinkDrawing"];
                        $GenifName=$_POST["GenifName"];
                        $PackagingDetail=$_POST["PackagingDetail"];
                        $Square=$_POST["Square"];
                        $Budget=$_POST["Budget"];
                        $Location=$_POST["Location"];
                        $DateTarget=$_POST["DateTarget"];
                        $ImportantRequest=$_POST["ImportantRequest"];
                        $AppName=implode(",",$_POST["AppName"]);
                        $FrameName=implode(",",$_POST["FrameName"]);
                        $GenifName=implode(",",$_POST["GenifName"]);
            
            
                  
                        $sql="update tdocument 
                        LEFT JOIN tapplications ON tdocument.NumDoc = tapplications.NumDoc
                        LEFT JOIN tframedetail ON tdocument.NumDoc = tframedetail.NumDoc
                        LEFT JOIN tgeninformation ON tdocument.NumDoc = tgeninformation.NumDoc 
                        set
                        tdocument.DateVerification='$DateVerification',
                        tdocument.DateEstBOM='$DateEstBOM',
                        tdocument.EmailFA='$EmailFA',
                        tdocument.StatusRequest='$StatusRequest',
                        tdocument.StatusDoc='$StatusDoc',
                        tdocument.CodeProject='$CodeProject',
                        tdocument.DateRequest='$DateRequest',
                        tdocument.EmailSales='$EmailSales',
                        tdocument.EmailRND='$EmailRND',
                        tdocument.NPDType='$NPDType',
                        tdocument.Prod_Name='$Prod_Name',
                        tdocument.CustName='$CustName',
                        tdocument.CustPhone='$CustPhone',
                        tdocument.DateFeedbackExp='$DateFeedbackExp',
                        tapplications.AppName='$AppName',
                        tdocument.PatternFiber='$PatternFiber',
                        tframedetail.FrameName='$FrameName',
                        tdocument.SpecialSize='$SpecialSize',
                        tdocument.OtherLinkDrawing='$OtherLinkDrawing',
                        tgeninformation.GenifName='$GenifName',
                        tdocument.PackagingDetail='$PackagingDetail',
                        tdocument.Square='$Square',
                        tdocument.Budget='$Budget',
                        tdocument.Location='$Location',
                        tdocument.DateTarget='$DateTarget',
                        tdocument.ImportantRequest='$ImportantRequest'
            
                        where tdocument.NumDoc='$NumDoc'";
                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
            
                                    if ($simpan_kelas) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=beranda-sales&edit=gagal");
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
            $EmailFA=$_POST["EmailFA"];
            $StatusRequest=$_POST["StatusRequest"];
            $StatusDoc=$_POST["StatusDoc"];
            $CodeProject=$_POST["CodeProject"];
            $DateRequest=$_POST["DateRequest"];
            $EmailSales=$_POST["EmailSales"];
            $EmailRND=$_POST["EmailRND"];
            $NPDType=$_POST["NPDType"];
           // $CodeProject=$_POST["CodeProject"];
            $Prod_Name=$_POST["Prod_Name"];
            $CustName=$_POST["CustName"];
            $CustPhone=$_POST["CustPhone"];
            $DateFeedbackExp=$_POST["DateFeedbackExp"];
            $AppName=$_POST["AppName"];
            $PatternFiber=$_POST["PatternFiber"];
            $FrameName=$_POST["FrameName"];
            $SpecialSize=$_POST["SpecialSize"];
            $OtherLinkDrawing=$_POST["OtherLinkDrawing"];
            $GenifName=$_POST["GenifName"];
            $PackagingDetail=$_POST["PackagingDetail"];
            $Square=$_POST["Square"];
            $Budget=$_POST["Budget"];
            $Location=$_POST["Location"];
            $DateTarget=$_POST["DateTarget"];
            $ImportantRequest=$_POST["ImportantRequest"];
            $AppName=implode(",",$_POST["AppName"]);
            $FrameName=implode(",",$_POST["FrameName"]);
            $GenifName=implode(",",$_POST["GenifName"]);


      
            $sql="update tdocument 
            LEFT JOIN tapplications ON tdocument.NumDoc = tapplications.NumDoc
            LEFT JOIN tframedetail ON tdocument.NumDoc = tframedetail.NumDoc
            LEFT JOIN tgeninformation ON tdocument.NumDoc = tgeninformation.NumDoc 
            set
            tdocument.DateVerification='$DateVerification',
            tdocument.DateEstBOM='$DateEstBOM',
            tdocument.EmailFA='$EmailFA',
            tdocument.StatusRequest='$StatusRequest',
            tdocument.StatusDoc='$StatusDoc',
            tdocument.CodeProject='$CodeProject',
            tdocument.DateRequest='$DateRequest',
            tdocument.EmailSales='$EmailSales',
            tdocument.EmailRND='$EmailRND',
            tdocument.NPDType='$NPDType',
            tdocument.Prod_Name='$Prod_Name',
            tdocument.CustName='$CustName',
            tdocument.CustPhone='$CustPhone',
            tdocument.DateFeedbackExp='$DateFeedbackExp',
            tapplications.AppName='$AppName',
            tdocument.PatternFiber='$PatternFiber',
            tframedetail.FrameName='$FrameName',
            tdocument.SpecialSize='$SpecialSize',
            tdocument.OtherLinkDrawing='$OtherLinkDrawing',
            tgeninformation.GenifName='$GenifName',
            tdocument.PackagingDetail='$PackagingDetail',
            tdocument.Square='$Square',
            tdocument.Budget='$Budget',
            tdocument.Location='$Location',
            tdocument.DateTarget='$DateTarget',
            tdocument.ImportantRequest='$ImportantRequest'

            where tdocument.NumDoc='$NumDoc'";
                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
            
                                    if ($simpan_kelas) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=beranda-sales&edit=gagal");
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
                        $EmailFA=$_POST["EmailFA"];
                        $StatusRequest=$_POST["StatusRequest"];
                        $StatusDoc=$_POST["StatusDoc"];
                        $CodeProject=$_POST["CodeProject"];
                        $DateRequest=$_POST["DateRequest"];
                        $EmailSales=$_POST["EmailSales"];
                        $EmailRND=$_POST["EmailRND"];
                        $NPDType=$_POST["NPDType"];
                       // $CodeProject=$_POST["CodeProject"];
                        $Prod_Name=$_POST["Prod_Name"];
                        $CustName=$_POST["CustName"];
                        $CustPhone=$_POST["CustPhone"];
                        $DateFeedbackExp=$_POST["DateFeedbackExp"];
                        $AppName=$_POST["AppName"];
                        $PatternFiber=$_POST["PatternFiber"];
                        $FrameName=$_POST["FrameName"];
                        $SpecialSize=$_POST["SpecialSize"];
                        $OtherLinkDrawing=$_POST["OtherLinkDrawing"];
                        $GenifName=$_POST["GenifName"];
                        $PackagingDetail=$_POST["PackagingDetail"];
                        $Square=$_POST["Square"];
                        $Budget=$_POST["Budget"];
                        $Location=$_POST["Location"];
                        $DateTarget=$_POST["DateTarget"];
                        $ImportantRequest=$_POST["ImportantRequest"];
                        $AppName=implode(",",$_POST["AppName"]);
                        $FrameName=implode(",",$_POST["FrameName"]);
                        $GenifName=implode(",",$_POST["GenifName"]);
            
            
                  
                        $sql="update tdocument 
                        LEFT JOIN tapplications ON tdocument.NumDoc = tapplications.NumDoc
                        LEFT JOIN tframedetail ON tdocument.NumDoc = tframedetail.NumDoc
                        LEFT JOIN tgeninformation ON tdocument.NumDoc = tgeninformation.NumDoc 
                        set
                        tdocument.DateVerification='$DateVerification',
                        tdocument.DateEstBOM='$DateEstBOM',
                        tdocument.EmailFA='$EmailFA',
                        tdocument.StatusRequest='$StatusRequest',
                        tdocument.StatusDoc='$StatusDoc',
                        tdocument.CodeProject='$CodeProject',
                        tdocument.DateRequest='$DateRequest',
                        tdocument.EmailSales='$EmailSales',
                        tdocument.EmailRND='$EmailRND',
                        tdocument.NPDType='$NPDType',
                        tdocument.Prod_Name='$Prod_Name',
                        tdocument.CustName='$CustName',
                        tdocument.CustPhone='$CustPhone',
                        tdocument.DateFeedbackExp='$DateFeedbackExp',
                        tapplications.AppName='$AppName',
                        tdocument.PatternFiber='$PatternFiber',
                        tframedetail.FrameName='$FrameName',
                        tdocument.SpecialSize='$SpecialSize',
                        tdocument.OtherLinkDrawing='$OtherLinkDrawing',
                        tgeninformation.GenifName='$GenifName',
                        tdocument.PackagingDetail='$PackagingDetail',
                        tdocument.Square='$Square',
                        tdocument.Budget='$Budget',
                        tdocument.Location='$Location',
                        tdocument.DateTarget='$DateTarget',
                        tdocument.ImportantRequest='$ImportantRequest'
            
                        where tdocument.NumDoc='$NumDoc'";
                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
            
                                    if ($simpan_kelas) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=beranda-sales&edit=gagal");
                                    }
                    }
        }


    }else {
        echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
    }

    
    }


?>


<?php 
    include 'config/database.php';
    $NumDoc=$_GET['id'];
    $sql="select t1.NumDoc as a, t1.DateRequest as b, t1.update_date as ut, t1.NPDType as c, t1.NPDTypeName as d, t1.CodeProject as e,t1.Prod_Name as f, t1.CustName as g, t1.CustPhone as h, t1.DateFeedbackExp as i, t1.PatternFiber as j, t1.SpecialSize as k, t1.OtherLinkDrawing as l, t1.PackagingDetail as m, t1.Square as n, t1.Budget as o, t1.Location as p, t1.DateTarget as q, t1.ImportantRequest as r, t1.DateVerification as s, t1.DateEstBOM as t, t1.DateCosting as u, t1.DateClose as v, t1.EmailSales as w, t1.EmailRND as x, t1.EmailFA as y, t1.StatusRequest as z, t1.StatusDoc as aa, t2.AppName as ab, t3.FrameName as ac, t4.GenifName as ad from tdocument t1 left join tapplications t2 ON t1.NumDoc = t2.NumDoc left join tframedetail t3 ON t1.NumDoc = t3.NumDoc left join tgeninformation t4 ON t1.NumDoc = t4.NumDoc where t1.NumDoc='$NumDoc' limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
        $a = isset($data['a']) ? $data['a'] : '';
        $b = isset($data['b']) ? $data['b'] : '';
        $ut = isset($data['ut']) ? $data['ut'] : '';
        $c = isset($data['c']) ? $data['c'] : '';
        $d = isset($data['d']) ? $data['d'] : '';
        $e = isset($data['e']) ? $data['e'] : '';
        $f = isset($data['f']) ? $data['f'] : '';
        $g = isset($data['g']) ? $data['g'] : '';
        $h = isset($data['h']) ? $data['h'] : '';
        $i = isset($data['i']) ? $data['i'] : '';
        $j = isset($data['j']) ? $data['j'] : '';
        $k = isset($data['k']) ? $data['k'] : '';
        $l = isset($data['l']) ? $data['l'] : '';
        $m = isset($data['m']) ? $data['m'] : '';
        $n = isset($data['n']) ? $data['n'] : '';
        $o = isset($data['o']) ? $data['o'] : '';
        $p = isset($data['p']) ? $data['p'] : '';
        $q = isset($data['q']) ? $data['q'] : '';
        $r = isset($data['r']) ? $data['r'] : '';
        $s = isset($data['s']) ? $data['s'] : '';
        $t = isset($data['t']) ? $data['t'] : '';
        $u = isset($data['u']) ? $data['u'] : '';
        $v = isset($data['v']) ? $data['v'] : '';
        $w = isset($data['w']) ? $data['w'] : '';
        $x = isset($data['x']) ? $data['x'] : '';
        $y = isset($data['y']) ? $data['y'] : '';
        $z = isset($data['z']) ? $data['z'] : '';
        $aa = isset($data['aa']) ? $data['aa'] : '';
        $ab = isset($data['ab']) ? $data['ab'] : '';
        $ac = isset($data['ac']) ? $data['ac'] : '';
        $ad = isset($data['ad']) ? $data['ad'] : '';
        //$a = isset($data['a']) ? $data['a'] : '';
        $tanggal_request = $b;
        $tgl1 = date("Y-m-d", strtotime($tanggal_request)); 
        $tanggal_feedback = $i;
        $tgl2 = date("Y-m-d", strtotime($tanggal_feedback));
        $tanggal_target = $q;
        $tgl3 = date("Y-m-d", strtotime($tanggal_target));
        $tanggal_verifikasi = $s;
        $tgl4 = date("Y-m-d", strtotime($tanggal_verifikasi));
        $tanggal_update = $ut;
        $tgl5 = date("Y-m-d", strtotime($tanggal_update));
        //$datahobi=explode(',', $data['ab']);
        $datahobi= explode(', ', $data['ab']);
        $dataframe= explode(', ', $data['ac']);
        $datageneralinf= explode(', ', $data['ad']);

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="pages/sales/css/style.css">
	<link rel="stylesheet" href="pages/sales/css/bootstrap-datetimepicker.min.css">
    <title>Sales - Edit Request New Product</title>
  </head>
  <body>
  <div class="container" style="margin-top: 20px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              FORM REQUEST NEW PRODUCT
            </div>
            <div class="card-body">

<form action="pages/sales/edit-rnp/index.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Nomor <font color="red">* </font>:</label>
                <input type="text" name="NumDoc" value="<?php echo $a;?>" class="form-control" readonly>
                <!--<input type="hidden" name="CodeProject" value="-->
                <?php //echo $data['e'];?>
                <!--" class="form-control" required>-->
                <input type="hidden" name="subjek" value="Correction Request New Product Costing + CodeProject" class="form-control">
                <input type="hidden" name="pesan" value="" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Request Date <font color="red">* </font>:</label>
                <input type="text" name="DateRequest" value="<?php echo $tgl1;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Update Date <font color="red">* </font>:</label>
                <input type="text" value="<?php echo $tgl5;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Sales Mail <font color="red">* </font>:</label>
                <input type="text" name="EmailSales" value="<?php echo $w;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>NPD Mail <font color="red">* </font>:</label>
                <input type="text" name="EmailRND" value="<?php echo $x;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                <label>NPD Type <font color="red">* </font>:</label>
                <input type="text" name="NPDType" value="<?php echo $d;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Code Of Project <font color="red">* </font>:</label>
                <input type="text" name="CodeProject" value="<?php echo $e;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Product Name <font color="red">* </font>:</label>
                <input type="text" name="Prod_Name" value="<?php echo $f;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Customer Name <font color="red">* </font>:</label>
                <input type="text" name="CustName" value="<?php echo $g;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Customer Phone <font color="red">* </font>:</label>
                <input type="text" name="CustPhone" value="<?php echo $h;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Feedback Expetation Date <font color="red">* </font>:</label>
                <input type="text" name="DateFeedbackExp" value="<?php echo $tgl2;?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>App ID<font color="red">* </font>:</label>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <!--<input type="text" name="AppID" class="form-control" required>-->
                        
                        <p><input type="checkbox" name="AppName[]" value="Roofing Outdoor" <?php if (in_array("Roofing Outdoor", $datahobi)) echo "checked";?> /> Roofing Outdoor</p>
                        <p><input type="checkbox" name="AppName[]" value="Roofing Indoor" <?php if (in_array("Roofing Indoor", $datahobi)) echo "checked";?>/> Roofing Indoor</p>
                        <p><input type="checkbox" name="AppName[]" value="Surface Loose (outdoor)" <?php if (in_array("Surface Loose (outdoor)", $datahobi)) echo "checked";?>/> Surface Loose (outdoor)</p>
                        <p><input type="checkbox" name="AppName[]" value="Surface Loose (indoor)" <?php if (in_array("Surface Loose (indoor)", $datahobi)) echo "checked";?>/> Surface Loose (indoor)</p>
                        <p><input type="checkbox" name="AppName[]" value="Surface + backing (indoor)" <?php if (in_array("Surface + backing (indoor)", $datahobi)) echo "checked";?>/> Surface + backing (indoor)</p>
                        <p><input type="checkbox" name="AppName[]" value="Surface + frame (outdoor)" <?php if (in_array("Surface + frame (outdoor)", $datahobi)) echo "checked";?>/> Surface + frame (outdoor)</p>
                        <p><input type="checkbox" name="AppName[]" value="Surface + frame (indoor)" <?php if (in_array("Surface + frame (indoor)", $datahobi)) echo "checked";?>/> Surface + frame (indoor)</p>
                        <p><input type="checkbox" name="AppName[]" value="Handicraft (outdoor)" <?php if (in_array("Handicraft (outdoor)", $datahobi)) echo "checked";?>/> Handicraft (outdoor)</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="AppName[]" value="Handicraft (indoor)" <?php if (in_array("Handicraft (indoor)", $datahobi)) echo "checked";?> /> Handicraft (indoor)</p>
                        <p><input type="checkbox" name="AppName[]" value="Archineering Partition" <?php if (in_array("Archineering Partition", $datahobi)) echo "checked";?> /> Archineering Partition</p>  
                        <p><input type="checkbox" name="AppName[]" value="Archineering Facade" /> <?php if (in_array("Archineering Facade", $datahobi)) echo "checked";?>Archineering Facade</p>
                        <p><input type="checkbox" name="AppName[]" value="Archineering Ornament" <?php if (in_array("Archineering Ornament", $datahobi)) echo "checked";?>/> Archineering Ornament</p>
                        <p><input type="checkbox" name="AppName[]" value="Archineering Sculpture" <?php if (in_array("Archineering Sculpture", $datahobi)) echo "checked";?>/> Archineering Sculpture</p>
                        <p><input type="checkbox" name="AppName[]" value="Archineering (others)" <?php if (in_array("Archineering (others)", $datahobi)) echo "checked";?>/> Archineering (others)</p>
                        <p><input type="checkbox" name="AppName[]" value="Umbrella" <?php if (in_array("Umbrella", $datahobi)) echo "checked";?>/> Umbrella</p>
                        <p><input type="checkbox" name="AppName[]" value="Dome" <?php if (in_array("Dome", $datahobi)) echo "checked";?>/> Dome</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="AppName[]" value="Archineering Ceiling" <?php if (in_array("Archineering Ceiling", $datahobi)) echo "checked";?>/> Archineering Ceiling</p>
                        <p><input type="checkbox" name="AppName[]" value="Varyan Product" <?php if (in_array("Varyan Product", $datahobi)) echo "checked";?>/> Varyan Product</p>
                        <p><input type="checkbox" name="AppName[]" value="Viroforms Product" <?php if (in_array("Viroforms Product", $datahobi)) echo "checked";?>/> Viroforms Product</p>
                        <p><input type="checkbox" name="AppName[]" value="Special Application (request) - continue to detail of special applications requested" <?php if (in_array("Special Application (request) - continue to detail of special applications requested", $datahobi)) echo "checked";?>/> Special Application (request) - continue to detail of special applications requested</p>
                    </div>
                </div>
             </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Weaving Pattern & What Fiber <font color="red">* </font>:</label>
                <input type="text" name="PatternFiber" value="<?php echo $j;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Frame Detail <font color="red">* </font>:</label>
            </div>
        </div>
    </div>
    <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="FrameName[]" value="using alumunium frame" <?php if (in_array("using alumunium frame", $dataframe)) echo "checked";?>/> using alumunium frame</p>
                        <p><input type="checkbox" name="FrameName[]" value="using iron metal frame" <?php if (in_array("using iron metal frame", $dataframe)) echo "checked";?>/> using iron metal frame</p>  
                        <p><input type="checkbox" name="FrameName[]" value="hollo profile" <?php if (in_array("hollo profile", $dataframe)) echo "checked";?>/> hollo profile</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="FrameName[]" value="pipe profile" <?php if (in_array("pipe profile", $dataframe)) echo "checked";?>/> pipe profile</p>
                        <p><input type="checkbox" name="FrameName[]" value="standard size 40 x 40 cm" <?php if (in_array("standard size 40 x 40 cm", $dataframe)) echo "checked";?>/> standard size 40 x 40 cm</p>
                        <p><input type="checkbox" name="FrameName[]" value="Tidak menggunakan Frame" <?php if (in_array("Tidak menggunakan Frame", $dataframe)) echo "checked";?>/> Tidak menggunakan Frame</p>
                    </div>
                </div>
            </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Special Size <font color="red">* </font>:</label>
                <input type="text" name="SpecialSize" value="<?php echo $k;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Other Link of Drawing <font color="red">* </font>:</label>
                <input type="text" name="OtherLinkDrawing" value="<?php echo $l;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>General Information <font color="red">* </font>:</label>
            </div>
        </div>
    </div>
    <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="GenifName[]" value="Archineering Project" <?php if (in_array("Archineering Project", $datageneralinf)) echo "checked";?>/> Archineering Project</p>
                        <p><input type="checkbox" name="GenifName[]" value="Request for costing estimation" <?php if (in_array("Request for costing estimation", $datageneralinf)) echo "checked";?>/> Request for costing estimation</p>  
                        <p><input type="checkbox" name="GenifName[]" value="Request for design" <?php if (in_array("Request for design", $datageneralinf)) echo "checked";?>/> Request for design</p>
                        <p><input type="checkbox" name="GenifName[]" value="Request for prototyping" <?php if (in_array("Request for prototyping", $datageneralinf)) echo "checked";?>/> Request for prototyping</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="GenifName[]" value="Special request for packaging" <?php if (in_array("Special request for packaging", $datageneralinf)) echo "checked";?>/> Special request for packaging</p>
                        <p><input type="checkbox" name="GenifName[]" value="Special request for shipment" <?php if (in_array("Special request for shipment", $datageneralinf)) echo "checked";?>/> Special request for shipment</p>
                        <p><input type="checkbox" name="GenifName[]" value="Installation by client" <?php if (in_array("Installation by client", $datageneralinf)) echo "checked";?>/> Installation by client</p>
                        <p><input type="checkbox" name="GenifName[]" value="Installation by Viro" <?php if (in_array("Installation by Viro", $datageneralinf)) echo "checked";?>/> Installation by Viro</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <p><input type="checkbox" name="GenifName[]" value="Shipment by client" <?php if (in_array("Shipment by client", $datageneralinf)) echo "checked";?>/> Shipment by client</p>
                        <p><input type="checkbox" name="GenifName[]" value="Shipment by Viro" <?php if (in_array("Shipment by Viro", $datageneralinf)) echo "checked";?>/> Shipment by Viro</p>
                        <p><input type="checkbox" name="GenifName[]" value="Request for Exhibition or Event" <?php if (in_array("Request for Exhibition or Event", $datageneralinf)) echo "checked";?>/> Request for Exhibition or Event</p>
                    </div>
                </div>
            </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Packaging Detail <font color="red">* </font>:</label>
                <input type="text" name="PackagingDetail" value="<?php echo $m;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Square m2 (estimation) <font color="red">* </font>:</label>
                <input type="text" name="Square" value="<?php echo $n;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Budget Customer (Estimation) <font color="red">* </font>:</label>
                <input type="text" name="Budget" value="<?php echo $o;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Project Location <font color="red">* </font>:</label>
                <input type="text" name="Location" value="<?php echo $p;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Installation Target Date <font color="red">* </font>:</label>
                <input type="text" name="DateTarget" value="<?php echo $tgl3;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Important Request ( jika ada ... ) :</label>
                <input type="text" name="ImportantRequest" value="<?php echo $r;?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Date Verification<font color="red">* </font>:</label>
                <input type="date" name="DateVerification" value="" class="form-control">
                <input type="hidden" name="StatusRequest" value="NPD" class="form-control">
                <input type="hidden" name="StatusDoc" value="OPEN" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Date EstBOM<font color="red">* </font>:</label>
                <input type="text" name="DateEstBOM" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d");?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Email FA<font color="red">* </font>:</label>
                <input type="text" name="EmailFA" value="<?php echo $y;?>" class="form-control" placeholder="Masukan Email FA" required>
            </div>
        </div>
    </div>
    <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attached documents (write project's name on each file) :<font color="red">* </font>:</label>
                        <div class="card">
                        <div class="card-body">
                        <input type="file" name="attachment" class="form-control">
                        <input type="file" name="attachment1" class="form-control">
                        
                        <label><br>Note : agar attachment terkirim, tolong isi secara berurutan</label>
                    </div>
                    </div>
                </div>
             </div>
        </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="edit_kelas" id="Submit" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
