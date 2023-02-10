<?php

    //validasi hanya siswa yang boleh mengakses halaman ini
    $username = $_SESSION['username'];
    $cek = mysqli_query ($kon,"select * from siswa where username='".$username."' limit 1");
    $jum = mysqli_num_rows($cek);

?>

<hr>

<div class="card">

    <div class="card-body">

        <h3>Daftar Ujian </h3><hr>

        <?php 

        if (isset($_SESSION["mulai_ujian"])):

            $nama_mapel=$_SESSION["nama_mapel"];

            $id_ujian=$_SESSION["id_ujian"];

            echo "<div class='alert alert-warning'>Ujian <strong>".$nama_mapel."</strong> sedang berlangsung <a href='index.php?page=mulai-ujian&id=".$id_ujian."' class='btn btn-warning btn-sm' role='button'>lanjut & selesaikan</a> </div>";

          

        endif; 

        ?>



        <div class="table-responsive">

            <table class="table table-bordered" id="tabel_ujian">

                <thead class="thead-light">

                <tr>

                    <th>No</th>

                    <th>Kode</th>

                    <th>Keterangan</th>

                    <!--<th>Guru</th>-->

                    <th>Tanggal</th>

                    <th>Jam</th>

                    <th>Waktu</th>

                    <th width="10%">Aksi</th>

                </tr>

                </thead>

                <tbody>

                <?php

                    // include database

                    include 'config/database.php';

               

                    $id_siswa=$_SESSION["id_siswa"];

                    $hasil=mysqli_query($kon,"select id_kelas from siswa where id_siswa='$id_siswa' ");

                    $row=mysqli_fetch_array($hasil);

                    $id_kelas=$row['id_kelas'];



                    $sql="select * from ujian u

                    inner join kelas k on u.id_kelas=k.id_kelas

                    inner join mapel m on m.id_mapel=u.id_mapel

                    inner join guru g on g.id_guru=u.id_guru

                    inner join siswa s on s.id_kelas=k.id_kelas

                    where k.id_kelas='$id_kelas' and s.id_siswa='$id_siswa' order by tanggal desc";

                    $hasil=mysqli_query($kon,$sql);

                    $no=0;

                    //Menampilkan data dengan perulangan while

                    while ($data = mysqli_fetch_array($hasil)):

                    $no++;

                ?>

                <tr>

                    <td><?php echo $no; ?></td>

                    <td><?php echo $data['kode_ujian'];?></td>

                    <td><?php echo $data['nama_mapel'];?></td>

                    

                    <td><?php echo tanggal(date('Y-m-d', strtotime($data["tanggal"]))); ?></td>

                    <td><?php echo date('H:i', strtotime($data["jam"]));?> WIB</td>

                    <td><?php echo $data['waktu'];?> menit</td>

                    <td>

                    <a href="index.php?page=review&id=<?php echo $data['id_ujian']; ?>" class="btn btn-primary btn-circle" ><i class="fas fa-paper-plane"></i> Pilih</a>

                </td>

                </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

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





<?php 

    //Membuat format tanggal

    function tanggal($tanggal)

    {

        $bulan = array (1 =>   'Januari',

            'Februari',

            'Maret',

            'April',

            'Mei',

            'Juni',

            'Juli',

            'Agustus',

            'September',

            'Oktober',

            'November',

            'Desember'

        );

        $split = explode('-', $tanggal);

        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

    }



?>



<script>

    $(document).ready( function () {

        $('#tabel_ujian').DataTable();

    } );

</script>





