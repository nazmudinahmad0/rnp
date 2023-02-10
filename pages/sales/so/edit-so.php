<?php 
  
 
  include('koneksi.php');
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM sales_order t1 inner join category t2 ON t1.CatID = t2.CatID WHERE NumDoc = '$kd' LIMIT 1";

  $result = mysqli_query($connection, $query);

  $row = mysqli_fetch_array($result);

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Form Transaction Sales Order</title>
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
              EDIT FORM TRANSACTION SALES ORDER
            </div>
            <div class="card-body">
              <form action="update-so.php" method="POST">
                
                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" value="<?php echo $row['NumDoc'] ?>" placeholder="Masukkan Document Number" class="form-control" readonly>
                  <input type="hidden" name="NumDoc" value="<?php echo $row['NumDoc'] ?>">
                </div>

                <div class="form-group">
                  <label>Category</label>
                  <input type="hidden" name="CatID" value="<?php echo $row['CatID'] ?>" class="form-control" readonly>
                  <input type="text" name="CatName" value="<?php echo $row['CatName'] ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>No PI</label>
                  <input type="text" name="NoPI" value="<?php echo $row['NoPI'] ?>" placeholder="Input Proforma Invoice Number" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>No Sales Order</label>
                  <input type="text" name="NoSO" value="<?php echo $row['NoSO'] ?>" placeholder="Input Customer Name" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Status SO </label>
                  <!--<input type="text" name="NoSO" placeholder="Input Sales Order Number" class="form-control">-->
                  <select name="status_so" class="form-control">
                        <option name="status_so" value="<?php echo $row['status_so']  ?>"><?php echo $row['status_so']  ?></option>
                        <?php if($row['status_so'] == 'Not Complete'){ echo '<option name="status_so" value="Complete">Complete</option>';}
                        else{echo '<option name="status_so" value="Not Complete">Not Complete</option>';}
                        ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="DateSO" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <input type="hidden" name="DateSOSAP" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("m/d/Y H:i:s");?>" class="form-control">
                </div>

                <div class="form-group">
                  <input type="hidden" name="UserID" class="form-control" value="Fauzi">
                </div>
                
                <button type="submit" class="btn btn-success">UPDATE</button>
                <!--<a href="transaction-pi.php"><button class="btn btn-warning">Back</button></a>-->
                <!--<a href="index.php">kembali</a>-->
               

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
  </body>
</html>
