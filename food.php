
<?php require 'header.php'; ?>
<?php
require_once 'db.php';
$message = '';
if ( isset($_POST['idl'])
  &&isset ($_POST['typefood'])  
  && isset($_POST['qtefood']) ) {

  $idl = $_POST['idl'];
  $typefood = $_POST['typefood'];
  $qtefood = $_POST['qtefood'];

  $statement = $connection->prepare("CALL ProcFood(?,?,?)");
  $statement->bindParam(1, $_POST['idl'], PDO::PARAM_INT);
  $statement->bindParam(2, $_POST['typefood'], PDO::PARAM_STR);
  $statement->bindParam(3, $_POST['qtefood'], PDO::PARAM_INT);
  $statement->execute();
     $message='data insered';
  }
 
$sql = 'SELECT * FROM food';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
 <div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>New food</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
    <div class="form-group">
    <label for="idl">idl</label>
          <select name="idl" id="idl"  class="form-control" > 
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
          <label for="typefood">typefood</label>
  <select   class="form-control" name="typefood"> 
     <?php 
   $db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
    $cat = $db->query("select distinct foodtype from stockfood");
      
      while($id=$cat->fetch(PDO::FETCH_ASSOC)){
      echo '<option value="'.$id['foodtype'].'">'.$id['foodtype'].'</option>';
          }
       ?>     
</select>

        </div>
        <div class="form-group">
          <label for="qtefood">qtefood</label>
          <input type="text" name="qtefood" id="qtefood" class="form-control">
        </div>
    
        <div class="form-group">
          <button type="submit" class="btn btn-info">New  Food</button>
        </div>
      </form>
    </div>
  </div>
</div>
 
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>History Food</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>id</th>
          <th>ID_animal</th>
          <th>typefood</th>
          <th>qtefood</th>
          
          <th>Action</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
              <td><?= $person->id; ?></td>
             <td><?= $person->idl; ?></td>
            <td><?= $person->typefood; ?></td>
            <td><?= $person->qtefood; ?></td>
      <td>
      <a href="editfood.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
    <a onclick="return 
    confirm('Are you sure you want to delete this entry?')" 
    href="deletefood.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>