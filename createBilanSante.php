<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$message = '';
if (isset ($_POST['animaux'])  
     && isset($_POST['typeBilanSante'])  
     && isset($_POST['dateTest'])  
     && isset($_POST['nomMedicament'])  
     && isset($_POST['resultat']) ) {

  $animaux = $_POST['animaux'];
  $typeBilanSante = $_POST['typeBilanSante'];
  $dateTest = $_POST['dateTest'];
  $nomMedicament = $_POST['nomMedicament'];
   $qteMedic = $_POST['qteMedic'];
  $resultat = $_POST['resultat'];
  $sql = 'INSERT INTO bilansante(animaux, typeBilanSante, dateTest, nomMedicament, qteMedic, resultat) VALUES(:animaux, :typeBilanSante, :dateTest, :nomMedicament, qteMedic, :resultat)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':animaux' => $animaux, 
    ':typeBilanSante' => $typeBilanSante, 
    ':dateTest' => $dateTest, 
    ':nomMedicament' => $nomMedicament, 
    ':qteMedic' => $qteMedic, 
    ':resultat' => $resultat])) {
    $message = 'data inserted successfully';
  }



}


 
 ?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a person</h2>
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
          <input type="text" name="animaux" id="animaux" class="form-control">
        </div>
        <div class="form-group">
          <label for="typeBilanSante">typeBilanSante</label>
          <input type="text" name="typeBilanSante" id="typeBilanSante" class="form-control">
        </div>
		<div class="form-group">
          <label for="dateTest">dateTest</label>
          <input type="date" name="dateTest" id="dateTest" class="form-control">
        </div>
		<div class="form-group">
          <label for="qteMedic">qteMedic</label>
          <input type="text" name="qteMedic" id="qteMedic" class="form-control">
        
		</div>
		<div class="form-group">
          <label for="resultat">resultat</label>
          <input type="text" name="resultat" id="resultat" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a person</button>
		 
        </div>
		 <a href="bilanSante.php">go back</a>
      </form>
    </div>
  </div>
</div>

