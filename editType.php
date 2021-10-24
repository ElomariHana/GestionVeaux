<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM typeliv WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['type'])) {
  $type = $_POST['type'];
  
  $sql = 'UPDATE typeliv SET type=:type WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':type' => $type, ':id' => $id])) {
    header("Location: livestockType.php");
  }
}
 ?>
<?php require 'header.php'; ?>
 <!-- ***************************************************************************** -->
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
          <input type="text" value="<?= $person->type; ?>" name="type" id="type" class="form-control">
        </div>
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update person</button>
        </div>
      </form>
    </div>
  </div>
</div>       
	   <?php require 'footer.php'; ?>