<?php
    //validasi hanya admin yang boleh mengakses halaman ini
    $username = $_SESSION['username'];
    $cek = mysqli_query ($kon,"select * from fa where username='".$username."' limit 1");
    $jum = mysqli_num_rows($cek);

    if ($jum<1){
        echo "<br><div class='alert alert-danger'>TIDAK MEMILIKI HAK AKSES</div>";
        exit;
    }
?>
<hr>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<div class="card">
    <div class="card-body">

        <h3>Request New Project</h3><br/>
     
        <?php
            //Validasi untuk menampilkan pesan pemberitahuan saat user menambah kelas
            if (isset($_GET['tambah'])) {
                if ($_GET['tambah']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data echo telah ditambah!</div>";
                }else if ($_GET['tambah']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data gagal ditambahkan!</div>";
                }    
            }
            
            if (isset($_GET['edit'])) {
                if ($_GET['edit']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data telah diupdate!</div>";
                }else if ($_GET['edit']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data gagal diupdate!</div>";
                }    
            }
            if (isset($_GET['hapus'])) {
                if ($_GET['hapus']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data telah dihapus!</div>";
                }else if ($_GET['hapus']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data gagal dihapus!</div>";
                }    
            }
        ?>
        <div class="table-responsive">
            <table class="table table-hover" id="tabel_kelas">
                <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>No.Document</th>
                    <th>Request Date</th>
                    
                    <th>Code of Project</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>
                    <th>NPD Doc Send</th> 
                    <th>FA Doc Send</th>
                    <th>Status Request</th>
                    <th>Status Doc</th>
                    <th width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    // include database
                    include 'config/database.php';
                
                    $sql="SELECT * FROM tdocument order by NumDoc Desc";
                    $hasil=mysqli_query($kon,$sql);
                    $no=0;
                    //Menampilkan data dengan perulangan while
                    while ($data = mysqli_fetch_array($hasil)):
                    $no++;
                ?>
                <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data['NumDoc'];?></td>
                    <td><?php echo date('d M Y H:i:s', strtotime($data['DateRequest']));?></td>
                    
                    <td><?php echo $data['CodeProject'];?></td>
                    <td><?php echo $data['Prod_Name'];?></td>
                    <td><?php echo $data['CustName'];?></td>
                    <td><?php if ($data['DateEstBOM'] == 0) {echo ' ';} else{echo date('d M Y H:i:s', strtotime($data['DateEstBOM']));}?></td>
                    <td><?php if ($data['DateCosting'] == 0) {echo ' ';} else{echo date('d M Y H:i:s', strtotime($data['DateCosting']));}?></td>
                    <td><?php echo $data['StatusRequest'];?></td>
                    <td><?php echo $data['StatusDoc'];?></td>
                    <td>
                    <button class="btn_edit btn btn-warning btn-circle" NumDoc="<?php echo $data['NumDoc']; ?>" CodeProject="<?php echo $data['CodeProject']; ?>"><i class="fa fa-edit"></i></button>
                    <a href="index.php?page=history-rnp-fa&id=<?php echo $data['NumDoc'] ?>" class="btn btn-md btn-success" title="History Data RNP">History</a>
                    
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

<!--Skrip JS-->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


<script>

    $(document).ready( function () {
        $('#tabel_kelas').DataTable();
    } );

    // Tambah kelas
    $('#btn_tambah').on('click',function(){
        $.ajax({
            url: 'pages/npd/beranda/tambah-rnp.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Data';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });


    // fungsi edit kelas
    $('.btn_edit').on('click',function(){

        var NumDoc = $(this).attr("NumDoc");
        var CodeProject = $(this).attr("CodeProject");
        $.ajax({
            url: 'pages/fa/beranda/edit-rnp.php',
            method: 'post',
            data: {NumDoc:NumDoc,CodeProject:CodeProject},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Data #'+CodeProject;
            }
        });
            // Membuka modal
        $('#modal').modal('show');
    });


    // fungsi edit kelas
    $('.btn_return').on('click',function(){

var NumDoc = $(this).attr("NumDoc");
var CodeProject = $(this).attr("CodeProject");
$.ajax({
    url: 'pages/fa/beranda/edit-rnp.php',
    method: 'post',
    data: {NumDoc:NumDoc,CodeProject:CodeProject},
    success:function(data){
        $('#tampil_data').html(data);  
        document.getElementById("judul").innerHTML='Edit Data #'+CodeProject;
    }
});
    // Membuka modal
$('#modal').modal('show');
});


    // fungsi hapus kelas
    $('.btn_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus data ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });


</script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.js"></script>