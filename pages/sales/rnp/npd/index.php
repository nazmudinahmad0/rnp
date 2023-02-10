<?php
    include 'config/database.php';
    $username = $_SESSION['username'];
    $query9 ="select * from npd where username='".$username."' limit 1"; 
    $hasil9 = mysqli_query($kon,$query9);
    $data7  = mysqli_fetch_array($hasil9);                      
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Data Transaction Proforma Invoice</title>
    <link rel="stylesheet" href="pages/sales/pi/css/style.css">
	  <link rel="stylesheet" href="pages/sales/pi/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  </head>
  <body>
  <div class="container" style="margin-top: 25px">
  <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="deptTable">
                <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Doc. Number</th>
                    <th scope="col">Date Request</th>
                    <th scope="col">NPD Type</th>
                    <th scope="col">NPD Type Name</th>
                    <th scope="col">Code Project</th>
                    <th scope="col">Prod. Name</th>
                    <!--<th scope="col">CUSTOMER</th>-->
                    <th scope="col">Customer</th>
                    <!--<th scope="col">User</th>-->
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php 
                            include 'config/database.php';
                            $no = 1;
                            $query = mysqli_query($kon,"SELECT * FROM tdocument");
                            while($row = mysqli_fetch_array($query)){
                        ?>

                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['NumDoc'] ?></td>
                            <td><?php echo $row['DateRequest'] ?></td>
                            <td><?php echo $row['NPDType'] ?></td>
                            <td><?php echo $row['NPDTypeName'] ?></td>
                            <td><?php echo $row['CodeProject'] ?></td>
                            <td><?php echo $row['Prod_Name'] ?></td>
                            <td><?php echo $row['CustName'] ?></td> 
                            <td class="text-center">
                            <a href="pages/sales/pi/edit-pi.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-regular fa-edit"></i></a>
                            <a href="pages/sales/pi/hapus-pi.php?id=<?php echo $row['ND'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-regular fa-trash"></i></a>
                            </td>
                        </tr>

                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
  </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
        $('#deptTable').DataTable();
    } );
  </script>

  <script src="page/sales/pi/js/popper.js"></script>
  <script src="pages/sales/pi/js/moment-with-locales.min.js"></script>
  <script src="pages/sales/pi/js/bootstrap-datetimepicker.min.js"></script>
  <script src="pages/sales/pi/js/main.js"></script>
  </body>
</html>