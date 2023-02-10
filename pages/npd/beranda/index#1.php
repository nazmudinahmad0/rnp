<?php
    //validasi hanya admin yang boleh mengakses halaman ini
    $username = $_SESSION['username'];
    $cek = mysqli_query ($kon,"select * from npd where username='".$username."' limit 1");
    $jum = mysqli_num_rows($cek);

    if ($jum<1){
        echo "<br><div class='alert alert-danger'>TIDAK MEMILIKI HAK AKSES</div>";
        exit;
    }
?>
<?php
    include 'config/database.php';
    $username = $_SESSION['username'];
    $query9 ="select * from npd where username='".$username."' limit 1"; 
    $hasil9 = mysqli_query($kon,$query9);
    $data7  = mysqli_fetch_array($hasil9);                      
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Data Transaction Proforma Invoice</title>
    <link rel="stylesheet" href="pages/sales/pi/css/style.css">
	  <link rel="stylesheet" href="pages/sales/pi/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  </head>
  <body>
  <div class="container" style="margin-top: 25px">
  <div class="card">
    <div class="card-body">
        <?php
            if (isset($_GET['edit'])) {
                        if ($_GET['edit']=='berhasil'){
                            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data telah diupdate!</div>";
                        }else if ($_GET['edit']=='gagal'){
                            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data gagal diupdate!</div>";
                        }    
            }
        ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tabel_rnp">
                <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Doc. Number</th>
                    <th scope="col">Date Request</th>
                    <th scope="col">NPD Type</th>
                    <th scope="col">NPD Type Name</th>
                    <th scope="col">Code Project</th>
                    <th scope="col">Prod. Name</th>
                    <!--<th scope="col">CUSTOMER</th>-->
                    <th scope="col">Customer</th>
                    <!--<th scope="col">User</th>-->
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php 
                            include 'config/database.php';
                            $no = 1;
                            $query = mysqli_query($kon,"SELECT * FROM tdocument");
                            while($row = mysqli_fetch_array($query)){
                        ?>

                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['NumDoc'] ?></td>
                            <td><?php echo $row['DateRequest'] ?></td>
                            <td><?php echo $row['NPDType'] ?></td>
                            <td><?php echo $row['NPDTypeName'] ?></td>
                            <td><?php echo $row['CodeProject'] ?></td>
                            <td><?php echo $row['Prod_Name'] ?></td>
                            <td><?php echo $row['CustName'] ?></td> 
                            <td class="text-center">
                            <button class="btn btn-warning btn_edit" NumDoc="<?php echo $row['NumDoc']; ?>"><i class="fa fa-edit"></i></button>
                            <a href="pages/npd/beranda/hapus-rnp.php?id=<?php echo $row['NumDoc'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-regular fa-trash"></i></a>
                            </td>
                        </tr>

                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
  </div>
  </div>
  <div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="title"></h4>
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
        $('#tabel_rnp').DataTable();
    } );

    $('.btn_edit').on('click',function(){

        var NumDoc = $(this).attr("NumDoc");
        $.ajax({
            url: 'pages/npd/beranda/edit-rnp.php',
            method: 'POST',
            data: {NumDoc:NumDoc},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("title").innerHTML='Edit RNP #'+NumDoc;
            }
        });
            // Membuka modal
        $('#modal').modal('show');
        });

  </script>
  
  </body>
</html>