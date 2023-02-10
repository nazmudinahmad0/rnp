<?php 
include '../../../config/database.php';
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM npdtype WHERE NPDTypeID = '$kd' LIMIT 1";

  $result = mysqli_query($kon, $query);

  $row = mysqli_fetch_array($result);

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Department</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              EDIT NPD TYPE
            </div>
            <div class="card-body">
              <form action="npd-type-update.php" method="POST">
                
                <div class="form-group">
                  <label>NPD Type ID</label>
                  <input type="text" name="NPDTypeID" value="<?php echo $row['NPDTypeID'] ?>" placeholder="Masukkan NPD Type ID" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>NPD Type Name</label>
                  <input type="text" name="NPDTypeName" value="<?php echo $row['NPDTypeName'] ?>" placeholder="Masukkan NPD Type Name" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-sm btn-success">UPDATE</button>
                <a href="index.php"><button type="submit" class="btn btn-sm btn-warning">Back</button></a>

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
