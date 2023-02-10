<?php 
include '../../../config/database.php';
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM frame_detail WHERE FrameID = '$kd' LIMIT 1";

  $result = mysqli_query($kon, $query);

  $row = mysqli_fetch_array($result);

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Frame Detail</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              EDIT FRAME DETAIL
            </div>
            <div class="card-body">
              <form action="update-frame-npd.php" method="POST">
                
                <div class="form-group">
                  <label>Frame Detail ID</label>
                  <input type="text" name="FrameID" value="<?php echo $row['FrameID'] ?>" placeholder="Masukkan Frame Detail ID" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Frame Detail Name</label>
                  <input type="text" name="FrameName" value="<?php echo $row['FrameName'] ?>" placeholder="Masukkan Frame Detail Name" class="form-control">
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
