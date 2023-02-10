<?php

    if (isset($_POST['edit_mapel'])) {
        
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

            $NumDoc         =$_POST["NumDoc"];
            $StatusRequest  =$_POST["StatusRequest"];
            $StatusDoc      =$_POST["StatusDoc"];
            //$DateVerification=$_POST["DateVerification"];
      
            $sql="update tdocument set
            NumDoc='$NumDoc',
            StatusRequest='$StatusRequest',
            StatusDoc='$StatusDoc'
            where NumDoc='$NumDoc'";
        
            //Menyimpan ke tabel mapel
            $simpan_mapel=mysqli_query($kon,$sql);

            if ($simpan_mapel) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../../index.php?page=beranda-sales&edit=gagal");
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
?>

<form action="pages/sales/beranda/edit.php" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" name="NumDoc" value="<?php echo $data['NumDoc'];?>" class="form-control" readonly >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Status Request:</label>
                <input type="text" name="StatusRequest" value="<?php echo $data['StatusRequest'];?>" class="form-control" placeholder="Masukan Data" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Status Doc:</label>
                <!--<input type="text" name="StatusDoc" value="<?php echo $data['StatusDoc'];?>" class="form-control" placeholder="Masukan Data" required>-->
                <select class="form-control" name="StatusDoc">
                    <option value="OPEN">OPEN</option>
                    <option value="CLOSE">CLOSE</option>
                    <option value="CORRECTED">CORRECTED</option>
                    <option value="ORDER">ORDER</option>
                </select>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="edit_mapel" id="Submit" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>