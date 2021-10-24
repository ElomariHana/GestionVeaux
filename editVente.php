<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM vente WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
 
if (isset ($_POST['idl'])
 &&isset($_POST['dateVente']) 
 &&isset($_POST['herd'])  
 &&isset($_POST['poidVente'])  
 &&isset($_POST['prixVente']) 
 &&isset($_POST['transport'])) {

  $idl = $_POST['idl'];
 $dateVente = $_POST['dateVente'];
  $herd = $_POST['herd'];
  $poidVente = $_POST['poidVente'];
  $prixVente = $_POST['prixVente'];
  $transport = $_POST['transport'];
  
  $sql = 'UPDATE vente SET idl=:idl,
       dateVente=:dateVente,
        herd=:herd,
         poidVente=:poidVente, 
         prixVente=:prixVente,
          transport=:transport 
          WHERE id=:id';
  $statement = $connection->prepare($sql);
 
  if ($statement->execute([':idl' => $idl, ':dateVente' => $dateVente, ':herd' => $herd, ':poidVente' => $poidVente, ':prixVente' => $prixVente, ':transport' => $transport, ':id' => $id])) {
    header("Location: vente.php");
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

          <label for="idl">idl</label>
          <select value="<?= $person->idl; ?>" name="idl" id="idl"  class="form-control" > 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct ID from livestock");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['ID'].'">'.$id['ID'].'</option>';
			}
			?>
			
</select> 
		</div>
		
		<div class="form-group">
          <label for="dateVente">dateVente</label>
          <input value="<?= $person->dateVente; ?>" type="date" name="dateVente" id="Troupeau" class="form-control">
        </div>
		<div class="form-group">
          <label for="herd">herd</label>
            <select value="<?= $person->herd; ?>" id="herd" name="herd" class="form-control" > 
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
          <input value="<?= $person->poidVente; ?>" type="text" name="poidVente" id="poidVente" class="form-control">
        </div>
		
		<div class="form-group">
          <label for="prixVente">prixVente</label>
          <input value="<?= $person->prixVente; ?>" type="text" name="prixVente" id="prixVente" class="form-control">
        </div>
		<div class="form-group">
          <label for="transport">transport</label>
          <select value="<?= $person->transport; ?>" name="transport" id="transport" class="form-control" name="transport"> 
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
          <button type="submit" class="btn btn-info">Update person</button>
		 <a href="vente.php">back</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>
 <!-- ***************************************************************************** -->
          <?php require 'footer.php'; ?>