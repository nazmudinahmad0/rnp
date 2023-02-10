<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Data User NPD</title>
  </head>

  <body>
    <!--Kode Otomatis-->
<?php
	// https://www.malasngoding.com
	// menghubungkan dengan koneksi database
	include 'config/database.php';
 
	// mengambil data barang dengan kode paling besar
    $query3 = "SELECT max(id_npd) as idTerbesar, max(kode_npd) as kodeTerbesar FROM npd";
    $hasil = mysqli_query($kon,$query3);
	$data3 = mysqli_fetch_array($hasil);
    $kodeBarang = $data3['kodeTerbesar'];
    $idUser = $data3['idTerbesar'];
 
	// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
	// dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodeBarang, 2, 5);
    $urutanid = $idUser;
 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    $urutanid++;
 
	// membentuk kode barang baru
	// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
	// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
	// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
	$huruf = "N";
    $kodeBarang = $huruf . sprintf("%02s", $urutan);
    $idUser = sprintf($urutanid);
	?>

    <div class="container" style="margin-top: 20px">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              TAMBAH USER NPD
            </div>
            <div class="card-body">
             <form action="pages/admin/usernpd/simpannpd.php"  method="POST">
            
                  <input type="hidden" name="id_npd" required="required" value="<?php echo $idUser ?>" class="form-control" readonly>
                
                <div class="form-group">
                  <label>UserID</label>
                  <input type="text" name="kode_npd" placeholder="Masukkan ID Department" required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="nama_npd" placeholder="Input Name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" placeholder="Input User Name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" placeholder="Input Password" class="form-control">
                </div>
                <div class="form-group">
                  <label>Lokasi</label>
                  <select name="plant" class="form-control">
                    <option value="P1">P1</option>
                    <option value="P4">P4</option>
                  <!--<input type="text" name="nama_npd" placeholder="Input Name" class="form-control">-->
                </div>
               
                  <input type="hidden" name="DeptID" placeholder="Input Password" value ="D02" class="form-control" readonly>
                    
                
                
<br>
                <div class="form group">
                <input type="submit" class="btn btn-sm btn-success" value="SAVE">
                <!--<input type="reset" class="btn btn-sm btn-danger" value="RESET">-->
                </div>
              </form>
              <br/>
              <div class="table-responsive">
              <table class="table table-bordered" id="deptTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">UserID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include 'config/database.php';
                      $no = 1;
                      $query = mysqli_query($kon,"SELECT * FROM npd t1 LEFT JOIN department t2 ON t1.DeptID = t2.DeptID");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['kode_npd'] ?></td>
                      <td><?php echo $row['nama_npd'] ?></td>
                      <td><?php echo $row['DeptName'] ?></td>
                      <td><?php echo $row['username'] ?></td>
                      <td><?php echo $row['password'] ?></td>
                      <td><?php echo $row['plant'] ?></td>
                      <td class="text-center">
                        <a href="pages/admin/usernpd/edit-user-npd.php?kd=<?php echo $row['id_npd'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-regular fa-edit"></i></a>
                        <a href="pages/admin/usernpd/hapus-user-npd.php?kd=<?php echo $row['id_npd'] ?>&name=<?php echo $row['nama_npd'] ?>&" class="btn btn-sm btn-danger"><i class="fa fa-regular fa-trash"></i></a>
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
