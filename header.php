<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <style type="text/css">
    

  </style>
  <title>Gestion de veaux</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" 
  rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="acceuil.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-hippo "></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dachboard</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        <p style="font-size: 15px;
          ">gérer le bétail </p>
      </div>
      <li class="nav-item">
        <a class="nav-link" href="livestock.php">
          
          <span style="font-size: 20px;
                       ">Liste des animaux</span></a>
      </li>
    <li class="nav-item">
        <a class="nav-link" href="createLivestock.php">
          
          <span style="font-size: 20px;
                       ">add livestock</span></a>
      </li>
    <li class="nav-item">
        <a class="nav-link" href="livestockType.php">
          
          <span style="font-size: 20px;
                       ">livestock type</span></a>
      </li>
    <li class="nav-item">
        <a class="nav-link" href="herd.php">
          
          <span style="font-size: 20px;
                       ">herds</span></a>
      </li>
    <li class="nav-item">
        <a class="nav-link" href="transport.php">
          
          <span style="font-size: 20px;
                       ">Transport</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
       <p style="font-size: 15px;
          font-family: courier;"> vaccins et bilans de santé </p>
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="vaccine.php">
          
          <span style="font-size: 20px;
                       ">vaccinations</span></a>
      </li>
      

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="bilanSante.php">
          
          <span style="font-size: 20px;
                    ">bilans de santé</span></a>
      </li>
    <li class="nav-item">
        <a class="nav-link" href="stockMedicament.php">
          
          <span style="font-size: 20px;
                       ">Stock Medicament</span></a>
      </li>
    <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
       <p style="font-size: 15px;
          font-family: courier;"> Financiers </p>
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="vente.php">
          
          <span style="font-size: 20px;
                       ">Vents</span></a>
      </li>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="achat.php">
          
          <span style="font-size: 20px;">Achat</span></a>
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
              
              <div class="input-group-append">
               
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
                      
                    </div>
                  </div>
                </form>
              </div>
            </li>

              
            
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <span class="mr-2 d-none d-lg-inline text-gray-900 small">ADMIN</span>
               
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
            
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total des veaux</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
       $db = new PDO ('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
       $cat = $db->query("select * from livestock");
       $cat->execute();
       $row=$cat->fetchAll();
      echo 
        ''.(count($row));
      ?>  
                     </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hippo fa-2x text-red-1000"></i>
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">le nombre des maladies</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
        <?php 
       $db = new PDO ('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
       $cat = $db->query("select * from vaccine");
       $cat->execute();
       $row=$cat->fetchAll();
      echo 
        ''.(count($row));
      ?>  
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-md fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Totale des ventes
                      </div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                      <?php 
          $db = new PDO ('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
          $cat = $db->query("SELECT SUM(prixVente) as total FROM vente WHERE id>=1 ");
          $data=$cat->fetch();
          $sommeanswered = $data['total'];
        
         // $cat->execute();
          //$row=$cat->fetchAll();
          echo 'Total : '.$sommeanswered;
          echo "dh";
          
           ?>        
                       </div>
                <?php 
          $db = new PDO ('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
          $cat = $db->query("SELECT id FROM vente ");
          //$data=$cat->fetch();
          //$sommeanswered = $data['total'];
         $cat->execute();
          $row=$cat->fetchAll();
          echo 'nombre vendu : '.(count($row));
          
           ?>        
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="  far fa-money-bill-alt fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Prestation</div>
                    <?php 
       $db = new PDO ('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
       $cat = $db->query("select * from prestation");
       $cat->execute();
       $row=$cat->fetchAll();
      echo 
        ''.(count($row));
      ?>  
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