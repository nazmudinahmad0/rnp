<?php

session_start();

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



            $nama=input($_POST["nama"]);

            $nis=input($_POST["nis"]);

            $jk=input($_POST["jk"]);

            $email=input($_POST["email"]);

            $no_telp=input($_POST["no_telp"]);

            $alamat=input($_POST["alamat"]);

	    $kelas=input($_POST["kelas"]);

            $username=input($_POST["username"]);

	    $password=input(md5($_POST["password"]));

  

            $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');

            $foto = $_FILES['foto']['name'];

            $x = explode('.', $foto);

            $ekstensi = strtolower(end($x));

            $ukuran	= $_FILES['foto']['size'];

            $file_tmp = $_FILES['foto']['tmp_name'];



           

            $query = mysqli_query($kon, "SELECT max(id_siswa) as id_terbesar FROM siswa");

            $ambil= mysqli_fetch_array($query);

            $id_siswa = $ambil['id_terbesar'];

            $id_siswa++;

            //Membuat kode siswa

            $huruf = "G";

            $kode_siswa = $huruf . sprintf("%03s", $id_siswa);

      

            if (!empty($foto)){

                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                    //Mengupload gambar

                    move_uploaded_file($file_tmp, 'foto/'.$foto);

                    //Sql jika menggunakan foto

                    $sql="INSERT INTO siswa (kode_siswa,nama_siswa,id_kelas,nis,jk,email,no_telp,alamat,foto,username,password) VALUES

                    ('$kode_siswa','$nama','$kelas','$nis','$jk','$email','$no_telp','$alamat','$foto','$username','$password')";

                }

            }else {

                //Sql jika tidak menggunakan foto, maka akan memakai gambar_default.png

                $foto="foto_default.png";

                $sql="INSERT INTO siswa (kode_siswa,nama_siswa,id_kelas,nis,jk,email,no_telp,alamat,foto,username,password) VALUES

                ('$kode_siswa','$nama','$kelas','$nis','$jk','$email','$no_telp','$alamat','$foto','$username','$password')";

            }



            //Menyimpan ke tabel siswa

            $simpan_siswa=mysqli_query($kon,$sql);



            if ($simpan_siswa) {

                mysqli_query($kon,"COMMIT");

                header("Location:index.php?page=siswa&tambah=berhasil");

            }

            else {

                mysqli_query($kon,"ROLLBACK");

                header("Location:index.php?page=siswa&tambah=berhasil");

            }

        }

    }

?>



<form action="tambah.php" method="post" enctype="multipart/form-data">

    <div class="row">

        <div class="col-sm-7">

            <div class="form-group">

                <label>Nama Lengkap:</label>

                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>

            </div>

        </div>

        <div class="col-sm-5">

            <div class="form-group">

            <label>Nomor Identitas Kependudukan (NIK):</label>

                <input type="text" name="nis" class="form-control" placeholder="Masukan NIK Sesuai KTP" required>

             

            </div>

        </div>

    </div>



    <div class="row">

        <div class="col-sm-4">

            <div class="form-group">

                <label>Email</label>

                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>

            </div>

        </div>

        <div class="col-sm-3">

            <div class="form-group">

                <label>Tanggal Lahir:</label>

                <input type="text" name="no_telp" class="form-control" placeholder="Masukan Tanggal Lahir" required>

            </div>

        </div>

        <div class="col-sm-5">

        <div class="form-group">

                <label>Jenis Kelamin:</label>

                <div class="form-check-inline">

                    <label class="form-check-label">

                        <input type="radio" class="form-check-input" name="jk" value="1" required>Laki-laki

                    </label>

                    <label class="form-check-label">

                        <input type="radio" class="form-check-input" name="jk" value="2" required>Perempuan

                    </label>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-sm-7">

            <div class="form-group">

                <label>Alamat:</label>

                <textarea class="form-control" name="alamat" rows="4" id="alamat"></textarea>

            </div>

        </div>

    </div>

    <div class="row">

	<div class="col-sm-4">

            <div class="form-group">

                <label>Username:</label>

                <input type="text" name="username" class="form-control" placeholder="Masukan username" required>

            </div>

        </div>

        <div class="col-sm-3">

            <div class="form-group">

                <label>Password:</label>

                <input type="text" name="password" class="form-control" placeholder="Masukan Password" required>


            </div>

        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>Tipe Ujian:</label>
                
                <?php
                    include 'config/database.php';
                    //Perintah sql untuk menampilkan semua data pada tabel kelas
                    $sql="select * from kelas where nama_kelas = 'Psikotes'";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                    <input type="text" name="kelas" class="form-control" value="<?php echo $data['id_kelas'];?>" readonly>
                    <?php
                    }
                ?>
              
            </div>
        </div>
    </div>


        <!--<div class="col-sm-7">

            <div class="form-group">

                <label>Kelas:</label>-->

                <!--<select class="form-control" name="kelas">-->

                
                <!--</select>-->

            

        </div>

    </div>

    <div class="row">

        <div class="col-sm-7">

            <div class="form-group">

                <div id="msg"></div>

                <label>Foto:</label>

                <input type="file" name="foto" class="file" >

                    <div class="input-group my-3">

                        <input type="text" class="form-control" disabled placeholder="Upload Foto" id="file">

                        <div class="input-group-append">

                                <button type="button" id="pilih_foto" class="browse btn btn-dark">Pilih</button>

                        </div>

                    </div>

                <img src="img/img80.png" id="preview" class="img-thumbnail">

            </div>

        </div>

    </div>



    <div class="row">

        <div class="col-sm-4">

            <button type="submit" name="tambah_siswa" id="Submit" class="btn btn-primary">Submit</button>

            <button type="reset" class="btn btn-secondary">Reset</button>

        </div>

    </div>

</form>



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

