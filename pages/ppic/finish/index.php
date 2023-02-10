<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Data Transaction Finish</title>
    <link rel="stylesheet" href="pages/ppic/finish/css/style.css">
	  <link rel="stylesheet" href="pages/ppic/finish/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
  </head>

  <body>
    <!--Kode Otomatis-->
<?php
	// https://www.malasngoding.com
	// menghubungkan dengan koneksi database
	include('koneksi.php');
 
	// mengambil data barang dengan kode paling besar
    $query3 = "SELECT max(NumDoc) as kodeTerbesar FROM finish";
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
              FORM TRANSACTION FINISH
            </div>
            <div class="card-body">
             <form action="pages/ppic/po/simpan-finish.php" method="POST">

                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" placeholder="Masukkan Document Number" required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>No PO</label>
                  <!--<input type="text" name="NoPI" placeholder="Input Proforma Invoice Number" class="form-control">-->

                  <select name="NoPO" id="NoPO" class="form-control" onchange='changeValue(this.value)' >  
                  <option value="">Pilih No PO</option>
                          <?php   
                          $query = mysqli_query($connection, "select * from prod_order order by NoPO esc");  
                          $result = mysqli_query($connection, "select * from prod_order");  
                          $a          = "var NoSO = new Array();;";
                          $b          = "var NoPO = new Array();;"; 
                          $c          = "var CatID = new Array();;";   
                          while ($row = mysqli_fetch_array($result)) {  
                               echo '<option name="NoPO" value="'.$row['NoPO'] . '">' . $row['NoPO'] . '</option>';   
                          $a .= "NoSO['" . $row['NoPO'] . "'] = {NoSO:'" . addslashes($row['NoSO'])."'};";  
                          $b .= "NoPI['" . $row['NoPO'] . "'] = {NoPI:'" . addslashes($row['NoPI'])."'};";  
                          $c .= "CatID['" . $row['NoPO'] . "'] = {CatID:'" . addslashes($row['CatID'])."'};";  
                          }  
                          ?>  
                     </select>

                </div>

                <div class="form-group">
                  <label>No SO</label>
                  <input type="text" id="NoSO" name="NoSO" placeholder="Input SO Number" class="form-control" readonly>
                </div>

                <div class="form-group">
                <label>No PI</label>
                  <input type="text" id="NoPI" name="NoPI" placeholder="Input PO Number" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Category</label>
                  <input type="text" id="CatID" name="CatID" placeholder="Input PO Number" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Date</label>
                  
                  <input type="text" name="DateFinish" value="<?php echo date_default_timezone_set('Asia/Jakarta'); date("m/d/Y H:i:s");?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                <label>Status</label>
                  <input type="text" name="status_ok" value = "Close" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <input type="hidden" name="UserID" value="Mika" class="form-control">
                  
                </div>
              
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
              <br/>
              <div class="table-responsive">
              <table class="table table-bordered table-hover" id="fintable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">Document No.</th>
                    <th scope="col">Category</th>
                    <th scope="col">No. PI</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">User</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT * from finish order by NoPI asc");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['NumDoc'] ?></td>
                      <td><?php echo $row['CatID'] ?></td>
                      <td><?php echo $row['NoPI'] ?></td>
                      <td><?php echo $row['DateFinish'] ?></td>
                      <td><?php echo $row['status_ok'] ?></td>
                      <td><?php echo $row['UserID'] ?></td>
                      <td class="text-center">
                        <a href="pages/ppic/finish/edit-finish.php?id=<?php echo $row['NumDoc'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="pages/ppic/finish/hapus-finish.php?id=<?php echo $row['NumDoc'] ?>" class="btn btn-sm btn-danger">HAPUS</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#fintable').DataTable();
      } );
    </script>

<script type="text/javascript">   
                          <?php   
                          echo $a;   
                          echo $b;
                          echo $c;
                           ?>  
                          function changeValue(id){  
                            document.getElementById('NoSO').value = NoSO[id].NoSO;  
                            document.getElementById('NoPI').value = NoPI[id].NoPI;
                            document.getElementById('CatID').value = CatID[id].CatID;  
                          };  
                          </script>  

  <script src="pages/ppic/finish/popper.js"></script>
  
  <script src="pages/ppic/finish/js/moment-with-locales.min.js"></script>
  <script src="pages/ppic/finish/js/bootstrap-datetimepicker.min.js"></script>
  <script src="pages/ppic/finish/js/main.js"></script>
  </body>
</html>
