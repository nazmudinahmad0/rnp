<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>NPD Type</title>
  </head>

  <body>
    <!--Kode Otomatis-->
    <?php
	// https://www.malasngoding.com
	// menghubungkan dengan koneksi database
	include 'config/database.php';
 
	// mengambil data barang dengan kode paling besar
  $query5 = "SELECT max(NPDTypeID) as kodeTerbesar FROM npdtype";
  $hasil = mysqli_query($kon,$query5);
	$data5 = mysqli_fetch_array($hasil);
	$kodeBarang = $data5['kodeTerbesar'];
 
	// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
	// dan diubah ke integer dengan (int)
	$urutan = (int) substr($kodeBarang, 3, 5);
 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$urutan++;
 
	// membentuk kode barang baru
	// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
	// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
	// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
	$huruf = "npd";
	$kodeBarang = $huruf . sprintf("%03s", $urutan);
	?>

    <div class="container" style="margin-top: 20px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              TAMBAH NPD TYPE
            </div>
            <div class="card-body">
             <form action="pages/admin/npd-type/npd-type-simpan.php"  method="POST">
                
                <div class="form-group">
                  <label>NPD Type ID</label>
                  <input type="text" name="NPDTypeID"  required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>NPD Type Name</label>
                  <input type="text" name="NPDTypeName" placeholder="Input NPD Type Name" class="form-control">
                </div>
              
                <button type="submit" class="btn btn-sm btn-success">SAVE</button>
                <button type="reset" class="btn btn-sm btn-warning">RESET</button>

              </form>
              <br/>
              <div class="table-responsive">
              <table class="table table-hover" id="deptTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NPDTypeID</th>
                    <th scope="col">NPDTypeName</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include 'config/database.php';
                      $no = 1;
                      $query = mysqli_query($kon,"SELECT * FROM npdtype");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['NPDTypeID'] ?></td>
                      <td><?php echo $row['NPDTypeName'] ?></td>
                      <td class="text-center">
                        <a href="pages/admin/npd-type/npd-type-edit.php?id=<?php echo $row['NPDTypeID'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-regular fa-edit"></i></a>
                        <a href="pages/admin/npd-type/npd-type-hapus.php?id=<?php echo $row['NPDTypeID'] ?>&name=<?php echo $row['NPDTypeName'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-regular fa-trash"></i></a>
                      </td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#deptTable').DataTable();
      } );
    </script>
  </body>
</html>
