<?php

    //PHP MAILER START
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Include librari phpmailer
    include('phpmailer/Exception.php');
    include('phpmailer/PHPMailer.php');
    include('phpmailer/SMTP.php');

    $email_pengirim = 'finance-accounting@virobuild.com'; // Isikan dengan email pengirim
    $nama_pengirim = 'Team FA'; // Isikan dengan nama pengirim
    $email_penerima = isset($_POST['EmailRND']) ? $_POST['EmailRND']:''; // Ambil email penerima dari inputan form
    $email_penerima1 = isset($_POST['EmailMKT']) ? $_POST['EmailMKT']:''; // Ambil email penerima dari inputan form
    $subjek = isset($_POST['subjek']) ? $_POST['subjek']:''; // Ambil subjek dari inputan form
    //$pesan = isset($_POST['pesan']) ? $_POST['pesan']:''; // Ambil subjek dari inputan form
    //$code_pro = isset($_POST['Prod_Name']) ? $_POST['Prod_Name']:''  ; // Ambil pesan dari inputan form
    $code_pro = isset($_POST['CodeProject']) ? $_POST['CodeProject']:''  ; // Ambil pesan dari inputan form
    $pro_name = isset($_POST['Prod_Name']) ? $_POST['Prod_Name']:''  ; // Ambil pesan dari inputan form
    $Comment  = isset($_POST['Comment']) ? $_POST['Comment']:''  ;
    //$code_pro = $_POST['CodeProject'];
    $attachment  = isset($_FILES['attachment']['name']) ? $_FILES['attachment']['name'] : ''; // Ambil nama file yang di upload
    $attachment1  = isset($_FILES['attachment1']['name']) ? $_FILES['attachment1']['name'] : ''; // Ambil nama file yang di upload

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
    $mail->addAddress($email_penerima1, '');
    $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

    // Load file content.php
    ob_start();
    include "content.php";

    $content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
    ob_end_clean();

    $mail->Subject = $subjek;
    $mail->Body = $content;
    $mail->AddEmbeddedImage('image/viro-logo.png', 'logo_viro', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email

    if(empty($attachment) AND empty($attachment1) ){
        
        $send = $mail->send();



    if (isset($_POST['edit_kelas'])) {
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        //function input($data) {
        //    $data = trim($data);
        //    $data = stripslashes($data);
        //    $data = htmlspecialchars($data);
        //    return $data;
        //}

        //Cek apakah ada kiriman form dari method post
        if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {

            include '../../../config/database.php';
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");
            
            $NumDoc=$_POST["NumDoc"];
            $DateCosting=$_POST["DateCosting"];
            $StatusRequest =$_POST["StatusRequest"];
            $StatusDoc =$_POST["StatusDoc"];
            $EmailRND =$_POST["EmailRND"];
            $EmailMKT =$_POST["EmailMKT"];

            $sql="update tdocument set
            NumDoc='$NumDoc',
            DateCosting='$DateCosting',
            StatusRequest='$StatusRequest',
            StatusDoc='$StatusDoc',
            EmailRND='$EmailRND',
            EmailMKT='$EmailMKT'
            where NumDoc='$NumDoc'";
        
            //Menyimpan ke tabel kelas
            $simpan_kelas=mysqli_query($kon,$sql);

            if ($simpan_kelas) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../../index.php?page=index-rnp-fa&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../../index.php?page=index-rnp-fa&edit=gagal");
            }
        }
    }
    }
    elseif (($attachment) AND empty($attachment1)){
        $tmp = $_FILES['attachment']['tmp_name'];
        $size = $_FILES['attachment']['size'];
    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment);
        $send = $mail->send();

        if (isset($_POST['edit_kelas'])) 
        {
        
            //Fungsi untuk mencegah inputan karakter yang tidak sesuai
                    // function input($data) {
                    //     $data = trim($data);
                    //    $data = stripslashes($data);
                    //    $data = htmlspecialchars($data);
                    //    return $data;
                    //}
    
                    //Cek apakah ada kiriman form dari method post
                    if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {
            
                        include '../../../config/database.php';
                        //Memulai transaksi
                        mysqli_query($kon,"START TRANSACTION");
                        
                        $NumDoc=$_POST["NumDoc"];
                        $DateCosting=$_POST["DateCosting"];
                        $StatusRequest =$_POST["StatusRequest"];
                        $StatusDoc =$_POST["StatusDoc"];
                        $EmailRND =$_POST["EmailRND"];
                        $EmailMKT =$_POST["EmailMKT"];
            
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateCosting='$DateCosting',
                        StatusRequest='$StatusRequest',
                        StatusDoc='$StatusDoc',
                        EmailRND='$EmailRND',
                        EmailMKT='$EmailMKT'
                        where NumDoc='$NumDoc'";
                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
            
                                    if ($simpan_kelas) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=index-rnp-fa&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=index-rnp-fa&edit=gagal");
                                    }
                    }
        }


    }else {
        echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
    }
    }

    //kondisi 3

    elseif ( empty($attachment) AND ($attachment1)){
        $tmp = $_FILES['attachment1']['tmp_name'];
        $size = $_FILES['attachment1']['size'];
    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment1);
        $send = $mail->send();

        if (isset($_POST['edit_kelas'])) 
        {
        
            //Fungsi untuk mencegah inputan karakter yang tidak sesuai
                    // function input($data) {
                    //     $data = trim($data);
                    //    $data = stripslashes($data);
                    //    $data = htmlspecialchars($data);
                    //    return $data;
                    //}
    
                    //Cek apakah ada kiriman form dari method post
                    if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {
            
                        include '../../../config/database.php';
                        //Memulai transaksi
                        mysqli_query($kon,"START TRANSACTION");
                        
                        $NumDoc=$_POST["NumDoc"];
                        $DateCosting=$_POST["DateCosting"];
                        $StatusRequest =$_POST["StatusRequest"];
                        $StatusDoc =$_POST["StatusDoc"];
                        $EmailRND =$_POST["EmailRND"];
                        $EmailMKT =$_POST["EmailMKT"];
            
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateCosting='$DateCosting',
                        StatusRequest='$StatusRequest',
                        StatusDoc='$StatusDoc',
                        EmailRND='$EmailRND',
                        EmailMKT='$EmailMKT'
                        where NumDoc='$NumDoc'";
                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
            
                                    if ($simpan_kelas) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=index-rnp-fa&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=index-rnp-fa&edit=gagal");
                                    }
                    }
        }


    }else {
        echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
    }

    
    }



    #kondisi 4

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
        
            //Fungsi untuk mencegah inputan karakter yang tidak sesuai
                    // function input($data) {
                    //     $data = trim($data);
                    //    $data = stripslashes($data);
                    //    $data = htmlspecialchars($data);
                    //    return $data;
                    //}
    
                    //Cek apakah ada kiriman form dari method post
                    if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {
            
                        include '../../../config/database.php';
                        //Memulai transaksi
                        mysqli_query($kon,"START TRANSACTION");
                        
                        $NumDoc=$_POST["NumDoc"];
                        $DateCosting=$_POST["DateCosting"];
                        $StatusRequest =$_POST["StatusRequest"];
                        $StatusDoc =$_POST["StatusDoc"];
                        $EmailRND =$_POST["EmailRND"];
                        $EmailMKT =$_POST["EmailMKT"];
            
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateCosting='$DateCosting',
                        StatusRequest='$StatusRequest',
                        StatusDoc='$StatusDoc',
                        EmailRND='$EmailRND',
                        EmailMKT='$EmailMKT'
                        where NumDoc='$NumDoc'";
                    
                        //Menyimpan ke tabel kelas
                        $simpan_kelas=mysqli_query($kon,$sql);
            
                                    if ($simpan_kelas) {
                                        mysqli_query($kon,"COMMIT");
                                        header("Location:../../../index.php?page=index-rnp-fa&edit=berhasil");
                                    }
                                    else {
                                        mysqli_query($kon,"ROLLBACK");
                                        header("Location:../../../index.php?page=index-rnp-fa&edit=gagal");
                                    }
                    }
        }


    }else {
        echo "<h1>Ukuran file attachment maksimal 25 MB</h1><br /><a href='index.php'>Kembali ke Form</a>";
    }

    
    }

    $send = $mail->send();
    
        if (isset($_POST['edit_data'])) {

        //Cek apakah ada kiriman form dari method post
        if ($send AND $_SERVER["REQUEST_METHOD"] == "POST") {

            include '../../../config/database.php';
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");
            
            $NumDoc=$_POST["NumDoc"];
            //$Comment=$_POST["Comment"];
            $Comment  = isset($_POST['Comment']) ? $_POST['Comment']:''; //ambil comment dari form inputan
            $StatusReturn=$_POST["StatusReturn"];
            $StatusDoc=$_POST["StatusDoc"];
            $DateComment=$_POST["DateComment"];
            $Dept=$_POST["Dept"];
            $sqlupdate="update tdocument set
                        StatusRequest='$StatusReturn',
                        StatusDoc='$StatusDoc'
                        where NumDoc='$NumDoc'";

            $sql = "INSERT INTO thistorycomment (NumDoc,Comment,DateComment,Dept) VALUES ('$NumDoc','$Comment','$DateComment','$Dept')";
        
            //Menyimpan ke tabel kelas
            $simpan_data=mysqli_query($kon,$sqlupdate);
            $simpan_kelas=mysqli_query($kon,$sql);

            if ($simpan_kelas AND $simpan_data) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../../index.php?page=index-rnp-fa&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../../index.php?page=index-rnp-fa&edit=gagal");
            }
        }
    }

?>

<?php 
    include '../../../config/database.php';
    $NumDoc=$_POST["NumDoc"];
    $sql="select t1.NumDoc as a, t1.DateRequest as b, t1.NPDTypeName as c, t1.NPDTypeName as d, t1.CodeProject as e,t1.Prod_Name as f, t1.CustName as g, t1.CustPhone as h, t1.DateFeedbackExp as i, t1.PatternFiber as j, t1.SpecialSize as k, t1.OtherLinkDrawing as l, t1.PackagingDetail as m, t1.Square as n, t1.Budget as o, t1.Location as p, t1.DateTarget as q, t1.ImportantRequest as r, t1.DateVerification as s, t1.DateEstBOM as t, t1.DateCosting as u, t1.DateClose as v, t1.EmailSales as w, t1.EmailRND as x, t1.EmailFA as y, t1.StatusRequest as z, t1.StatusDoc as aa, t2.AppName as ab, t3.FrameName as ac, t4.GenifName as ad from tdocument t1 left join tapplications t2 ON t1.NumDoc = t2.NumDoc left join tframedetail t3 ON t1.NumDoc = t3.NumDoc left join tgeninformation t4 ON t1.NumDoc = t4.NumDoc where t1.NumDoc='$NumDoc' limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
    $a = isset($data['a']) ? $data['a'] : '';
    $b = isset($data['b']) ? $data['b'] : '';
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
    $tgl1 = date("d M Y", strtotime($tanggal_request)); 
    $tanggal_feedback = $i;
    $tgl2 = date("d M Y", strtotime($tanggal_feedback));
    $tanggal_target = $q;
    $tgl3 = date("d M Y", strtotime($tanggal_target));
    $tanggal_verifikasi = $s;
    $tgl4 = date("d M Y", strtotime($tanggal_verifikasi));
    $tanggal_estimasi = $t;
    $tgl5 = date("d M Y", strtotime($tanggal_estimasi));
?>

<form action="pages/fa/beranda/edit-rnp.php" method="post" enctype="multipart/form-data">
<div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nomor :</label>
                <input type="text" name="NumDoc" value="<?php echo $a;?>" class="form-control" readonly>
                <input type="hidden" name="CodeProject" value="<?php echo $data['e'];?>" class="form-control" required>
                <input type="hidden" name="subjek" value="Request New Product Costing + CodeProject" class="form-control">
                <input type="hidden" name="pesan" value="" class="form-control">
                <input type="hidden" name="StatusRequest" value="SALES" class="form-control">
                <input type="hidden" name="StatusReturn" value="NPD" class="form-control">
                <input type="hidden" name="StatusDoc" value="OPEN" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Request Date :</label>
                <input type="text" value="<?php echo $tgl1;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Sales Mail :</label>
                <input type="text" value="<?php echo $w;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>NPD Mail :</label>
                <input type="text" value="<?php echo $x;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>NPD Type :</label>
                <input type="text" value="<?php echo $c;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Code Of Project :</label>
                <input type="text" value="<?php echo $e;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Product Name :</label>
                <input type="text" name = "Prod_Name" value="<?php echo $f;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Customer Name :</label>
                <input type="text" value="<?php echo $g;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Customer Phone :</label>
                <input type="text" value="<?php echo $h;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Feedback Expetation Date :</label>
                <input type="text" value="<?php echo $tgl2;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>App ID :</label>
                <textarea class="form-control" readonly><?php echo $ab;?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Weaving Pattern & What Fiber :</label>
                <input type="text" value="<?php echo $j;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Frame Detail :</label>
                <textarea class="form-control" readonly><?php echo $ac;?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Special Size :</label>
                <input type="text" value="<?php echo $k;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Other Link of Drawing :</label>
                <input type="text" value="<?php echo $l;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>General Information :</label>
                <textarea class="form-control" readonly><?php echo $ad;?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Packaging Detail :</label>
                <input type="text" value="<?php echo $m;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Square m2 (estimation) :</label>
                <input type="text" value="<?php echo $n;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Budget Customer (Estimation) :</label>
                <input type="text" value="<?php echo $o;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Project Location :</label>
                <input type="text" value="<?php echo $p;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Installation Target Date :</label>
                <input type="text" value="<?php echo $tgl3;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Important Request ( jika ada ... ) :</label>
                <input type="text" value="<?php echo $r;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Date Verification :</label>
                <input type="text" value="<?php echo $tgl4;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Date EstBOM :</label>
                <input type="text" value="<?php echo $tgl5;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Costing Date<font color="red">* </font>:</label>
                <input type="text" name="DateCosting" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("d M Y");?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Email NPD<font color="red">* </font>:</label>
                <input type="text" name="EmailRND" value="<?php echo $x;?>" class="form-control" placeholder="Masukan Email NPD" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Email Sales<font color="red">* </font>:</label>
                <input type="text" name="EmailMKT" value="<?php echo $w;?>" class="form-control" placeholder="Masukan Email Sales" required>
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
            <!--<button type="submit" name="edit_kelas" id="Submit" class="btn btn-warning">Update</button>-->

            <?php
            if ($aa == 'OPEN' AND $z == 'FA') {
                echo '<button type="submit" name="edit_kelas" id="Submit" class="btn btn-warning">Update</button>';
            }
            else {
                echo '<button type="button" name="edit_kelas" id="Submit" class="btn btn-warning" disabled>Update</button>';
            }

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Comment :</label>
                <textarea name="Comment" class="form-control"></textarea>
                <input type="hidden" name="DateComment" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d");?>" class="form-control" >
                <input type="hidden" name="Dept" value="FA" class="form-control">
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">

            <?php 
                if ($aa == 'OPEN' AND $z == 'FA') {
                    echo '<button type="submit" name="edit_data" id="Submit" class="btn btn-success">Return</button>';
                }
                else {
                    echo '<button type="button" name="edit_data" id="Submit" class="btn btn-success" disabled>Return</button>';
                }
            ?>

             
        </div>
    </div>
</form>
















