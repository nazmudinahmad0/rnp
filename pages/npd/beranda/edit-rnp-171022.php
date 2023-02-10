<?php

    if (isset($_POST['edit_kelas'])) {
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            include '../../../config/database.php';
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");
            
            $NumDoc=input($_POST["NumDoc"]);
            $DateVerification=input($_POST["DateVerification"]);
            $DateEstBOM=input($_POST["DateEstBOM"]);
            $EmailFA=input($_POST["EmailFA"]);

      
            $sql="update tdocument set
            NumDoc='$NumDoc',
            DateVerification='$DateVerification',
            DateEstBOM='$DateEstBOM',
            EmailFA='$EmailFA'
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

<form action="pages/npd/beranda/edit-rnp.php" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nomor :</label>
                <input type="text" name="NumDoc" value="<?php echo $data['NumDoc'];?>" class="form-control" readonly>
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
                <label>Date Verification<font color="red">* </font>:</label>
                <input type="date" name="DateVerification" value="<?php echo $data['DateVerification'];?>" class="form-control" placeholder="Masukan Tanggal Verifikasi" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Date EstBOM<font color="red">* </font>:</label>
                <input type="date" name="DateEstBOM" value="<?php echo $data['DateEstBOM'];?>" class="form-control" placeholder="Masukan Tanggal Estimasi BOM" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Email FA<font color="red">* </font>:</label>
                <input type="text" name="EmailFA" value="<?php echo $data['EmailFA'];?>" class="form-control" placeholder="Masukan Email FA" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="edit_kelas" id="Submit" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>















