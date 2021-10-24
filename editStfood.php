<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id=$_GET['id'];
$sql = 'SELECT * FROM stockfood WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['foodtype'])  
    && isset($_POST['qte'])) {
  $foodtype = $_POST['foodtype'];
  $qte = $_POST['qte'];
  
  $sql = 'UPDATE stockfood SET foodtype=:foodtype,
                               qte=:qte WHERE id=:id';
  $statement = $connection->prepare($sql);
 if ($statement->execute([':foodtype' => $foodtype,
             ':qte' => $qte, ':id' => $id])) {
     header("Location: stockFood.php");
  }



}
 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Stock</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <form method="post">
        <div class="form-group">
          <label for="foodtype">foodtype</label>
          <input value="<?= $person->foodtype; ?>"
            type="text" name="foodtype" id="foodtype" class="form-control">
        </div>
        <div class="form-group">
          <label for="qte">qte</label>
          <input type="text" value="<?= $person->qte; ?>" name="qte" id="qte" class="form-control">
        </div>
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update StockFood</button>
        </div>
      </form>
    </div>
  </div>
</div>
 <?php require 'footer.php'; ?>