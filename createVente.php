<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}

require 'db.php';
$message = '';
if (isset ($_POST['idl']) &&isset($_POST['dateVente'])
	&&isset($_POST['herd'])  &&isset($_POST['poidVente']) 
&&isset($_POST['prixVente']) &&isset($_POST['transport']) )
	{

  $idl = $_POST['idl'];
  $dateVente = $_POST['dateVente'];
  $herd = $_POST['herd'];
  $poidVente = $_POST['poidVente'];
  $prixVente = $_POST['prixVente'];
  $transport = $_POST['transport'];
  
   //debute
  $connection->beginTransaction();
try {
    $insert = $connection->prepare( "INSERT INTO vente (idl, dateVente, herd, poidVente, prixVente, transport) VALUES 
    (:idl, :dateVente, :herd, :poidVente, :prixVente, :transport)" );
    $insert->execute([':idl' => $idl, 
    ':dateVente' => $dateVente, ':herd' => $herd,
    ':poidVente' => $poidVente, ':prixVente' => $prixVente,
    ':transport' => $transport]); 
        
    $del2 = $connection->prepare( "DELETE FROM livestock WHERE idl = :idl" );
    $del2->execute([":idl"=>$idl]);
     
     $insertt = $connection->prepare( "INSERT INTO prestation 
      (idl, dateVente, herd, poidVente, prixVente, transport) VALUES 
    (:idl, :dateVente, :herd, :poidVente, :prixVente, :transport)" );
    $insertt->execute([':idl' => $idl, 
    ':dateVente' => $dateVente, ':herd' => $herd,
    ':poidVente' => $poidVente, ':prixVente' => $prixVente,
    ':transport' => $transport]); 

    $connection->commit();
} catch( RuntimeException $e ) {
    $connection->rollBack();
	}
	
}
	//fin transaction
  
  
	
	
  	
 ?>
<?php require 'header.php'; ?>

<!-- ******************************************************************************-->
<?php// require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create Vente</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      
      <form method="post">
        <div class="form-group">

          <label for="idl">idl</label>
          <select name="idl" id="idl"  class="form-control" > 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("SELECT idl,max(PoidsAchat) 
        FROM livestock group By idl HAVING 
        max(PoidsAchat)>10 limit 6");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['idl'].'">'.$id['idl'].'</option>';
			}
			?>
			
			
</select>       
	   </div>
		
		<div class="form-group">
          <label for="dateVente">dateVente</label>
          <input type="date" name="dateVente" id="Troupeau" class="form-control" required="required">
        </div>
		<div class="form-group">
          <label for="herd">herd</label>
          <select id="herd" name="herd" class="form-control" required="required" > 
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
          <label for="poidVente">poidVente</label>
          <input type="text" name="poidVente" id="poidVente" class="form-control" required="required">
        </div>
		
		<div class="form-group">
          <label for="prixVente">prixVente</label>
          <input type="text" name="prixVente" id="prixVente" class="form-control" required="required">
        </div>
		<div class="form-group">
          <label for="transport">transport</label>
          <select  name="transport" id="transport"  required="required" class="form-control" name="transport"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct type from transport");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['type'].'">'.$id['type'].'</option>';
			}
			?>
			
</select>
		</div>
		<div class="form-group">
          <button type="submit" class="btn btn-info">Create Vente</button>
		  <button type="submit" class="btn btn-info"><a href="vente.php">go back</a></button>
        </div>
		</form>
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>
 <!-- ***************************************************************************** -->
          <?php require 'footer.php'; ?>