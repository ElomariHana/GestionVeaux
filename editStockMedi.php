<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM stockmedicament WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['nomMedicament'])  
  && isset($_POST['datePerime']) 
   && isset($_POST['qte'])) {
  $nomMedicament = $_POST['nomMedicament'];
  $datePerime  = $_POST['datePerime'];
  $qte  = $_POST['qte'];
  
  $sql = 'UPDATE stockmedicament SET
          nomMedicament=:nomMedicament,
          datePerime=:datePerime,
          qte=:qte  WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':nomMedicament' => $nomMedicament, 
                 ':datePerime' => $datePerime, 
                 ':qte' => $qte, ':id' => $id])) {
    header("Location: stockMedicament.php");
  }
}
 ?>
<?php require 'header.php'; ?>
<!-- ******************************************************************************-->

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Medicament</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        
          <div class="form-group">
          <label for="nomMedicament">nomMedicament</label>
          <input value="<?= $person->nomMedicament; ?>" type="text" name="nomMedicament" id="nomMedicament" class="form-control">
        </div>
		<div class="form-group">
          <label for="datePerime">datePerime</label>
          <input value="<?= $person->datePerime; ?>" type="date" name="datePerime" id="datePerime" class="form-control">
        </div>
		<div class="form-group">
          <label for="qte">qte</label>
          <input value="<?= $person->qte; ?>" type="text" name="qte" id="qte" class="form-control">
        </div>
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Medicament</button>
		  <button type="submit" class="btn btn-info"><a href="stockMedicament.php">back</a></button>
        </div>
      </form>
    </div>
  </div>
</div>

 <!-- ***************************************************************************** -->
         <?php require 'footer.php'; ?>