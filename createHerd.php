<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$message = '';
if (isset ($_POST['herd']) ) {
  $herd = $_POST['herd'];
  $sql = 'INSERT INTO herd(herd) VALUES(:herd)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':herd' => $herd])) {
    $message = 'data inserted successfully';
  }}
 ?>

<!-- ******************************************************************************-->
<?php require 'header.php'; ?>
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
          <label for="name">herd</label>
          <input type="text" name="herd" id="herd" class="form-control">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a person</button>
		  <button type="submit" class="btn btn-info"><a href="herd.php">go back</a></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
 <!-- ***************************************************************************** -->
          
