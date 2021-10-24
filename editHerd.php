<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM herd WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['herd'])) {
  $herd = $_POST['herd'];
  
  $sql = 'UPDATE herd SET herd=:herd WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':herd' => $herd, ':id' => $id])) {
    header("Location: herd.php");
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
          <label for="name">herd</label>
          <input value="<?= $person->herd; ?>" type="text" name="herd" id="herd" class="form-control">
        </div>
        
        <div class="form-group">
      <button type="submit" class="btn btn-info">Update herd</button>
		  <button type="submit" class="btn btn-info">
        <a href="herd.php">back</a></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
 <!-- ***************************************************************************** -->
          