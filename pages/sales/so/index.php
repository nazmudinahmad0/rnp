<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Data Transaction Proforma Invoice</title>
    <link rel="stylesheet" href="pages/sales/so/css/style.css">
	  <link rel="stylesheet" href="pages/sales/so/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <!--Kode Otomatis-->
<?php
	// https://www.malasngoding.com
	// menghubungkan dengan koneksi database
	include('koneksi.php');
 
	// mengambil data barang dengan kode paling besar
    $query3 = "SELECT max(NumDoc) as kodeTerbesar FROM sales_order";
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
              FORM TRANSACTION SALES ORDER
            </div>
            <div class="card-body">
             <form action="pages/sales/so/simpan-so.php" method="POST">

                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" placeholder="Masukkan Document Number" required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>

                  <!--<input type="text" name="NoPI" placeholder="Input Proforma Invoice Number" class="form-control">-->
                  <div class="form-group">
                  <label>No PI</label>
                 
                  <select name="NoPI" id="NoPI" class="form-control" onchange='changeValue(this.value)' >  
                      <option value="">Pilih No PI</option>
                        <?php   
                        $query = mysqli_query($connection, "select t1.NoPI as nop, t2.NoSO as nos, t3.CatName as ctn, t1.CatID as ctd from proforma_inv t1 LEFT JOIN sales_order t2 ON t1.NoPI = t2.NoPI LEFT JOIN category t3 ON t3.CatID = t2.CatID where t2.NoSO is null order by t1.NoPI asc");  
                        $result = mysqli_query($connection, "select t1.NoPI as nop, t2.NoSO as nos, t3.CatName as ctn, t1.CatID as ctd from proforma_inv t1 LEFT JOIN sales_order t2 ON t1.NoPI = t2.NoPI LEFT JOIN category t3 ON t3.CatID = t2.CatID where t2.NoSO is null order by t1.NoPI asc");  
                        $a          = "var NoSO = new Array();";  
                        while ($row = mysqli_fetch_array($result)) {  
                              echo '<option name="NoPI" value="'.$row['nop'] . '">' . $row['nop'] . '</option>';   
                        $a .= "NoSO['" . $row['nop'] . "'] = {NoSO:'" . addslashes($row['ctd'])."'};"; 
                        }  
                        ?>  
                        
                     </select>
                     
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <input type="text" name="CatID"  class="form-control" id="NoSO" readonly>
                  
                </div>

                <div class="form-group">
                  <label>No SO</label>
                  <input type="text" name="NoSO" placeholder="Input Sales Order Number" class="form-control">
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <!--<input type="text" name="NoSO" placeholder="Input Sales Order Number" class="form-control">-->
                  <select name="status_so" class="form-control">
                        <option name="status_so" value="Complete">Complete</option>
                        <option name="status_so" value="Not Complete">Not Complete</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Date </label>
                  <input type="text" name="DateSO" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  
                  <input type="hidden" name="DateSOSAP" value="<?php date_default_timezone_set('Asia/Jakarta');  echo date("m/d/Y H:i:s");?>" class="form-control">
                </div>

                <div class="form-group">
                  
                  <input type="hidden" name="UserID" value="Fauzi">
                </div>
              
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
              <br/>
              
              <div class="table-responsive">
              <table class="table table-hover" id="deptTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">Document No.</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">PROFORMA INVOICE</th>
                    <th scope="col">SALES ORDER</th>
                    <th scope="col">STATUS SO</th>
                    <th scope="col">DATE</th>
                    <!--<th scope="col">DATE SAP</th>-->
                    <!--<th scope="col">User</th>-->
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT t1.NumDoc as ND, t1.CatID as CAD, t1.NoPI as NP, t1.NoSO as SO, t1.status_so as SSO, t1.DateSO as DS, t1.DateSOSAP as DSAP, t2.UserName as Usern FROM sales_order t1 left join user t2 on t1.UserID = t2.UserID order by NP asc");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['ND'] ?></td>
                      <td><?php echo $row['CAD'] ?></td>
                      <td><?php echo $row['NP'] ?></td>
                      <td><?php echo $row['SO'] ?></td>
                      <td><?php echo $row['SSO'] ?></td>
                      <td><?php echo date("d-m-Y h:i:s A",strtotime($row['DS'])) ?></td> 
                      
                     
                      <td class="text-center">
                        <a href="pages/sales/so/edit-so.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="pages/sales/so/hapus-so.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-danger">HAPUS</a>
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
<script type="text/javascript">   
   <?php   
      echo $a;   
   ?>  
     function changeValue(id){  
      document.getElementById('NoSO').value = NoSO[id].NoSO; 
      };  
  </script>  
  <script src="pages/sales/so/js/popper.js"></script>
  
  <script src="pages/sales/so/js/moment-with-locales.min.js"></script>
  <script src="pages/sales/so/js/bootstrap-datetimepicker.min.js"></script>
  <script src="pages/sales/so/js/main.js"></script>
  </body>
</html>
