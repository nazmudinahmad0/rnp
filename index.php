<?php 
session_start();

if (!$_SESSION["username"]){
  header("Location:login.php");
}

include 'config/database.php';
$hasil=mysqli_query($kon,"SELECT * FROM aplikasi LIMIT 1");
$aplikasi = mysqli_fetch_array($hasil); 

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$aplikasi['nama_aplikasi'];?></title>
  
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">-->
  <script src="vendor/jquery/jquery-3.4.1.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<!-- ChartJS -->
<script src="vendor/chart.js/Chart.js"></script>
</head>

<body>

<?php
  include 'config/database.php';
  
  if (isset($_SESSION["id_sales"])){
      $query = mysqli_query($kon, "select * from sales where id_sales='".$_SESSION["id_sales"]."' limit 1"); 
      $row = mysqli_fetch_array($query);
      $nama=$row['nama_sales']; 
  } else if (isset($_SESSION["id_admin"])){
      $query = mysqli_query($kon, "select * from admin where id_admin='".$_SESSION["id_admin"]."' limit 1"); 
      $row = mysqli_fetch_array($query);
      $nama=$row['nama_admin'];
  } else if (isset($_SESSION["id_npd"])){
      $query = mysqli_query($kon, "select * from npd where id_npd='".$_SESSION["id_npd"]."' limit 1"); 
      $row = mysqli_fetch_array($query);
      $nama=$row['nama_npd'];
  } else if (isset($_SESSION["id_fa"])){
      $query = mysqli_query($kon, "select * from fa where id_fa='".$_SESSION["id_fa"]."' limit 1"); 
      $row = mysqli_fetch_array($query);
      $nama=$row['nama_fa'];
  } else if (isset($_SESSION["id_ppic"])){
      $query = mysqli_query($kon, "select * from ppic where id_ppic='".$_SESSION["id_ppic"]."' limit 1"); 
      $row = mysqli_fetch_array($query);
      $nama=$row['nama_ppic'];
  }else if (isset($_SESSION["id_admin_sales"])){
      $query = mysqli_query($kon, "select * from admin_sales where id_admin_sales='".$_SESSION["id_admin_sales"]."' limit 1"); 
      $row = mysqli_fetch_array($query);
      $nama=$row['nama_admin_sales'];
}

?>

  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right shadow-sm" id="sidebar-wrapper">
      <div class="sidebar-heading"><?=$aplikasi['nama_aplikasi'];?></div>
      <div class="list-group list-group-flush">
        <a href="index.php?page=beranda" class="list-group-item list-group-item-action bg-light"><i class="fas fa-home" style="font-size: 25px"></i>  <font valign="middle">Home</font></a>
        <?php if (isset($_SESSION["id_admin"])): ?>
          <a href="index.php?page=user" class="list-group-item list-group-item-action bg-light">User Sales</a>
          <a href="index.php?page=usernpd" class="list-group-item list-group-item-action bg-light">User NPD</a>
          <a href="index.php?page=userfa" class="list-group-item list-group-item-action bg-light">User FA</a>
          <a href="index.php?page=department" class="list-group-item list-group-item-action bg-light">Department</a>
          <a href="index.php?page=npdtype" class="list-group-item list-group-item-action bg-light">NPD Type</a>
          <a href="index.php?page=applications" class="list-group-item list-group-item-action bg-light">Applications</a>
          <a href="index.php?page=frame-detail" class="list-group-item list-group-item-action bg-light">Frame Detail</a>
          <a href="index.php?page=general-information" class="list-group-item list-group-item-action bg-light">General Information</a>
          
          <?php endif; ?>

        <?php if (isset($_SESSION["id_sales"])): ?>
        <a href="index.php?page=rnp" class="list-group-item list-group-item-action bg-light"><i class="fas fa-envelope" style="font-size: 25px"></i>  <font valign="middle">Request New Product</font></a>
       
        <?php endif; ?>
        <?php if (isset($_SESSION["id_ppic"])): ?>
        <a href="index.php?page=ppic" class="list-group-item list-group-item-action bg-light">Production Order</a>
        <a href="index.php?page=finish" class="list-group-item list-group-item-action bg-light">Finish</a>
        
        <?php endif; ?>
        <?php if (isset($_SESSION["id_admin_sales"])): ?>
        <a href="index.php?page=so" class="list-group-item list-group-item-action bg-light">Sales Order</a>
        
        <?php endif; ?>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm ">
  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?=$nama; ?>
              </a>
	      
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                
		
		            <a class="dropdown-item" href="index.php?page=profil">Profil</a>
                <a class="dropdown-item" href="logout.php">Keluar</a>

              </div>
	   
            </li>

		<li class="nav-item">
		<a href="index.php?page=beranda" class="nav-link">Beranda</a>

		</li>
		
		<li class="nav-item">

		<?php if (isset($_SESSION["id_ppic"])): ?>
        	<a class="nav-link" href="index.php?page=ppic">Production Order</a>
        	<?php endif; ?>
		</li>

    <li class="nav-item">

		<?php if (isset($_SESSION["id_ppic"])): ?>
        	<a class="nav-link" href="index.php?page=finish">Finish</a>
        	<?php endif; ?>
		</li>

		<li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=user" class="nav-link">User Sales</a>
              	<?php endif; ?>
		</li>

    <li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=usernpd" class="nav-link">User Npd</a>
              	<?php endif; ?>
		</li>

    <li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=userfa" class="nav-link">User FA</a>
              	<?php endif; ?>
		</li>
		
		<li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=department" class="nav-link">Department</a>
              	<?php endif; ?>
		</li>

    <li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=npdtype" class="nav-link">NPD Type</a>
              	<?php endif; ?>
		</li>

    <li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=applications" class="nav-link">Applications</a>
              	<?php endif; ?>
		</li>

    <li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=frame-detail" class="nav-link">Frame Detail</a>
              	<?php endif; ?>
		</li>
		<!--<li class="nav-item">-->
		
		<li class="nav-item">

		<?php if (isset($_SESSION["id_admin"])): ?>
          	<a href="index.php?page=general-information" class="nav-link">General Information</a>
          	<?php endif; ?>
		</li>

		<li class="nav-item">
		<?php if (isset($_SESSION["id_admin_sales"])): ?>

        	<a href="index.php?page=so" class="nav-link">Sales Order</a>
        	<?php endif; ?>
		
		</li>
		<li class="nav-item">
		<?php if (isset($_SESSION["id_sales"])): ?>

               	<a href="index.php?page=rnp" class="nav-link">Request New Product</a>
        	<?php endif; ?>
		
		</li>
    

          </ul>
        </div>
      </nav>

      <div class="container-fluid">

        <?php
            include 'config/database.php';
            include 'config/helper.php';
            
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            
                switch ($page) {
                    case 'beranda':

                      if (isset($_SESSION["id_admin"])){
                        include "pages/admin/beranda/index.php";
                      } else if (isset($_SESSION["id_sales"])){
                        include "pages/sales/beranda/index.php";
                      }else if (isset($_SESSION["id_npd"])){
                        include "pages/npd/beranda/index.php";
                      }else if (isset($_SESSION["id_fa"])){
                        include "pages/fa/beranda/index.php";
                      }else if (isset($_SESSION["id_ppic"])){
                        include "pages/ppic/beranda/index.php";
                      }else if (isset($_SESSION["id_admin_sales"])){
                        include "pages/admin_sales/beranda/index.php";
                      }
                      
                      break;
                    case 'profil':

                      if (isset($_SESSION["id_admin"])){
                        include "pages/admin/profil/index.php";
                      } else if (isset($_SESSION["id_sales"])){
                        include "pages/sales/profil/index.php";
                      }else if (isset($_SESSION["id_ppic"])){
                        include "pages/ppic/profil/index.php";
                      }else if (isset($_SESSION["id_admin_sales"])){
                        include "pages/admin_sales/profil/index.php";
                      }else if (isset($_SESSION["id_npd"])){
                        include "pages/npd/profil/index.php";
                      }


                      break;
                    case 'aplikasi':
                      include "pages/admin/aplikasi/index.php";
                    break;
                    case 'user':
                      include "pages/admin/user/index.php";
                    break;
                    case 'usernpd':
                      include "pages/admin/usernpd/index.php";
                    break;
                    case 'userfa':
                      include "pages/admin/userfa/index.php";
                    break;
                    case 'department':
                      include "pages/admin/department/index.php";
                    break;
                    case 'npdtype':
                      include "pages/admin/npd-type/index.php";
                    break;
                    case 'applications':
                      include "pages/admin/applications/index.php";
                    break; 
                    case 'frame-detail':
                      include "pages/admin/frame-npd/index.php";
                    break;
                    case 'general-information':
                      include "pages/admin/general-information/index.php";
                    break;
                    case 'so':
                        include "pages/sales/so/index.php";
                        break;
                      case 'pi':
                        include "pages/sales/pi/index.php";
                        break;
                      case 'rnp':
                        include "pages/sales/rnp/index.php";
                         break;
                         case 'edit-rnp':
                          include "pages/sales/edit-rnp/index.php";
                           break;
                           case 'history-rnp':
                            include "pages/sales/beranda/history.php";
                             break;
                             case 'history-rnp-npd':
                              include "pages/npd/beranda/history.php";
                               break;
                               case 'history-rnp-fa':
                                include "pages/fa/beranda/history.php";
                                 break;
                         case 'index-rnp':
                          include "pages/npd/beranda/index.php";
                           break;
                           case 'index-rnp-fa':
                            include "pages/fa/beranda/index.php";
                             break;
                    case 'ppic':
                      include "pages/ppic/po/index.php";
                      break;
                      case 'finish':
                        include "pages/ppic/finish/index.php";
                        break;
                        case 'beranda-sales':
                          include "pages/sales/beranda/index.php";
                          break;
                          case 'beranda-admin-sales':
                            include "pages/admin_sales/beranda/index.php";
                            break;
                            case 'beranda-ppic':
                              include "pages/ppic/beranda/index.php";
                              break;
                         


                      

                default:
                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                    break;
                }
            }
        ?>


      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("togglede");
    });
  </script>

</body>

</html>
