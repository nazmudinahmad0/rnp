<?php
    
    include '../../../config/database.php';

    if (isset($_POST['edit_rnp'])) {

        session_start();

     

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

           // $nilai = isset ($array['index_array']) ? $array['index_array']:'';

            $NumDoc= isset($_SESSION["NumDoc"]) ? $_SESSION['NumDoc']:'';
            

            $DateVerification   =isset($_POST["DateVerification"]) ? $_POST["DateVerification"]:'';

            $tanggal            = date("Y-m-d", strtotime($DateVerification));

            //$DateEstBOM         =input($_POST["DateEstBOM"]);
            $DateEstBOM   =isset($_POST["DateEstBOM"]) ? $_POST["DateEstBOM"]:'';

            //$EmailFA            =input($_POST["EmailFA"]);
            $EmailFA   =isset($_POST["EmailFA"]) ? $_POST["EmailFA"]:'';

            $sql="UPDATE tdocument SET

            DateVerification='$tanggal',

            DateEstBOM='$DateEstBOM',

            EmailFA='$EmailFA'

            WHERE NumDoc='$NumDoc'";

        
            //Menyimpan ke tabel tdocument
            $simpan_data=mysqli_query($kon,$sql);

            if ($simpan_data) {

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

    $NumDoc=$_POST["NumDoc"];

    $sql="select * from tdocument t1 INNER JOIN tapplications t2 ON t1.NumDoc = t2.NumDoc INNER JOIN tframedetail t3 ON t1.NumDoc=t3.NumDoc INNER JOIN tgeninformation t4 ON t1.NumDoc = t4.NumDoc where t1.NumDoc='$NumDoc' limit 1";

    $hasil=mysqli_query($kon,$sql);

    $row = mysqli_fetch_array($hasil); 

?>


<form action="pages/npd/beranda/edit-rnp.php" method="post">

    <div class="row">

        <div class="col-sm-12">

            <div class="form-group">

                <label>Nomor:</label>

                <input type="text" value="<?php echo $row['NumDoc'];?>" class="form-control" >

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-sm-12">

            <div class="form-group">

                <label>Verification:</label>
                <input type="text" name="DateVerification" class="form-control"  required>
                

            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Estimated BOM Date<font color="red">* </font></label>
                <input type="text" name="DateEstBOM" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d");?>" class="form-control" readonly >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Email FA</label>
                <input type="text" name="EmailFA" class="form-control" placeholder="Masukan Email FA" required>
            </div>
        </div>
    </div>
    
    <div class="row">

        <div class="col-sm-4">

            <button type="submit" name="edit_rnp" id="Submit" class="btn btn-primary">Submit</button>

        </div>

    </div>

</form>