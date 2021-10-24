<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM bilansante WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['animaux'])  
   && isset($_POST['typeBilanSante'])  
   && isset($_POST['dateTest'])  
   && isset($_POST['nomMedicament'])
   && isset($_POST['qteMedic'])  
   && isset($_POST['resultat']) ) {
  
  $animaux = $_POST['animaux'];

  $typeBilanSante = $_POST['typeBilanSante'];
  $dateTest = $_POST['dateTest'];
  $nomMedicament = $_POST['nomMedicament'];
  $qteMedic= $_POST['qteMedic'];
  $resultat = $_POST['resultat'];

  $sql = 'UPDATE bilansante SET animaux=:animaux, 
        typeBilanSante=:typeBilanSante,
        dateTest=:dateTest,
         nomMedicament=:nomMedicament,
         qteMedic =:qteMedic , 
        resultat=:resultat WHERE id=:id';
  $statement = $connection->prepare($sql);

  if ($statement->execute([':animaux' => $animaux,
               ':typeBilanSante' => $typeBilanSante, 
               ':dateTest' => $dateTest,
                ':nomMedicament' => $nomMedicament, 
                ':qteMedic '=>$qteMedic ,
                ':resultat' => $resultat])) {
    header("Location: bilanSante.php");
  }



}


 ?>
 <?php require 'header.php'; ?>
		<!-- ******************************************************************************-->

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Bilan</h2>
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
		  <select  value="<?= $person->animaux; ?>" class="form-control" id="animaux" name="animaux"> 
            <?php 
          $db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
            $cat = $db->query("select distinct animaux from vaccine");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['animaux'].'">'.$id['animaux'].'</option>';
			}
			?>
			
           </select></div>
        <div class="form-group">
          <label for="typeBilanSante">typeBilanSante</label>
          <input value="<?= $person->typeBilanSante; ?>" type="text" name="typeBilanSante" id="typeBilanSante" class="form-control">
        </div>
		<div class="form-group">
          <label for="dateTest">dateTest</label>
          <input value="<?= $person->dateTest; ?>" type="date" name="dateTest" id="dateTest" class="form-control">
        </div>
		<div class="form-group">
          <label for="nomMedicament">nomMedicament</label>
          <select value="<?= $person->nomMedicament; ?>"  name="nomMedicament" id="nomMedicament" class="form-control"> 
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
          <label for="qteMedic">qteMedic</label>
          <input value="<?= $person->qteMedic; ?>" type="text" name="qteMedic" 
          id="qteMedic" class="form-control">
        </div>
		<div class="form-group">
          <label for="resultat">resultat</label>
		  
		  <select  value="<?= $person->resultat; ?>" name="resultat" id="resultat" class="form-control"> 
<option>Positive</option>
<option>negative </option>
			
</select> 
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Bilan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>