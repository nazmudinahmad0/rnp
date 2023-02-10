<?php 
  
 
  include('koneksi.php');
  
  $kd = $_GET['id'];
  
  $query = "SELECT * FROM category WHERE CatID = '$kd' LIMIT 1";

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
              EDIT CATEGORY
            </div>
            <div class="card-body">
              <form action="update-category.php" method="POST">
                
                <div class="form-group">
                  <label>ID Category</label>
                  <input type="text" name="CatID" value="<?php echo $row['CatID'] ?>" placeholder="Masukkan Category ID" class="form-control">
                  <input type="hidden" name="CatID" value="<?php echo $row['CatID'] ?>">
                </div>

                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" name="CatName" value="<?php echo $row['CatName'] ?>" placeholder="Masukkan Category Name" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-success">UPDATE</button>
                <a href="tambah-category.php"><button type="submit" class="btn btn-warning">Back</button></a>

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
