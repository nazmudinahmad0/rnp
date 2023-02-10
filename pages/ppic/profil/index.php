<hr>
<div class="card">
    <div class="card-body">
    <h3>Profil</h3>
    <?php
        include 'config/database.php';
        $query ="select * from ppic where id_ppic='".$_SESSION["id_ppic"]."' limit 1"; 
        $hasil=mysqli_query($kon,$query);
        $row = mysqli_fetch_array($hasil);
    ?>

        <div class="table-responsive">
            <table class="table table-border" id="tabel_ujian">
                <tbody>
                <tr>
                    <td width="20%">Nama</td>  
                    <td>: <?php echo $row['nama_ppic'];?></td>
                </tr>
                <!-- <tr>
                    <td>Jenis Kelamin</td> <td>: <?php //echo $row['jk'] == 1 ? 'Laki-laki' : 'Perempuan';?></td>
                </tr> -->
                
                <tr>
                    <td>ID</td>  <td>:  <?php echo $row['id_ppic'];  ?> </td>
                </tr>

                </tbody>
            </table>
        </div>
        <br>
    </div> 
</div>