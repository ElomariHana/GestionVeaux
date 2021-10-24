<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';


 ?>
 <?php
date_default_timezone_set("GMT");
$currenttime = time();
$DateTime = strftime("%Y-%m-%d",$currenttime);

?>
<?php require 'header.php'; ?>

<?php
require 'db.php';

$message = '';
if (isset ($_POST['animaux']) 
    && isset($_POST['note']) 
     && isset($_POST['veterinaire'])  
     && isset($_POST['transport'])
     && isset($_POST['PrixTrans']) ) {

  $animaux = $_POST['animaux'];
  $note = $_POST['note'];
  $veterinaire = $_POST['veterinaire'];
  $transport = $_POST['transport'];
  $PrixTrans = $_POST['PrixTrans'];

  $sql = 'INSERT INTO vaccine
         (animaux, date, note, veterinaire, transport,PrixTrans)
    VALUES(:animaux, :date, 
         :note, :veterinaire, :transport,:PrixTrans)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':animaux' => $animaux,
                     ':date' => $DateTime, ':note' => $note,
                       ':veterinaire' => $veterinaire, 
                     ':transport' => $transport ,
                     ':PrixTrans' =>$PrixTrans])) {
    $message = 'data inserted successfully';
  }
}

$sql = 'SELECT * FROM vaccine';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a vaccine</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">animaux</label>
		  <select   class="form-control" name="animaux" required="required"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct ID from livestock");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['ID'].'">'.$id['ID'].'</option>';
			}
			?>
			
</select>
          </div>
        
		<div class="form-group">
          <label for="email">Description</label>
          <input type="text" name="note" id="note" class="form-control" required="required">
        </div>
		<div class="form-group">
          <label for="email">  Nome du veterinaire </label>
          
		   <select   class="form-control" name="veterinaire" required="required"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct name from veterinaire");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['name'].'">'.$id['name'].'</option>';
			}
			?>
			
</select>
        </div>
		<div class="form-group">
          <label for="transport">transport</label>
          
		  <select   class="form-control" name="transport" required="required"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct type from transport");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['type'].'">'.$id['type'].'</option>';
			}
			?>
			
</select>
        </div>
    <div class="form-group">
          <label for="PrixTrans">PrixTrans</label>
          <input type="text" name="PrixTrans" id="PrixTrans" class="form-control" required="required">
        </div>
        <div class="form-group">
          <button type="submit" name="signup"
          class="btn btn-info">Create a vaccine</button>
		 
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All Vaccine</h2>
      <a style="float:right" href="exportVaccine.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
       
 
    </div>
    <div class="card-body">
	<div class="input-group">
    <input type="text" class="form-control input-lg" 
          id="myInput" onkeyup="myFunction()"
           placeholder="recherche.....">              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div><br>
      <table id="table" class="table" class="table table-bordered">
        <tr>
		  <th>id</th>
          <th>animaux</th>
		  <th>date</th>
          <th>note</th>
          <th>veterinaire</th>
		      <th>transport</th>
          <th>PrixTrans</th>
          <th>Action</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->animaux; ?></td>
            <td><?= $person->date; ?></td>
            
			      <td><?= $person->note; ?></td>
			     <td><?= $person->veterinaire; ?></td>
			     <td><?= $person->transport; ?></td>
           <td><?= $person->PrixTrans; ?></td>
            <td>
              <a href="editVaccine.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteVaccine.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
	  
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>
        <?php require 'footer.php'; ?>


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