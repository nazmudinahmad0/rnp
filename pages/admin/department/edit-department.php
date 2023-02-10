<?php 
include '../../../config/database.php';
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM department WHERE DeptID = '$kd' LIMIT 1";

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
              EDIT DEPARTMENT
            </div>
            <div class="card-body">
              <form action="update-department.php" method="POST">
                
                <div class="form-group">
                  <label>ID Department</label>
                  <input type="text" name="DeptID" value="<?php echo $row['DeptID'] ?>" placeholder="Masukkan Department ID" class="form-control">
                  <input type="hidden" name="DeptID" value="<?php echo $row['DeptID'] ?>">
                </div>

                <div class="form-group">
                  <label>Department Name</label>
                  <input type="text" name="DeptName" value="<?php echo $row['DeptName'] ?>" placeholder="Masukkan Department Name" class="form-control">
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
