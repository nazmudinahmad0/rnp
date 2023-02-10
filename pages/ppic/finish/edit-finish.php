<?php 
  
 
  include('koneksi.php');
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM finish WHERE NumDoc = '$kd' LIMIT 1";

  $result = mysqli_query($connection, $query);

  $row = mysqli_fetch_array($result);

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Form Transaction Finish</title>
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
              EDIT FORM FINISH
            </div>
            <div class="card-body">
              <form action="update-finish.php" method="POST">
                
                <div class="form-group">
                  <label>Document Number</label>
                  <input type="text" name="NumDoc" value="<?php echo $row['NumDoc'] ?>" placeholder="Masukkan Document Number" class="form-control">
                  <input type="hidden" name="NumDoc" value="<?php echo $row['NumDoc'] ?>">
                </div>

                <div class="form-group">
                  <label>Category</label>
                  <select name="CatID" class="form-control">
                    <option value="<?php echo $row['CatID'] ?>">Pilih Category</option>
                    <?php 
                    include('koneksi.php');
                    $combo = $row['CatID'];
                    $query1 = "SELECT * FROM category";
                    $tampil1 = mysqli_query($connection, $query1) or die(mysqli_error());
                    while($data1=mysqli_fetch_array($tampil1))
                    {
                    ?>

                    <?php
              
                      
                     if ($combo == $data1['CatName']) {
                        echo '<option selected="selected" value="'.$data1['CatID'].'">'.$data1['CatName'].'</option>';
              
                      }else{
                        echo '<option value="'.$data1['CatID'].'">'.$data1['CatName'].'</option>';
             
                      }   
              
                    ?>

                    <?php
                    }
                    ?>
                    <option value="<?php echo $data1['CatName'];?>"></option>
                  </select>
                  
                </div>
                <div class="form-group">
                  <label>No PI</label>
                  <input type="text" name="NoPI" value="<?php echo $row['NoPI'] ?>" placeholder="Input Proforma Invoice Number" class="form-control">
                </div>

                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="DateFinish" placeholder="Input Date Sales Order" class="form-control" id="id_0">
                </div>

                <div class="form-group">
                <label>Status</label>
                  <input type="text" name="status_ok" value = "Close" class="form-control" readonly>
                </div>

                <div class="form-group">
                <input type="hidden" name="UserID" value="Mika">
                  
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
  </body>
</html>
