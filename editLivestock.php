<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$idl = $_GET['idl'];
$sql = 'SELECT * FROM livestock WHERE idl=:idl';
$statement = $connection->prepare($sql);
$statement->execute([':idl' => $idl ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['type'])
   &&isset($_POST['Troupeau'])
   &&isset($_POST['sexe'])  
   &&isset($_POST['ID'])  
    &&isset($_POST['DateNaissance']) 
    &&isset($_POST['PoidsNaissance'])
    &&isset($_POST['dateAchat']) 
    &&isset($_POST['PrixAchat']) 
    &&isset($_POST['PoidsAchat'])) {
  $type = $_POST['type'];
 $Troupeau = $_POST['Troupeau'];
  $sexe = $_POST['sexe'];
  $ID = $_POST['ID'];
  $DateNaissance = $_POST['DateNaissance'];
  $PoidsNaissance = $_POST['PoidsNaissance'];
  $dateAchat = $_POST['dateAchat'];
  $PrixAchat = $_POST['PrixAchat'];
  $PoidsAchat = $_POST['PoidsAchat'];
  
  $sql = 'UPDATE livestock SET type=:type,
     Troupeau=:Troupeau, sexe=:sexe, 
     ID=:ID, DateNaissance=:DateNaissance,
      PoidsNaissance=:PoidsNaissance, 
      dateAchat=:dateAchat, PrixAchat=:PrixAchat,
       PoidsAchat=:PoidsAchat
          WHERE idl=:idl';
  $statement = $connection->prepare($sql);
 
  if ($statement->execute([':type' => $type,
   ':Troupeau' => $Troupeau, ':sexe' => $sexe, 
   ':ID' => $ID, ':DateNaissance' => $DateNaissance, 
   ':PoidsNaissance' => $PoidsNaissance, ':dateAchat' => $dateAchat,
    ':PrixAchat' => $PrixAchat, ':PoidsAchat' => $PoidsAchat, 
    ':idl' => $idl])) {
    header("Location: livestock.php");
  }
}
 ?>
<?php require 'header.php'; ?>
<!-- ******************************************************************************-->
<?php //require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">

          <label for="type">type</label>
          <input value="<?= $person->type; ?>" type="text" name="type" id="type" class="form-control">
        </div>
		
		<div class="form-group">
          <label for="Troupeau">Troupeau</label>
          <input value="<?= $person->Troupeau; ?>" type="text" name="Troupeau" id="Troupeau" class="form-control">
        </div>
		<div class="form-group">
          <label for="sexe">sexe</label>
          <input value="<?= $person->sexe; ?>" type="text" name="sexe" id="sexe" class="form-control">
        </div>
		<div class="form-group">
          <label for="ID">ID</label>
          <input value="<?= $person->ID; ?>" type="text" name="ID" id="ID" class="form-control">
        </div>
		
		<div class="form-group">
          <label for="DateNaissance">DateNaissance</label>
          <input value="<?= $person->DateNaissance; ?>" type="text" name="DateNaissance" id="DateNaissance" class="form-control">
        </div>
		<div class="form-group">
          <label for="PoidsNaissance">PoidsNaissance</label>
          <input value="<?= $person->PoidsNaissance; ?>" type="text" name="PoidsNaissance" id="PoidsNaissance" class="form-control">
        </div>
		<div class="form-group">
          <label for="dateAchat">dateAchat</label>
          <input value="<?= $person->dateAchat; ?>" type="text" name="dateAchat" id="dateAchat" class="form-control">
        </div>
		
		<div class="form-group">
          <label for="PrixAchat">PrixAchat</label>
          <input value="<?= $person->PrixAchat; ?>" type="text" name="PrixAchat" id="PrixAchat" class="form-control">
        </div>
        <div class="form-group">
          <label for="PoidsAchat">PoidsAchat</label>
          <input value="<?= $person->PoidsAchat; ?>" type="text" name="PoidsAchat" id="PoidsAchat" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update person</button>
		 <a href="livestock.php">back</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>
 <!-- ***************************************************************************** -->
          <?php require 'footer.php'; ?>