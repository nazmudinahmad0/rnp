<?php
session_start();
    if (isset($_POST['edit_PI'])) {
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            include('koneksi.php');
            //Memulai transaksi
            mysqli_query($connection,"START TRANSACTION");

            $DatePI=input($_POST["DatePI"]);
            
                $sql="update proforma_inv set
                DatePI='$DatePI'
                where NoPI=$NoPI";
           

            //Menyimpan ke tabel PI
            $simpan_PI=mysqli_query($connection,$sql);

            if ($simpan_PI) {
                mysqli_query($connection,"COMMIT");
                header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
            }
            else {
                mysqli_query($connection,"ROLLBACK");
                header("Location:../../../index.php?page=beranda-sales&edit=berhasil");
            }
        }
    }
?>

<?php 
    include('koneksi.php');
    $NoPI=$_POST["NoPI"];
    $sql="select * from proforma_inv where NoPI='$NoPI' limit 1";
    $hasil=mysqli_query($connection,$sql);
    $data = mysqli_fetch_array($hasil); 
?>


<form action="pages/sales/beranda/edit.php" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
            <label>Date PI</label>
                <input type="text" name="DatePI" value="<?php echo $data['DatePI'];?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="edit_PI" id="Submit" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>

