<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Data User Category</title>
  </head>

  <body>
    <!--Kode Otomatis-->
    <?php
      //include 'koneksi.php';
      //$query2 = mysqli_query($connection, "SELECT max(UserID) as kodeTerbesar FROM user");
      //$data2 = mysqli_fetch_array($query2);
      //$kodeUser = $data2['kodeTerbesar'];
      //$urutan = (int) substr($kodeUser, 3, 3);
      //$urutan++;
      //$huruf = "U";
      //$kodeUser = $huruf . sprintf("%03s", $urutan);
    //?>

    <div class="container" style="margin-top: 17px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              TAMBAH USER CATEGORY
            </div>
            <div class="card-body">
             <form action="pages/admin/user-category/simpan-user-category.php" method="POST">
                
                <div class="form-group">
                  <label>User</label>
                  <!--<input type="text" name="UserID" placeholder="Input User ID" required="required" class="form-control" >-->
                  <select name="UserID" class="form-control">
                    <option value="">Pilih User Name</option>
                    <?php 
                    include('koneksi.php');
                    $combo = $row['UserID'];
                    $query1 = "SELECT * FROM user";
                    $tampil1 = mysqli_query($connection, $query1) or die(mysqli_error());
                    while($data1=mysqli_fetch_array($tampil1))
                    {
                    ?>

                    <?php
                                    
                     if ($combo == $data1['UserName']) {
                        echo '<option selected="selected" value="'.$data1['UserID'].'">'.$data1['UserName'].'</option>';
              
                      }else{
                        echo '<option value="'.$data1['UserID'].'">'.$data1['UserName'].'</option>';
             
                      }   
              
                    ?>

                    <?php
                    }
                    ?>
                    <option value="<?php echo $data1['UserID'];?>"></option>
                  </select>

                </div>

                <div class="form-group">
                  <label>Category</label>
                  <!--<input type="text" name="CategoryID" placeholder="Input Category ID" class="form-control">-->
                  <select name="CategoryID" class="form-control">
                    <option value="">Pilih Category</option>
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
                    <option value="<?php echo $data1['CatName'];?>"></option>
                  </select>
                </div>
              
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
              <br/>
              <div class ="table-responsive">
              <table class="table table-hover" id="catTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">USER</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"select t1.UserName as user, t3.CatName as kategori,t2.UserID as CID  from user t1
                      left join usercategory t2 on t1.UserID = t2.UserID
                      inner join category t3 on t2.CategoryID = t3.CatID");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['user'] ?></td>
                      <td><?php echo $row['kategori'] ?></td>
                      <td class="text-center">
                        <a href="pages/admin/user-category/edit-user-category.php?id=<?php echo $row['CID'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="pages/admin/user-category/hapus-user-category.php?id=<?php echo $row['CID'] ?>" class="btn btn-sm btn-danger">HAPUS</a>
                      </td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#catTable').DataTable();
      } );
    </script>
  </body>
</html>
