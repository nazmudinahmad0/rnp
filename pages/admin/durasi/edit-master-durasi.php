<?php 
  include('koneksi.php');
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM dedurasi WHERE id_durasi = '$kd' LIMIT 1";

  $result = mysqli_query($connection, $query);

  $row = mysqli_fetch_array($result);

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Category</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              EDIT DURASI
            </div>
            <div class="card-body">
              <form action="update-durasi.php" method="POST">

              <div class="form-group">
                  
                  <input type="hidden" name="id_durasi" value="<?php echo $row['id_durasi'] ?>" placeholder="Masukkan Category ID" class="form-control">
                  <input type="hidden" name="id_durasi" value="<?php echo $row['id_durasi'] ?>">
                </div>
                
                <div class="form-group">
                  <label>PI-SO</label>
                  <input type="text" name="PI_SO" value="<?php echo $row['PI_SO'] ?>" placeholder="Masukkan Category ID" class="form-control">
                </div>

                <div class="form-group">
                  <label>SO-PO</label>
                  <input type="text" name="SO_PO" value="<?php echo $row['SO_PO'] ?>" placeholder="Masukkan Category Name" class="form-control">
                </div>

                <div class="form-group">
                  <label>LTSales_Finish</label>
                  <input type="text" name="LTSales_Finish" value="<?php echo $row['LTSales_Finish'] ?>" placeholder="Masukkan Category Name" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-success">UPDATE</button>
                <a href="index.php"><button type="submit" class="btn btn-warning">Back</button></a>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
