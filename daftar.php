<?php
    include 'config/helper.php';
    if (isset($_POST['tambah_siswa'])) {

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {

            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;

        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            include 'config/database.php';

            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $nama       = input($_POST["nama"]);
            $email      = input($_POST["email"]);
            $alamat     = input($_POST["alamat"]);
	        $kelas      = input($_POST["kelas"]);
            $username   = input($_POST["nama"]);
	        $password   = input(md5("1234"));

            $query      = mysqli_query($kon, "SELECT max(id_siswa) AS id_terbesar FROM siswa");
            $ambil      = mysqli_fetch_array($query);
            $id_siswa   = $ambil['id_terbesar'];
            $id_siswa++;

            //Membuat kode siswa
            $huruf = "G";
            $kode_siswa = $huruf . sprintf("%03s", $id_siswa);

            //Sql jika tidak menggunakan foto, maka akan memakai gambar_default.png

            $foto   = "foto_default.png";

            $sql    = "INSERT INTO siswa (kode_siswa,nama_siswa,id_kelas,email,alamat,foto,username,password) VALUES

            ('$kode_siswa','$nama','$kelas','$email','$alamat','$foto','$username','$password')";


            //Menyimpan ke tabel siswa
            $simpan_siswa   =   mysqli_query($kon, $sql);

            if ($simpan_siswa) {

                mysqli_query($kon,"COMMIT");

                $cek_tabel_siswa = mysqli_query($kon,"SELECT * FROM siswa WHERE username='".$username."' AND password='".$password."' LIMIT 1");

                $siswa = mysqli_num_rows($cek_tabel_siswa);

                if ($siswa > 0){

                    $row = mysqli_fetch_assoc($cek_tabel_siswa);

                    //menyimpan data siswa dalam session
                    session_start();
                    $_SESSION["username"]   =   $row["nama_siswa"];
                    $_SESSION["id_siswa"]   =   $row["id_siswa"];
                    $_SESSION["kode_siswa"] =   $row["kode_siswa"];

                }
                $pesan = "<div class='alert alert-success'><strong>Selamat Datang</strong> anda berhasil daftar ujian psikotes. Silahkan memilih soal ujian.</div>";
                header("Location:index.php?page=ujian-psikotes&msg=" . enc_msg($pesan));
            }
            else {

                mysqli_query($kon,"ROLLBACK");
                $pesan="<div class='alert alert-danger'><strong>Error!</strong> gagal melakukan pendaftaran!</div>";

            }

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

<div class="container">
    <div class="row">

    <div class="col-md-6 offset-md-3">
        <div class="jumbotron jumbotron alert-info">
            <div class="container">
                <h3 class="text-center">FORM REGISTRASI UJIAN PSIKOTES</h3>
                <hr>
            </div>
        
            <form action="daftar.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <?php   if ($_SERVER["REQUEST_METHOD"] == "POST") echo $pesan; ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Lengkap:</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat:</label>
                                <textarea class="form-control" name="alamat" rows="4" id="alamat"></textarea>
                            </div>
                        </div>
                    </div>

                	
                	<div class="row d-none">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tipe Ujian:</label>
                                
                                <?php
                                    include 'config/database.php';
                                    //Perintah sql untuk menampilkan semua data pada tabel kelas
                                    $sql="select * from kelas where nama_kelas = 'Psikotes'";
                                    $hasil=mysqli_query($kon,$sql);
                                    while ($data = mysqli_fetch_array($hasil)) {
                                        ?>
                                    <input type="hidden" name="kelas" class="form-control" value="<?php echo $data['id_kelas'];?>" readonly>
                                    <input type="text" name="nama_kelas" class="form-control" value="<?php echo $data['nama_kelas'];?>" readonly>
                                    <?php
                                    }
                                ?>
                              
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 offset-4">
                            <button type="submit" name="tambah_siswa" id="Submit" class="btn btn-primary">Ikut Ujian</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
</div>

</body>

</html>

<style>

    .file {

    visibility: hidden;

    position: absolute;

    }

</style>



<script>

    $(document).on("click", "#pilih_foto", function() {

    var file = $(this).parents().find(".file");

    file.trigger("click");

    });

    $('input[type="file"]').change(function(e) {

    var fileName = e.target.files[0].name;

    $("#file").val(fileName);



    var reader = new FileReader();

    reader.onload = function(e) {

        // get loaded data and render thumbnail.

        document.getElementById("preview").src = e.target.result;

    };

    // read the image file as a data URL.

    reader.readAsDataURL(this.files[0]);

    });



</script>

