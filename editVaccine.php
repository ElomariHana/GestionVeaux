<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$message = '';
$id = $_GET['id'];
$sql = 'SELECT * FROM vaccine WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['animaux']) 
       && isset($_POST['date'])  
       && isset($_POST['note'])  
       && isset($_POST['veterinaire'])  
       && isset($_POST['transport']) 
       && isset($_POST['PrixTrans'])) {

  $animaux = $_POST['animaux'];
  $date = $_POST['date'];
  $note = $_POST['note'];
  $veterinaire = $_POST['veterinaire'];
  $transport = $_POST['transport']; 
  $PrixTrans = $_POST['PrixTrans'];
  $sql = 'UPDATE vaccine SET 
         animaux=:animaux, date=:date, 
       note=:note, veterinaire=:veterinaire, 
      transport=:transport , PrixTrans=:PrixTrans
           WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':animaux' => $animaux, 
        ':date' => $date, 
        ':note' => $note,
         ':veterinaire' => $veterinaire,
          ':transport' => $transport, 
          ':PrixTrans' => $PrixTrans,
          ':id' => $id])) {

    header("Location: vaccine.php");
  $message = 'data update successfully';
  }
}


 ?>
<?php require 'header.php'; ?>
		<!-- ******************************************************************************-->

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Vaccine</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
    <form method="post">
        <div class="form-group">
          <label for="animaux">animaux</label>
        <select  value="<?= $person->animaux; ?>"   class="form-control" name="animaux"> 
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
          <label for="email">date</label>
          <input type="date" value="<?= $person->date; ?>" name="date" id="date" class="form-control">
        </div>
		<div class="form-group">
          <label for="note">note</label>
          <input type="text" value="<?= $person->note; ?>" name="note" id="note" class="form-control">
        </div>
		<div class="form-group">
          <label for="veterinaire">veterinaire</label>
          <select  value="<?= $person->veterinaire; ?>" class="form-control" name="veterinaire"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct name from veterinaire");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['name'].'">'.$id['name'].'</option>';
			}
			?>
			
</select>
        </div>
		<div class="form-group">
          <label for="transport">transport</label>
          
		  <select  value="<?= $person->transport; ?>" class="form-control" name="transport"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=livestock;charset=utf8', 'root', '');
$cat = $db->query("select distinct type from transport");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['type'].'">'.$id['type'].'</option>';
			}
			?>
			
</select>
        </div>
      <div class="form-group">
          <label for="PrixTrans">PrixTrans</label>
          <input type="text" name="PrixTrans" id="PrixTrans"
           value="<?= $person->PrixTrans; ?>" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Vaccine</button>
          <a href="vaccine.php"> go back</a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ***************************************************************************** -->
          <?php require 'footer.php'; ?>