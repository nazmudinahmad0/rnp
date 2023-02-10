<?php 
  
 
  include('koneksi.php');
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM prod_order t1 inner join category t2 on t1.CatID = t2.CatID WHERE NumDoc = '$kd' LIMIT 1";

  $result = mysqli_query($connection, $query);

  $row = mysqli_fetch_array($result);

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Form Transaction Production Order</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              EDIT FORM TRANSACTION PRODUCTION ORDER 
            </div>
            <div class="card-body">
              <form action="update-po.php" method="POST">
                
                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" value="<?php echo $row['NumDoc'] ?>" placeholder="Masukkan Document Number" class="form-control" readonly>
                  <input type="hidden" name="NumDoc" value="<?php echo $row['NumDoc'] ?>">
                </div>

                <div class="form-group">
                  <label>Category</label>
                  <input type="hidden" name="CatID" id="CatID" value="<?php echo $row['CatID'] ?>" class="form-control" readonly>
                  <input type="text" name="CatName" id="CatID" value="<?php echo $row['CatName'] ?>" class="form-control" readonly>
                  
                </div>
                <div class="form-group">
                  <label>No PI</label>
                  <input type="text" name="NoPI" value="<?php echo $row['NoPI'] ?>" placeholder="Input Proforma Invoice Number" class="form-control" readonly>
                  
                </div>

                <div class="form-group">
                  <label>No Sales Order</label>
                  <input type="text" name="NoSO" id="NoSO" value="<?php echo $row['NoSO'] ?>" placeholder="Input Customer Name" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>No Production Order</label>
                  <input type="text" name="NoPO" value="<?php echo $row['NoPO'] ?>" placeholder="Input Customer Name" class="form-control" >
                </div>

                <div class="form-group">
                  <label>Date PO</label>
                  <input type="text" name="DatePO" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  
                  <input type="hidden" name="DatePOSAP" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Date Leadtime PPIC</label>
                  <input type="text" name="LeadTimePPIC" placeholder="Input Date SO SAP" class="form-control" id="id_1">
                </div>

                <div class="form-group">
                  <input type="hidden" name="UserID" value="<?php echo $row['UserID'] ?>" >
                </div>
                
                <button type="submit" class="btn btn-success">UPDATE</button>             

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="js/popper.js"></script>
  
  <script src="js/moment-with-locales.min.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
  <script src="js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#deptTable').DataTable();
      } );
    </script>

  <script src="js/popper.js"></script>
  <script type="text/javascript">
            function isi_otomatis(){
                var NoPI = $("#NoPI").val();
                $.ajax({
                    url: 'proses-ajax.php',
                    data:"NoPI="+NoPI ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#NoSO').val(obj.NoSO);
                });
            }
        </script>
  </body>
</html>
