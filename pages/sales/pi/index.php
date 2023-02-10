<?php
                     include('koneksi.php');
                      $username = $_SESSION['username'];
                      $query9 ="select * from sales where username='".$username."' limit 1"; 
                      $hasil9 = mysqli_query($connection,$query9);
                      $data7  = mysqli_fetch_array($hasil9);
                      
                  ?>
 <?php 
 $namauser= $data7['nama_sales'];


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
    <!--Kode Otomatis-->
<?php
	// https://www.malasngoding.com
	// menghubungkan dengan koneksi database
	include('koneksi.php');
 
	// mengambil data barang dengan kode paling besar
    $query3 = "SELECT max(NumDoc) as kodeTerbesar FROM proforma_inv";
    $hasil = mysqli_query($connection,$query3);
	  $data3 = mysqli_fetch_array($hasil);
  	$kodeBarang = $data3['kodeTerbesar'];
 
	// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
	// dan diubah ke integer dengan (int)
	$urutan = (int) substr($kodeBarang, 2, 5);
 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$urutan++;
 
	// membentuk kode barang baru
	// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
	// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
	// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
	$huruf = "T";
	$kodeBarang = $huruf . sprintf("%05s", $urutan);
	?>

      <div class="container" style="margin-top: 25px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              FORM TRANSACTION PROFORMA INVOICE <?php ?>
            </div>
            <div class="card-body">
             <form action="pages/sales/pi/simpan-pi.php" method="POST">

                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" placeholder="Masukkan Document Number" required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>
                
                <div class="form-group">
                  <label>Category</label>
                  
                  <label>Category</label>
                  <!--<input type="text" name="CategoryID" placeholder="Input Category ID" class="form-control">-->
                  <select class="form-control" name="CategoryID">
                    <option value="">Pilih Category</option>
                        <?php
                      if($namauser == "Hans"){echo'
                        <option value="C01">Nasional</option>
                        <option value="C02">Bali</option>
                        <option value="C03">Export</option>'
                        ;}elseif($namauser == "Yefta"){
                        echo'<option value="C03">Export</option>';}
                        else{
                        echo'<option value="C01">Nasional</option>
                        <option value="C02">Bali</option>';}
                        ?>
                </select>
                  
                  
                </div>

                <div class="form-group">
                  <label>No PI - Customer</label>
                  <input type="text" name="NoPI" placeholder="Input Proforma Invoice Number" class="form-control">
                </div>
                
                <!--<div class="form-group">
                  <label>Customer</label>
                  <input type="text" name="Customer" placeholder="Input Customer Name" class="form-control">
                </div>-->

                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="DatePI" value="<?php date_default_timezone_set('Asia/Jakarta');  echo date("m/d/Y H:i:s");?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>LeadTimeMKT</label>
                  <input type="text" name="LeadTimeMKT" placeholder="Input Lead Time MKT" class="form-control" id="id_1">
                </div>

                <div class="form-group">
                  
                  <input type="hidden" name="UserID" value="<?php echo $row["nama_sales"];?>">
                </div>
              
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
              <br/>
              <div class="table-responsive">
              <table class="table table-hover" id="deptTable">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Document No</th>
                    <th scope="col">Category</th>
                    <th scope="col">Proforma Invoice</th>
                    <!--<th scope="col">CUSTOMER</th>-->
                    <th scope="col">Date</th>
                    <th scope="col">LeadTimeMKT</th>
                    <!--<th scope="col">User</th>-->
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT t1.NumDoc as ND, t3.CatName as CAD, t1.NoPI as NP, t1.DatePI as DP, t1.LeadTimeMKT as LT FROM proforma_inv t1 left join user t2 on t1.UserID = t2.UserID inner join category t3 on t1.CatID = t3.CatID");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['ND'] ?></td>
                      <td><?php echo $row['CAD'] ?></td>
                      <td><?php echo $row['NP'] ?></td>
                      <td><?php echo date("d-m-Y h:i:s A",strtotime($row['DP'])) ?></td>
                      <td><?php echo date("d-m-Y",strtotime($row['LT'])) ?></td> 
                      <td class="text-center">
                        <a href="pages/sales/pi/edit-pi.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="pages/sales/pi/hapus-pi.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-danger">HAPUS</a>
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

  <script src="page/sales/pi/js/popper.js"></script>
  
  <script src="pages/sales/pi/js/moment-with-locales.min.js"></script>
  <script src="pages/sales/pi/js/bootstrap-datetimepicker.min.js"></script>
  <script src="pages/sales/pi/js/main.js"></script>
 
  </body>
</html>
