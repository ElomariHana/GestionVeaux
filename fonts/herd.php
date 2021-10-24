<?php
session_start();
$action = 'lister';
$action1 = '';
$id='';
$herd = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$action = $_POST['action'];
	if ($action == "enregistrer" || $action == "modifier") {
	$herd = $_POST['herd'];
	$id = $_POST['id'];
	
	
	$db = new PDO('mysql:host=localhost;dbname=livestock;charset=utf8', 'root', '');
	if ($action == "enregistrer") {
	$requette_sql = "INSERT INTO herd (herd) values('$herd')";
	}else if ($action == "modifier") {
		$id = $_POST['id'];
	$requette_sql = "update herd set herd='$herd' where id='$id'";
	} 
	$qresult = $db->query($requette_sql);
	$qresult->closeCursor();
	$action = 'lister';
	}
}
if(isset($_GET['action1'])){ 
    $action1 = $_GET['action1'];
	
}
 if ($action1 == "edite") {
	$id = $_GET['id'];
	$db = new PDO('mysql:host=localhost;dbname=livestock;charset=utf8', 'root', '');
	$stmt  = $db->prepare("SELECT * FROM herd WHERE id=:id");
	$stmt->bindparam(":id", $id);
	$stmt->execute();
	if ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
	     $count = count( $rows );
	$herd= $rows["herd"];
	$id= $rows['id'];
	}
}
if ($action1 == "delete") {
	$id = $_GET['id'];
	$db = new PDO('mysql:host=localhost;dbname=livestock;charset=utf8', 'root', '');
	$cat = $db->query("delete FROM herd WHERE id='$id'");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin 2 - Dashboard</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        gérer le bétail
      </div>
      <li class="nav-item">
        <a class="nav-link" href="achat.php">
          
          <span>Liste des animaux</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="achat.php">
          
          <span>add livestock</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="achat.php">
          
          <span>livestock type</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="achat.php">
          
          <span>herds</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        vaccins et bilans de santé
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
	  <li class="nav-item">
        <a class="nav-link" href="vaccine.php">
          
          <span>vaccinations</span></a>
      </li>
      

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="bilans.php">
          
          <span>bilans de santé</span></a>
      </li>
	  <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
       Financiers
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
	  <li class="nav-item">
        <a class="nav-link" href="vents.php">
          
          <span>sals(vents)</span></a>
      </li>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="achat.php">
          
          <span>purcharse(achat)</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="frais.php">
         
          <span>expenses(frais)</span></a>
      </li>
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

              
            
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hana Elomari</span>
               
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="deconnexion.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <div class="container-fluid">
 <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">

<!-- ******************************************************************************-->
 
<tr> <td></td> <td>
 <form action='herd.php' method='post'>
<?php
$db = new PDO('mysql:host=localhost;dbname=livestock;charset=utf8', 'root', '');
$cat = $db->query("SELECT * FROM herd");
echo' <center> <h2> Listes des li </h2> </center>';
 echo '                   
<table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
    <thead>
    	<tr  class="dialogTitle1">
 
        <th>herd</th>
			
        </tr>
    </thead>
    <tbody>';
                  while ($data = $cat->fetch()) 		
                  {
                    echo "<tr>";
	
				echo "<td>".$data['herd']."</td>";
				
		
				echo"<td><a href='herd.php?action1=edite&id=".$data['id']."'><img src='images/edit.png' alt='' title='' border='0' /></a>
				<a href='herd.php?action1=delete&id=".$data['id']."' class='ask'><img src='images/Remove-Male-User.png' alt='' title='' border='0' /></a>
				</td>";
			echo "</tr>";
   } 			echo "<tr><td colspan='5' align='right'><input type='submit' class='btn btn-primary' name='action'style='background-color:#7b92b4' value='nouveau'></td></tr>";
    echo'</tbody>
</table>';

?>


<?php if($action == "nouveau"){ ?>
<br>
<br>
<br>
<br>
<center><div class="card text-center" style="width: 80rem;">
  <div>
       Formulaire
    </div>
<input type="hidden" name="id" value="<?php echo $id;?>">
<table id="example" class="table table-dark" width="100%">
                                                     	
<tr> <td>Herd </td> <td><input type="text"  class="form-control" name="herd" value="<?php echo $herd;?>"><br></td> </tr>
<tr> <td></td> <td>
        <?php
	if ($action1 == 'edite') {
	echo'<input type="submit" name="action" class="btn btn-primary" value="modifier">';
	}else{
	echo'<input type="submit" class="btn btn-primary" name="action"  style="background-color:#7b92b4" value="enregistrer">';
	}
	?>
</td>
</tr>
</table>

  </div></center>
<?php } ?>

</form>



           
 <!-- ***************************************************************************** -->
          <div class="copyright text-center my-auto">
		  
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="deconnexion.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>
