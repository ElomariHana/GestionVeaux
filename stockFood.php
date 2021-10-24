
<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'header.php'; ?>
<?php
require 'db.php';
$message = '';
if (isset ($_POST['foodtype'])  && isset($_POST['qte']) ) {
  $foodtype = $_POST['foodtype'];
  $qte = $_POST['qte'];
  
  $sql = 'INSERT INTO stockfood(foodtype, qte) 
       VALUES(:foodtype, :qte)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':foodtype' => $foodtype,
                            ':qte' => $qte])) {
    $message = 'data inserted successfully';
  }
}

$sql = 'SELECT * FROM stockfood';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
?>
 <div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a food</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="foodtype">foodtype</label>
          <input type="text" name="foodtype" id="foodtype" class="form-control">
        </div>
        <div class="form-group">
          <label for="qte">qte</label>
          <input type="text" name="qte" id="qte" class="form-control">
        </div>
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Commande..</button>
        </div>
      </form>
    </div>
  </div>
</div>
 
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All StockFood</h2>
    </div>
    <input type="text" class="form-control input-lg" 
                id="myInput" onkeyup="myFunction()"
        placeholder="recherche.....">
    <div class="card-body">
      <table id="table" class="table" class="table table-bordered">
        <tr>
		        <th>id</th>
            <th>foodtype</th>
		        <th>qte</th>
          
          <th>Action</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->foodtype; ?></td>
            <td><?= $person->qte; ?></td>
			<td>
       <a href="editStfood.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
        <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteStfood.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
   <a href="Commande.php?id=<?= $person->id ?>" class="btn btn-info" styl>Commander</a>

            </td>
          </tr>
        <?php endforeach; ?>
      </table>
	  <a href="create.php">create</a>
    </div>
  </div>
</div>
 <script> 
           function myFunction() {
  
              var input, filter, table, tr, td, i;
             input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");

  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
<script>
$(document).ready(function() {
    $('.nav-trigger').click(function() {
        $('.side-nav').toggleClass('visible');
    });
});
</script>
<?php require 'footer.php'; ?>