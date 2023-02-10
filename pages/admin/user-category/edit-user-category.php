<?php 
  
 
  include('koneksi.php');
  
  $kd = $_GET['id'];
  
  $query = "SELECT t1.UserName as user, t3.CatName as kategori , t2.CategoryID as CATID, t2.UserID as said FROM user t1
  left join usercategory t2 on t1.UserID = t2.UserID
  inner join category t3 on t2.CategoryID = t3.CatID WHERE t2.UserID = '$kd' LIMIT 1";

  //$query = "SELECT * FROM usercategory WHERE UserID = '$kd' LIMIT 1";

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
              <form action="update-user-category.php" method="POST">
                
                <div class="form-group">
                  <label>User ID</label>
                  <input type="text" name="said" value="<?php echo $row['user'] ?>" placeholder="Masukkan Category ID" class="form-control" readonly>
                  <input type="hidden" name="said" value="<?php echo $row['said'] ?>">
                </div>

                <div class="form-group">
                  <label>Category ID</label>
                  
                  <select name="CATID" class="form-control">
                    <option value="<?php echo $row['CATID'] ?>">Pilih Category</option>
                    <?php 
                    include('koneksi.php');
                    $combo = $row['CatID'];
                    $query2 = "SELECT * FROM category";
                    $tampil2 = mysqli_query($connection, $query2) or die(mysqli_error());
                    while($data2=mysqli_fetch_array($tampil2))
                    {
                    ?>

                    <?php
              
                      
                     if ($combo == $data2['CatName']) {
                        echo '<option selected="selected" value="'.$data2['CatID'].'">'.$data2['CatName'].'</option>';
              
                      }else{
                        echo '<option value="'.$data2['CatID'].'">'.$data2['CatName'].'</option>';
             
                      }   
              
                    ?>

                    <?php
                    }
                    ?>
                    <option value="<?php echo $data1['CATID'];?>"></option>
                  </select>
                </div>
                
                <button type="submit" class="btn btn-success">UPDATE</button>
                <a href="tambah-user-category.php"><button type="submit" class="btn btn-warning">Back</button></a>

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
