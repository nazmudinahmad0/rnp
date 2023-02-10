<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Data Production Order</title>
    <link rel="stylesheet" href="pages/ppic/po/css/style.css">
	  <link rel="stylesheet" href="pages/ppic/po/css/bootstrap-datetimepicker.min.css">
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
             <form action="pages/ppic/po/simpan-po.php" method="POST">

                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" placeholder="Masukkan Document Number" required="required" value="<?php echo $kodeBarang ?>" class="form-control" readonly>
                </div>
                
                

                <div class="form-group">
                  <label>No SO</label>
                  <select name="NoSO" id="NoPI" class="form-control" onchange='changeValue(this.value)' >  
                      <option value="">Pilih No SO</option>
                        <?php   
                        $query = mysqli_query($connection, "select t1.NoPI as nop, t1.NoSO as nos, t1.CatID as ctd from sales_order t1 LEFT JOIN prod_order t2 ON t1.NoSO=t2.NoSO where t2.NoPO is null");  
                        $result = mysqli_query($connection, "select t1.NoPI as nop, t1.NoSO as nos, t1.CatID as ctd from sales_order t1 LEFT JOIN prod_order t2 ON t1.NoSO=t2.NoSO where t2.NoPO is null");  
                        $a          = "var NoSO = new Array();"; 
                        $a          = "var CatID = new Array();";     
                        while ($row = mysqli_fetch_array($result)) {  
                              echo '<option name="NoPI" value="'.$row['nos'] . '">' . $row['nos'] . '</option>';   
                        $a .= "NoSO['" . $row['nos'] . "'] = {NoSO:'" . addslashes($row['nop'])."'};"; 
                        $a .= "CatID['" . $row['nos'] . "'] = {CatID:'" . addslashes($row['ctd'])."'};";    
                        }  
                        ?>  
                     </select>
                </div>

                <div class="form-group">
                  <label>No PI</label>
                  <input type="text" name="NoPI" id="NoSO" class="form-control" readonly>
                  
                </div>
<?php

include('koneksi.php');
 
	// mengambil data barang dengan kode paling besar
    $query3 = "SELECT * FROM prod_order";
    $hasil = mysqli_query($connection,$query3);
	$data4 = mysqli_fetch_array($hasil);


?>
                <div class="form-group">
                  <label>Category</label>    
                  <input type="text" name="CatID"  class="form-control" id="CatID" readonly>              
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
                  <input type="text" name="LeadTimePPIC" placeholder="Input Lead Time PPIC" class="form-control" id="id_1">
                </div>

                <div class="form-group">
                  <input type="hidden" name="UserID" value="Mika" class="form-control">
                </div>
              
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
              <br/>
              <div class="table-responsive">
              <table class="table table-hover" id="poTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">Document No.</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">NO PI</th>
                    <th scope="col">NO SO</th>
                    <th scope="col">NO PO</th>
                    <th scope="col">DATE PO</th>
                    <th scope="col">DATE PO SAP</th>
                    <th scope="col">Lead Time PPIC</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT t1.NumDoc as ND, t1.CatID as CAD, t1.NoPI as NP, t1.NoSO as NOS, t1.NoPO as SO, t1.DatePO as DS, t1.DatePOSAP as DSAP, t1.LeadTimePPIC as LTP FROM prod_order t1 left join user t2 on t1.UserID = t2.UserID order by NP asc");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['ND'] ?></td>
                      <td><?php echo $row['CAD'] ?></td>
                      <td><?php echo $row['NP'] ?></td>
                      <td><?php echo $row['NOS'] ?></td>
                      <td><?php echo $row['SO'] ?></td>
                      <td><?php echo date("d-m-Y h:i:s A",strtotime($row['DS'])) ?></td> 
                      <td><?php echo date("d-m-Y h:i:s A",strtotime($row['DSAP'])) ?></td>
                      <td><?php echo date("d-m-Y h:i:s A",strtotime($row['LTP'])) ?></td> 
                      <td class="text-center">
                        <a href="pages/ppic/po/edit-po.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="pages/ppic/po/hapus-po.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-danger">HAPUS</a>
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
  <script src="pages/ppic/po/js/popper.js"></script>
  <script src="pages/ppic/po/js/moment-with-locales.min.js"></script>
  <script src="pages/ppic/po/js/bootstrap-datetimepicker.min.js"></script>
  <script src="pages/ppic/po/js/main.js"></script>
  </body>
</html>

