<?php

    include '../../../config/database.php';
    $id = $_GET['kd'];

    $query = "select * from npd WHERE id_npd = '$id' LIMIT 1";
    
    $result = mysqli_query($kon,$query);
    $row = mysqli_fetch_array($result);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit User</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              EDIT USER NPD
            </div>
            <div class="card-body">
              <form action="update-user-npd.php" method="POST">
                
                <div class="form-group">
                  <!--<input type="text" name="kode_sales" value="" class="form-control" readonly>-->
                  <input type="hidden" name="kode_npd" value="<?php echo $row['kode_npd'] ?>">
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" value="<?php echo $row['username'] ?>" class="form-control">
                </div>

                <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="<?php echo $row['password'] ?>" class="form-control">
                </div>

                <button type="submit" class="btn btn-sm btn-success">UPDATE</button>
                <!--<a href="index.php"><button type="submit" class="btn btn-warning">Backed</button></a>-->
                <a href="../../../index.php?page=usernpd" class="btn btn-sm btn-warning">Back</a>

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