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
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
   <!--  <link rel="stylesheet" href="pages/sales/css/style.css">
	<link rel="stylesheet" href="pages/sales/css/bootstrap-datetimepicker.min.css"> -->
    <title>Data Request New Project</title>
  </head>
  <body>
<div class="card">
    <div class="card-body">

        <h4>Data Request New Project</h4>
      
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
            <table class="table table-hover" id="tabel_mapel">
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
                
                    $sql="select * from tdocument order by NumDoc Desc";
                    $hasil=mysqli_query($kon,$sql);
                    $no=0;
                    //Menampilkan data dengan perulangan while
                    while ($data = mysqli_fetch_array($hasil)):
                    $no++;
                ?>
                <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data['NumDoc'];?></td>
                    <td><?php echo date('d F Y H:i:s', strtotime($data['DateRequest']));?></td>
                    
                    <td><?php echo $data['CodeProject'];?></td>
                    <td><?php echo $data['Prod_Name'];?></td>
                    <td><?php echo $data['CustName'];?></td>
                    <td><?php if ($data['DateEstBOM'] == 0) {echo ' ';} else{echo date('d M Y H:i:s', strtotime($data['DateEstBOM']));}?></td>
                    <td><?php if ($data['DateCosting'] == 0) {echo ' ';} else{echo date('d M Y H:i:s', strtotime($data['DateCosting']));}?></td>
                    <td><?php echo $data['StatusRequest'];?></td>
                    <td><?php echo $data['StatusDoc'];?></td>
                    <td>
                    <a href="index.php?page=edit-rnp&id=<?php echo $data['NumDoc'] ?>" class="btn btn-md btn-warning" title="Edit Data RNP"><i class="fas fa-edit"></i></a>
                    <button class="btn_edit btn btn-primary btn-circle" title="Edit Status Document" NumDoc="<?php echo $data['NumDoc']; ?>"><i class="fas fa-pen"></i></button>
                    <a href="index.php?page=history-rnp&id=<?php echo $data['NumDoc'] ?>" class="btn btn-md btn-success" title="History Data RNP">History</a>
                    <?php //echo $data['StatusDoc']; ?>
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

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

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
                /* document.getElementById("judul").innerHTML='Close Data #'+NumDoc; */
                document.getElementById("judul").innerHTML='Close Data';
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