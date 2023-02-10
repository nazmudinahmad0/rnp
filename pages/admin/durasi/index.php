<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Master Jam</title>
  </head>

  <body>
    <!--Kode Otomatis-->
    <?php
      //include 'koneksi.php';
      //$query2 = mysqli_query($connection, "SELECT max(UserID) as kodeTerbesar FROM user");
      //$data2 = mysqli_fetch_array($query2);
      //$kodeUser = $data2['kodeTerbesar'];
      //$urutan = (int) substr($kodeUser, 3, 3);
      //$urutan++;
      //$huruf = "U";
      //$kodeUser = $huruf . sprintf("%03s", $urutan);
    //?>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              MASTER DURASI
            </div>
            <div class="table-responsive">
              <table class="table table-hover" id="catTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">PI_SO</th>
                    <th scope="col">SO_PO</th>
                    <th scope="col">LTSales_Finish</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"select * from Dedurasi");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['PI_SO']." Jam" ?></td>
                      <td><?php echo $row['SO_PO']." Jam" ?></td>
                      <td><?php echo $row['LTSales_Finish']." Jam" ?></td>
                      <td class="text-center">
                        <a href="pages/admin/durasi/edit-master-durasi.php?id=<?php echo $row['id_durasi'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                      </td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#catTable').DataTable();
      } );
    </script>
  </body>
</html>
