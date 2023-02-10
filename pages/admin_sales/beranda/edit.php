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

            $id_so=input($_POST["id_so"]);
            $date_so=input($_POST["date_so"]);
      
            $sql="update sales_order set
            DateSO='$date_so'
            where NoPI=$id_so";
        
            //Menyimpan ke tabel kelas
            $simpan_kelas=mysqli_query($kon,$sql);

            if ($simpan_kelas) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../../index.php?page=admin_sales&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../../index.php?page=admin_sales&edit=gagal");
            }
        }
    }
?>

<?php 
    include '../../../config/database.php';
    $id_kelas=$_POST["id_kelas"];
    $sql="select * from kelas where id_kelas=$id_kelas limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
?>

<form action="pages/admin/kelas/edit.php" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="hidden" name="id_kelas" value="<?php echo $data['id_kelas'];?>" class="form-control" >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="nama_kelas" value="<?php echo $data['nama_kelas'];?>" class="form-control" placeholder="Masukan Nama Kelas" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="edit_kelas" id="Submit" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>