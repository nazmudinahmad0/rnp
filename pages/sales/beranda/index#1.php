<?php
                      include 'config/database.php';
                      $query ="select * from sales where id_sales='".$_SESSION["id_sales"]."' limit 1"; 
                      $hasil=mysqli_query($kon,$query);
                      $data7 = mysqli_fetch_array($hasil);
                      
                  ?>
<?php 

$acv = $data7['sales_category'];

?>
                  
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"> 
<hr>
<div class="card">
    <div class="card-body">
        <h3>Beranda</h3><hr>
        <div class="table-responsive">
              <table class="table table-bordered table-hover" id="deptTable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">No PI</th>
                    <th scope="col">Date PI</th>
                    <th scope="col">Category</th>
                    <th scope="col">No SO</th>
                    <th scope="col">Date SO</th>
                    <th scope="col">Status SO</th>
                    <th scope="col">No PO</th>
                    <th scope="col">Date PO</th>
                    <th scope="col">LT Sales</th>
                    <th scope="col">LT PPIC</th>
                    <th scope="col">Finish</th>
                    <th scope="col">Status</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                    include('koneksi.php');
                    $hasil=mysqli_query($kon,"SELECT * FROM dedurasi limit 1");
                    $dasi = mysqli_fetch_array($hasil); 
    
                      ?>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"select t1.NoPI as a,t1.Customer as ac, t1.DatePI as b, t5.CatName as ctn, t2.NoSO as c,t2.DateSO as d,t2.status_so as sso, t3.NoPO as e,t3.DatePO as f,t1.LeadTimeMKT as g,t3.LeadTimePPIC as h,t4.DateFinish as i,t4.status_ok as j from proforma_inv t1 
                      LEFT JOIN sales_order t2 ON t1.NoPI=t2.NoPI
                      LEFT JOIN prod_order t3 ON t2.NoPI=t3.NoPI and t2.NoSO=t3.NoSO
                      LEFT JOIN finish t4 ON t3.NoPI=t4.NoPI 
                      LEFT JOIN category t5 ON t1.CatID = t5.CatID order by t1.NoPI asc");
                      while($row = mysqli_fetch_array($query)){
                  ?>
                 <?php
                    $tgla = $row['b'];
                    $tglb = $row['d'];
                    $tglc = $row['f'];
                    $tgld = $row['g'];
                    $tgle = $row['i'];
                    $awal  = strtotime($tgla);
                    $akhir = strtotime($tglb); 
                    $tengah = strtotime($tglc);
                    $simak = strtotime($tgld);
                    $door = strtotime($tgle);
                    $diff  = $akhir - $awal;
                    $loc   = $tengah - $akhir;
                    $blur = $door - $simak;
                    $mkd = floor($diff / (60 * 60));
                    $cus = floor($loc / (60 * 60));
                    $wah = floor($blur / (60 * 60));
                    if($mkd >= 0 AND $mkd<=$dasi['PI_SO']){
                      $color = "style='background-color: #90EE90;'";
                    }elseif($mkd<0){
                      $color = "style='background-color: none;'";
                    }else{
                        $color = "style='background-color: #F75D59;'";  
                    }
                    if($cus > 0 AND $cus<=$dasi['SO_PO']){
                      $warna = "style='background-color: #90EE90;'";
                    }
                    elseif($cus <= 0){
                        $warna = "style='background-color: none;'";
                      }
                    else{
                      $warna = "style='background-color: #F75D59;'";
                    }
                    if($wah>=0 AND $wah<=$dasi['LTSales_Finish']){
                        $misal = "style='background-color: #90EE90;'";
                      }elseif($wah<0){
                        $misal = "style='background-color: none;'";
                      }else{
                        $misal = "style='background-color: #F75D59;'";
                      }

                    ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['a'] ?></td>
                      <td><?php echo $row['b'] ?></td>
                      <td><?php echo $row['ctn'] ?></td>
                      <td><?php echo $row['c'] ?></td>
                      <td <?= $color ?>><?php echo $row['d'] ?></td>
                      <td><?php echo $row['sso'] ?></td>
                      <td><?php echo $row['e'] ?></td>
                      <td <?= $warna ?>><?php echo $row['f'] ?></td>
                      <td><?php echo $row['g'] ?></td>
                      <td><?php echo $row['h'] ?></td>
                      <td <?= $misal ?>><?php echo $row['i'] ?></td>
                      <td><?php echo $row['j'] ?></td>
                     

                  </tr>

                <?php } ?>
                </tbody>
              </table>
              
              
              </div>
        
        
    </div> 
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#deptTable').DataTable();
      } );

      $('.btn_edit').on('click',function(){

      var NoPI = $(this).attr("NoPI");
      var Customer = $(this).attr("Customer");
      var DatePI = $(this).attr("DatePI");
      $.ajax({
          url: 'pages/sales/beranda/edit.php',
          method: 'post',
          data: {Customer:Customer,NoPI:NoPI,DatePI:DatePI},
          success:function(data){
              $('#tampil_data').html(data);  
              document.getElementById("judul").innerHTML='Edit PI #'+Customer;
          }
      });
          // Membuka modal
      $('#modal').modal('show');
      });

    </script>

    <script src="js/jquery-1.11.2.min.js"></script>
	  <!-- js untuk bootstrap -->
	  <script src="js/bootstrap.js"></script>
