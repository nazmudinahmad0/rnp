<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Data Category</title>
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


<?php
	// https://www.malasngoding.com
	// menghubungkan dengan koneksi database
	include('koneksi.php');
 
	// mengambil data barang dengan kode paling besar
  $query3 = "SELECT max(CatID) as kodeTerbesar FROM category";
  $hasil = mysqli_query($connection,$query3);
	$data3 = mysqli_fetch_array($hasil);
	$kodeBarang = $data3['kodeTerbesar'];
 
	// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
	// dan diubah ke integer dengan (int)
	$urutan = (int) substr($kodeBarang, 2, 2);
 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$urutan++;
 
	// membentuk kode barang baru
	// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
	// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
	// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
	$huruf = "C";
	$kodeBarang = $huruf . sprintf("%02s", $urutan);
	?>

    <div class="container" style="margin-top: 35px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              TAMBAH CATEGORY
            </div>
            <div class="card-body">
             <form action="pages/admin/category/simpan-category.php" method="POST">
                
                <div class="form-group">
                  <label>Category ID</label>
                  <input type="text" name="CatID" placeholder="Input ID Category" required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" name="CatName" placeholder="Input Category Name" class="form-control">
                </div>
              
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
              <br/>
              <div class="table-responsive">
              <table class="table table-bordered" id="catTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">ID</th>
                    <th scope="col">CATEGORY NAME</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT * FROM category");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['CatID'] ?></td>
                      <td><?php echo $row['CatName'] ?></td>
                      <td class="text-center">
                        <a href="pages/admin/category/edit-category.php?id=<?php echo $row['CatID'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="pages/admin/category/hapus-category.php?id=<?php echo $row['CatID'] ?>" class="btn btn-sm btn-danger">HAPUS</a>
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
          $('#catTable').DataTable();
      } );
    </script>
  </body>
</html>
