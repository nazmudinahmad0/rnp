<?php
//validasi hanya guru yang boleh mengakses halaman ini
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
    <h3>Profil</h3>
    <?php
        include 'config/database.php';
        $query ="select * from sales where id_sales='".$_SESSION["id_sales"]."' limit 1"; 
        $hasil=mysqli_query($kon,$query);
        $row = mysqli_fetch_array($hasil);
    ?>


        <div class="table-responsive">
            <table class="table table-border">
                <tbody>
                <tr>
                    <td width="20%">Nama</td>  
                    <td>: <?php echo $row['nama_sales'];?></td>
                </tr>
                <tr>
                    <td>ID</td>  <td>:  <?php echo $row['id_sales'];  ?> </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div> 
</div>


