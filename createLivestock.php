<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$message = '';
if (isset ($_POST['type'])  
 && isset($_POST['Troupeau'])  
 && isset($_POST['sexe'])  
 && isset($_POST['ID'])    
 && isset($_POST['DateNaissance']) 
 &&isset($_POST['PoidsNaissance'])  
 && isset($_POST['dateAchat'])  
 && isset($_POST['PrixAchat'])  
 && isset($_POST['PoidsAchat']) )
	{
  $type = $_POST['type'];
  $Troupeau = $_POST['Troupeau'];
  $sexe = $_POST['sexe'];
  $ID = $_POST['ID'];
  $DateNaissance = $_POST['DateNaissance'];
  $PoidsNaissance = $_POST['PoidsNaissance'];
  $dateAchat = $_POST['dateAchat'];
  $PrixAchat = $_POST['PrixAchat'];
  $PoidsAchat = $_POST['PoidsAchat'];
  $connection->beginTransaction();
  try{  

   $sql =$connection->prepare("INSERT INTO livestock
     (type, Troupeau, sexe, ID, DateNaissance,
       PoidsNaissance, dateAchat, PrixAchat, PoidsAchat) 
     VALUES(:type, :Troupeau, :sexe, :ID, :DateNaissance, :PoidsNaissance, :dateAchat, :PrixAchat, :PoidsAchat)");
  if ($sql->execute([':type' => $type, 
    ':Troupeau' => $Troupeau, 
    ':sexe' => $sexe, 
    ':ID' => $ID, 
    ':DateNaissance' => $DateNaissance,
    ':PoidsNaissance' => $PoidsNaissance, 
    ':dateAchat' => $dateAchat, 
    ':PrixAchat' => $PrixAchat, 
    ':PoidsAchat' => $PoidsAchat]));

    $del2 = $connection->prepare( "INSERT INTO prestation
     (type, Troupeau,dateAchat, PrixAchat, PoidsAchat) 
     VALUES(:type, :Troupeau,:dateAchat, :PrixAchat, :PoidsAchat)" );
    $del2->execute([':type' => $type, 
    ':Troupeau' => $Troupeau,  
    ':dateAchat' => $dateAchat, 
    ':PrixAchat' => $PrixAchat, 
    ':PoidsAchat' => $PoidsAchat]);
    $connection->commit();

 } catch( RuntimeException $e ) {
    $connection->rollBack();
  }
}
  	
 ?>
<?php require 'header.php'; ?>

<!-- ******************************************************************************-->
<?php// require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Crée noveau animal</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="type"> type </label>      
	<select  name="type" class="form-control" name="nom"> 
<?php 
    $db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
     $cat = $db->query("select distinct type from typeliv");
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['type'].'">'.$id['type'].'</option>';
			}
			?>		
</select>
</div>
        
		<div class="form-group">
          <label for="Troupeau">Troupeau</label>
          <select  name="Troupeau" class="form-control" name="nom"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct herd from herd");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['herd'].'">'.$id['herd'].'</option>';
			}
			?>
			</select>
        </div>
		<div class="form-group">
          <label for="sexe">sexe</label><br>
          <input type="radio" name="sexe" value="Masculin" checked="checked">
          <label>Masculin</label>
			    <input type="radio" name="sexe" value="Feminin" id="sexe"/>
          <label>Feminin</label></td>
    </div>
		<div class="form-group">
          <label for="ID">ID</label>
          <input type="text" name="ID" id="ID" class="form-control" required="required">
        </div>
		<div class="form-group">
          <label for="DateNaissance">DateNaissance</label>
          <input  type="date" name="DateNaissance" id="DateNaissance" class="form-control" >
        </div>
		<div class="form-group">
          <label for="PoidsNaissance">PoidsNaissance</label>
          <input  type="text" name="PoidsNaissance" id="PoidsNaissance" class="form-control">
        </div>
		<div class="form-group">
          <label for="dateAchat">dateAchat</label>
          <input  type="date" name="dateAchat" id="dateAchat" class="form-control" >
        </div>
		
		<div class="form-group">
          <label for="PrixAchat">PrixAchat</label>
          <input  type="text" name="PrixAchat" id="PrixAchat" class="form-control" >
        </div>
        <div class="form-group">
          <label for="PoidsAchat">PoidsAchat</label>
          <input  type="text" name="PoidsAchat" id="PoidsAchat" class="form-control" >
        </div>
        <div class="form-group">
      <button type="submit" class="btn btn-info">Create animal</button>
		  <button type="submit" class="btn btn-info">
        <a href="livestock.php">go back</a></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>
 <!-- ***************************************************************************** -->
          <?php require 'footer.php'; ?>