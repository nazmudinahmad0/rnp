<?php 
  
 
  include('koneksi.php');
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM sales_order t1 inner join category t2 on t1.CatID = t2.CatID WHERE NoPI = '$kd' LIMIT 1";

  $result = mysqli_query($connection, $query);

  $data5 = mysqli_fetch_array($result);

  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Data Production Order</title>
    <link rel="stylesheet" href="css/style.css">
	  <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
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
    $query3 = "SELECT max(NumDoc) as kodeTerbesar FROM prod_order";
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

    <div class="container" style="margin-top: 32px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              FORM TRANSACTION PRODUCTION ORDER
            </div>
            <div class="card-body">
             <form action="simpan-po.php" method="POST">

                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" placeholder="Masukkan Document Number" required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>
                
                

                <div class="form-group">
                  <label>No SO</label>
                  <input type="text" name="NoSO"  class="form-control" value="<?php echo $data5['NoSO']; ?>" readonly>
                </div>


                <div class="form-group">
                  <label>No PI</label>
                  <input type="text" name="NoPI" class="form-control" value="<?php echo $data5['NoPI']; ?>" readonly>
                  
                </div>

                <div class="form-group">
                  <label>Category</label>    
                  <input type="hidden" name="CatID"  class="form-control" value="<?php echo $data5['CatID']; ?>" readonly>
                  <input type="text" name="CatName"  class="form-control" value="<?php echo $data5['CatName']; ?>" readonly>               
                </div>

                <div class="form-group">
                  <label>No PO</label>
                  <input type="text" name="NoPO" placeholder="Input Production Order Number" class="form-control">
                </div>

                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="DatePO" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <input type="hidden" name="DatePOSAP" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>">
                </div>

                <div class="form-group">
                  <label>Lead Time PPIC</label>
                  <input type="text" name="LeadTimePPIC" placeholder="Input Lead Time PPIC" class="form-control" id="id_0">
                </div>

                <div class="form-group">
                  <input type="hidden" name="UserID" value="Mika" class="form-control">
                </div>
              
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
            </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#poTable').DataTable();
      } );
    </script>

<script type="text/javascript">   
                          <?php   
                          echo $a;   
                           ?>  
                          function changeValue(id){  
                            document.getElementById('NoSO').value = NoSO[id].NoSO;  
                            document.getElementById('CatID').value = CatID[id].CatID;  
                          };  
                          </script>  
  <script src="js/popper.js"></script>
  <script src="js/moment-with-locales.min.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
  <script src="js/main.js"></script>
  </body>
</html>

