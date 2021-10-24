<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM food WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset($_POST['idl'])  
  && isset($_POST['typefood'])  
  && isset($_POST['qtefood']) ) {

  $idl = $_POST['idl'];
  $typefood = $_POST['typefood'];
  $qtefood = $_POST['qtefood'];
  $sql = 'UPDATE food SET idl=:idl,
            typefood=:typefood, 
            qtefood=:qtefood 

            WHERE id=:id';
  $statement = $connection->prepare($sql);
 if ($statement->execute([':idl' => $idl,
                     ':typefood' => $typefood, 
                     ':qtefood' => $qtefood,
                      ':id' => $id])) {
     header("Location: food.php");
  }



}
 ?>
<?php require 'header.php'; ?>
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
        <form method="post">
      <div class="form-group">
    <label for="idl">idl</label>
          <select value="<?= $person->idl; ?>"  name="idl" id="idl"  class="form-control" > 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select idl from livestock");
      
      while($id=$cat->fetch(PDO::FETCH_ASSOC)){
      echo '<option value="'.$id['idl'].'">'.$id['idl'].'</option>';
      }
      ?>
      
</select>       
     </div>
        <div class="form-group">
          <label for="foodtype">typefood</label>
      <select value="<?= $person->typefood; ?>" class="form-control" name="typefood"> 
     <?php 
   $db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
    $cat = $db->query("select distinct typefood from food");
      
      while($id=$cat->fetch(PDO::FETCH_ASSOC)){
      echo '<option value="'.$id['typefood'].'">'.$id['typefood'].'</option>';
          }
       ?>     
    </select>
        </div>
        <div class="form-group">
          <label for="qte">qtefood</label>
          <input type="text" value="<?= $person->qtefood; ?>" name="qtefood" id="qtefood" class="form-control">
        </div>
    
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update food</button>
        </div>
      </form>
    </div>
  </div>
</div>
 <?php require 'footer.php'; ?>

 -->