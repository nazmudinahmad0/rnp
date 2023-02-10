<?php

    //PHP MAILER START

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Include librari phpmailer
    include('phpmailer/Exception.php');
    include('phpmailer/PHPMailer.php');
    include('phpmailer/SMTP.php');

    $email_pengirim = 'finance-accounting@virobuild.com'; // Isikan dengan email pengirim
    $nama_pengirim = 'Team FA'; // Isikan dengan nama pengirim
    $email_penerima = isset($_POST['EmailRND']) ? $_POST['EmailRND']:''; // Ambil email penerima dari inputan form
    $email_penerima1 = isset($_POST['EmailSales']) ? $_POST['EmailSales']:''; // Ambil email penerima dari inputan form
    $subjek = isset($_POST['subjek']) ? $_POST['subjek']:''; // Ambil subjek dari inputan form
    //$pesan = isset($_POST['pesan']) ? $_POST['pesan']:''; // Ambil subjek dari inputan form
    $code_pro = isset($_POST['CodeProject']) ? $_POST['CodeProject']:''  ; // Ambil pesan dari inputan form
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

            $sql="update tdocument set
            NumDoc='$NumDoc',
            DateCosting='$DateCosting'
            where NumDoc='$NumDoc'";
        
            //Menyimpan ke tabel kelas
            $simpan_kelas=mysqli_query($kon,$sql);

            if ($simpan_kelas) {
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
            
                
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateCosting='$DateCosting'
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
            
                
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateCosting='$DateCosting'
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
            
                
                        $sql="update tdocument set
                        NumDoc='$NumDoc',
                        DateCosting='$DateCosting'
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

?>

<?php 
    include '../../../config/database.php';
    $NumDoc=$_POST["NumDoc"];
    $sql="select * from tdocument where NumDoc='$NumDoc' limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
        $tanggal_request = $data['DateRequest'];
        $tgl1 = date("d M Y", strtotime($tanggal_request)); 
        $tanggal_feedback = $data['DateFeedbackExp'];
        $tgl2 = date("d M Y", strtotime($tanggal_feedback));
?>

<form action="pages/fa/beranda/edit-rnp.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nomor :</label>
                <input type="text" name="NumDoc" value="<?php echo $data['NumDoc'];?>" class="form-control" readonly>
                <input type="hidden" name="CodeProject" value="<?php echo $data['CodeProject'];?>" class="form-control" required>
                <input type="hidden" name="subjek" value="Request New Product Costing + CodeProject" class="form-control">
                <input type="hidden" name="pesan" value="" class="form-control">
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
                <input type="text" value="<?php echo $data['EmailSales'];?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>NPD Mail :</label>
                <input type="text" value="<?php echo $data['EmailRND'];?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>NPD Type :</label>
                <input type="text" value="<?php echo $data['NPDTypeName'];?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Code Of Project :</label>
                <input type="text" value="<?php echo $data['CodeProject'];?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Product Name :</label>
                <input type="text" value="<?php echo $data['Prod_Name'];?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Customer Name :</label>
                <input type="text" value="<?php echo $data['CustName'];?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Customer Phone :</label>
                <input type="text" value="<?php echo $data['CustPhone'];?>" class="form-control" readonly>
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
                <input type="text" value="<?php echo $tgl2;?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Costing Date<font color="red">* </font>:</label>
                <input type="text" name="DateCosting" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Email NPD<font color="red">* </font>:</label>
                <input type="text" name="EmailRND" value="<?php echo $data['EmailRND'];?>" class="form-control" placeholder="Masukan Tanggal Costing" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Email Sales<font color="red">* </font>:</label>
                <input type="text" name="EmailSales" value="<?php echo $data['EmailSales'];?>" class="form-control" placeholder="Masukan Tanggal Costing" required>
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
















