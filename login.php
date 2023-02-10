<?php 

    session_start();

    //Jika terdetesi ada session pengguna yang aktif, maka session tersebut di hapuskan

    if  (isset($_SESSION["username"])){

        session_unset();

        session_destroy();

    }

    

    $pesan="";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai

    function input($data) {

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;

    }

    //Cek apakah ada kiriman form dari method post

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

  

        include "config/database.php";

        //Mengambil uername dan password

        $username = input($_POST["username"]);

        $password = input(md5($_POST["password"]));

        $cek_tabel_sales = mysqli_query ($kon,"select * from sales where username='".$username."' and password='".$password."' limit 1");

        $sales = mysqli_num_rows($cek_tabel_sales);

        $cek_tabel_ppic = mysqli_query ($kon,"select * from ppic where username='".$username."' and password='".$password."' limit 1");

        $ppic = mysqli_num_rows($cek_tabel_ppic);


        $cek_tabel_admin = mysqli_query ($kon,"select * from admin where username='".$username."' and password='".$password."' limit 1");

        $admin = mysqli_num_rows($cek_tabel_admin);

        $cek_tabel_npd = mysqli_query ($kon,"select * from npd where username='".$username."' and password='".$password."' limit 1");

        $npd = mysqli_num_rows($cek_tabel_npd);

        $cek_tabel_fa = mysqli_query ($kon,"select * from fa where username='".$username."' and password='".$password."' limit 1");

        $fa = mysqli_num_rows($cek_tabel_fa);


        $cek_tabel_admin_sales = mysqli_query ($kon,"select * from admin_sales where username='".$username."' and password='".$password."' limit 1");

        $admin_sales = mysqli_num_rows($cek_tabel_admin_sales);





        //jika rememberme di klik

        if(!empty($_POST["remember"])) {

          //buat cookie

          setcookie ("username",$_POST["username"],time()+ (3600 * 365 * 24 * 60 * 60));

          setcookie ("password",$_POST["password"],time()+ (3600 * 365 * 24 * 60 * 60));

        } else {

          if(isset($_COOKIE["username"])) {

          setcookie ("username","");

          }

          if(isset($_COOKIE["password"])) {

          setcookie ("password","");

          }

        }



        //Kondisi jika pengguna merupakan sales

        if ($sales>0){

            $row = mysqli_fetch_assoc($cek_tabel_sales);

            //menyimpan data sales dalam session

            $_SESSION["username"]=$row["username"];

            $_SESSION["id_sales"]=$row["id_sales"];

            $_SESSION["kode_sales"]=$row["kode_sales"];



            header("Location:index.php?page=beranda");

        } else if ($npd>0){



          $row = mysqli_fetch_assoc($cek_tabel_npd);

          //menyimpan data admin dalam session

          $_SESSION["username"]=$row["username"];

          $_SESSION["id_npd"]=$row["id_npd"];

          $_SESSION["kode_npd"]=$row["kode_npd"];



          header("Location:index.php?page=beranda");

      }else if ($fa>0){



        $row = mysqli_fetch_assoc($cek_tabel_fa);

        //menyimpan data admin dalam session

        $_SESSION["username"]=$row["username"];

        $_SESSION["id_fa"]=$row["id_fa"];

        $_SESSION["kode_fa"]=$row["kode_fa"];



        header("Location:index.php?page=beranda");

    }else if ($admin>0){



          $row = mysqli_fetch_assoc($cek_tabel_admin);

          //menyimpan data admin dalam session

          $_SESSION["username"]=$row["username"];

          $_SESSION["id_admin"]=$row["id_admin"];

          $_SESSION["kode_admin"]=$row["kode_admin"];



          header("Location:index.php?page=beranda");

      } else if ($ppic>0){



            $row = mysqli_fetch_assoc($cek_tabel_ppic);

            //menyimpan data ppic dalam session

            $_SESSION["username"]=$row["username"];

            $_SESSION["id_ppic"]=$row["id_ppic"];

            $_SESSION["kode_ppic"]=$row["kode_ppic"];



            header("Location:index.php?page=beranda");

        }else if ($admin_sales>0){



          $row = mysqli_fetch_assoc($cek_tabel_admin_sales);

          //menyimpan data ppic dalam session

          $_SESSION["username"]=$row["username"];

          $_SESSION["id_admin_sales"]=$row["id_admin_sales"];

          $_SESSION["kode_admin_sales"]=$row["kode_admin_sales"];



          header("Location:index.php?page=beranda");

      }
         else {

            $pesan="<div class='alert alert-danger'><strong>Error!</strong> Username dan password salah.</div>";

        }

	}

?>



<!DOCTYPE html>

<html lang="en">

<head>

  <title>Login</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>



<?php 

include 'config/database.php';

$hasil = mysqli_query($kon,"select * from aplikasi limit 1");

$aplikasi = mysqli_fetch_array($hasil); 



?>



  <div class="container">

    <div class="row justify-content-center mt-5">

      <div class="col-md-4">

        <div class="card">

          <div class="card-header bg-transparent mb-0"><h5 class="text-center"><?php echo $aplikasi['nama_aplikasi'];?></h5></div>

          <div class="card-body">
	

          <?php 	if ($_SERVER["REQUEST_METHOD"] == "POST") echo $pesan; ?>

          <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

              <div class="form-group">

                <input type="text" name="username" class="form-control" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" placeholder="Username">

              </div>

              <div class="form-group">

                <input type="password" name="password" class="form-control" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="Password">

              </div>

              <div class="form-group custom-control custom-checkbox">

                <input type="checkbox" class="custom-control-input"  name="remember" id="remember"  >

                <label class="custom-control-label" for="remember">Remember me</label>

              </div>

              <div class="form-group">
<?php

            //Validasi untuk menampilkan pesan pemberitahuan saat user menambah siswa

            if (isset($_GET['tambah'])) {

                if ($_GET['tambah']=='berhasil'){

                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data telah ditambah!</div>";

                }else if ($_GET['tambah']=='gagal'){

                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data gagal ditambahkan!</div>";

                }    

            }
?>


    <input type="submit" name="" value="login" class="btn btn-primary btn-block">
		<!--<button type="button" class="btn btn-success btn-block" onclick="location.href='daftar.php'">Signup</button>-->
              </div>

            </form>

          </div>
          

        </div>

      </div>

    </div>
   
  </div>

  <div class="modal fade" id="modal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



        <div class="modal-header">

            <h4 class="modal-title" id="judul"></h4>

            <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>



        <div class="modal-body">

            <div id="tampil_data">

                 <!-- Data akan di load menggunakan AJAX -->                   

            </div>  

        </div>

  

        <div class="modal-footer">

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>



        </div>

    </div>

</div>



</body>

</html>
<script>



    $(document).ready( function () {

        $('#tabel_siswa').DataTable();

    });



    // Tambah siswa

    $('#btn_tambah').on('click',function(){

        $.ajax({

            url: 'tambah.php',

            method: 'post',

            success:function(data){

                $('#tampil_data').html(data);  

                document.getElementById("judul").innerHTML='Form Registrasi Peserta Ujian';

            }

        });

        // Membuka modal

        $('#modal').modal('show');

    });

</script>


