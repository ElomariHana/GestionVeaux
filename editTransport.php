<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM transport WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['type'])  && isset($_POST['prix'])) {
  $type = $_POST['type'];
  $prix = $_POST['prix'];
  
  $sql = 'UPDATE transport SET type=:type, prix=:prix  WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':type' => $type, ':prix' => $prix, ':id' => $id])) {
    header("Location: transport.php");
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
          <label for="prix">prix</label>
          <input value="<?= $person->prix; ?>" type="text" name="prix" id="prix" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update person</button>
		  <button type="submit" class="btn btn-info"><a href="transport.php">back</a></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>
 <!-- ***************************************************************************** -->
          <?php require 'footer.php'; ?>