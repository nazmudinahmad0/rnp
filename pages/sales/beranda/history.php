<?php
    //validasi hanya admin yang boleh mengakses halaman ini
    $username = $_SESSION['username'];
    $cek = mysqli_query ($kon,"select * from sales where username='".$username."' limit 1");
    $jum = mysqli_num_rows($cek);

    if ($jum<1){
        echo "<br><div class='alert alert-danger'>TIDAK MEMILIKI HAK AKSES</div>";
        exit;
    }
?>

<hr>

<div class="card">
    <div class="card-body">

        <h3>Data History</h3>
     
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                <tr>
                    
                    <th>Date</th>
                    <th>Dept</th>
                    <th>Comment</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php
                    // include database
                    include 'config/database.php';
                    $nis = $_GET['id'];
                    $sql="select * from thistorycomment where NumDoc='$nis'";
                    $hasil=mysqli_query($kon,$sql);
                    $no=0;
                    //Menampilkan data dengan perulangan while
                    while ($data = mysqli_fetch_array($hasil)):
                    $no++;
                ?>
                <tr>
                    <td><?php echo date('d F Y H:i:s', strtotime($data['DateComment']));?></td>
                    <td><?php echo $data['Dept'];?></td>
                    <td><?php echo $data['Comment'];?></td>
                    
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div><br>
        <!--<button type="button" class="btn btn-primary" id="btn_tambah">Tambah</button>-->
    </div> 
</div>

