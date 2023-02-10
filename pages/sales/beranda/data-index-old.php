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

        <h3>Data Request New Project</h3>
      
        <?php
            //Validasi untuk menampilkan pesan pemberitahuan saat user Edit RNP
            if (isset($_GET['edit'])) {
                if ($_GET['edit']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data telah diupdate!</div>";
                }else if ($_GET['edit']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data gagal diupdate!</div>";
                }    
            }
        ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Request Date</th>
                    <th>NPD Type</th>
                    <th>Code of Project</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>
                    <th>Status Request</th>
                    <th>Status Doc</th>
                    <th width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    // include database
                    include 'config/database.php';
                
                    $sql="select * from tdocument order by NumDoc Desc";
                    $hasil=mysqli_query($kon,$sql);
                    $no=0;
                    //Menampilkan data dengan perulangan while
                    while ($data = mysqli_fetch_array($hasil)):
                    $no++;
                ?>
                <tr>
                    <td><?php echo $data['NumDoc'];?></td>
                    <td><?php echo $data['DateRequest'];?></td>
                    <td><?php echo $data['NPDType'];?></td>
                    <td><?php echo $data['CodeProject'];?></td>
                    <td><?php echo $data['Prod_Name'];?></td>
                    <td><?php echo $data['CustName'];?></td>
                    <td><?php echo $data['StatusRequest'];?></td>
                    <td><?php echo $data['StatusDoc'];?></td>
                    <td>
                    <button class="btn_edit btn btn-warning btn-circle" NumDoc="<?php echo $data['NumDoc']; ?>"><i class="fa fa-edit"></i></button>
                </td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div><br>
        <!--<button type="button" class="btn btn-primary" id="btn_tambah">Tambah</button>-->
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

<script>

    $(document).ready( function () {
        $('#tabel_mapel').DataTable();
    } );

    // fungsi edit mapel
    $('.btn_edit').on('click',function(){

        var NumDoc = $(this).attr("NumDoc");
        //var kode_mapel = $(this).attr("kode_mapel");
        $.ajax({
            url: 'pages/sales/beranda/edit.php',
            method: 'post',
            data: {NumDoc:NumDoc},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit data rnp #'+NumDoc;
            }
        });
            // Membuka modal
        $('#modal').modal('show');
    });

    // fungsi hapus mapel
    $('.btn_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus data ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });


</script>