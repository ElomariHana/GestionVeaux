<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}

 ?>
<?php require 'header.php';?>
		<!-- ******************************************************************************-->
<?php
require 'db.php';
$message = '';
if (isset ($_POST['animaux'])  
    && isset($_POST['typeBilanSante'])  
    && isset($_POST['dateTest'])  
    && isset($_POST['nomMedicament'])  
    && isset($_POST['qteMedic'])   
    && isset($_POST['resultat']) ) {

  $animaux = $_POST['animaux'];
  $typeBilanSante = $_POST['typeBilanSante'];
  $dateTest = $_POST['dateTest'];
  $nomMedicament = $_POST['nomMedicament'];
  $qteMedic = $_POST['qteMedic'];
  $resultat = $_POST['resultat'];

  $statement=$connection->prepare("CALL BilanSante(?,?,?,?,?,?)");

  $statement->bindParam(1, $_POST['animaux'], PDO::PARAM_INT);
  $statement->bindParam(2, $_POST['typeBilanSante'], PDO::PARAM_STR);
  $statement->bindParam(3, $_POST['dateTest'], PDO::PARAM_STR);
  $statement->bindParam(4, $_POST['nomMedicament'], PDO::PARAM_STR);
  $statement->bindParam(5, $_POST['qteMedic'], PDO::PARAM_INT);
  $statement->bindParam(6, $_POST['resultat'], PDO::PARAM_STR);
  if ($statement->execute()) {
        $message = 'data inserted successfully';

  } ;


 }
$sql = 'SELECT * FROM bilansante';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

 ?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h4>Create a person</h4>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="animaux">animaux</label>
		  <select   class="form-control" id="animaux" name="animaux"> 
           <?php 
          $db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
            $cat = $db->query("select distinct animaux from vaccine");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['animaux'].'">'.$id['animaux'].'</option>';
			}
			?>
			
           </select></div>
        <div class="form-group">
          <label for="typeBilanSante">typeBilanSante</label>
          <input type="text" name="typeBilanSante" id="typeBilanSante" class="form-control">
        </div>
		<div class="form-group">
          <label for="dateTest">dateTest</label>
          <input type="date" name="dateTest" id="dateTest" class="form-control">
        </div>
		<div class="form-group">
          <label for="nomMedicament">nomMedicament</label>
          <select   name="nomMedicament" id="nomMedicament" class="form-control"> 
<?php 
$db = new PDO('mysql:host=localhost;dbname=hana;charset=utf8', 'root', '');
$cat = $db->query("select distinct nomMedicament from stockmedicament");
			
			while($id=$cat->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$id['nomMedicament'].'">'.$id['nomMedicament'].'</option>';
			}
			?>
			
</select> 
</div>
<div class="form-group">
          <label for="qteMedic">qte Medicament</label>
         <input type="text" name="qteMedic" id="qteMedic" class="form-control">
        
</select> 
</div>
		
		<div class="form-group">
          <label for="resultat">resultat</label>
		  
		  <select   name="resultat" id="resultat" class="form-control"> 
<option>Positive</option>
<option>negative </option>
			
</select> 
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a bilan</button>
		 
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h4>Tout Les bilans </h4>
    </div>
	<div class="input-group">
              <input type="text" class="form-control input-lg" 
                id="myInput" onkeyup="myFunction()"
        placeholder="recherche.....">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div><br>
    <div class="card-body">
      <table id="table" class="table" class="table table-bordered">
        <tr>
		  <th>id</th>
          <th>animaux</th>
		  <th>typeBilanSante</th>
          <th>dateTest</th>
          <th>nomMedicament</th>
		  <th>qteMedic</th>
		  <th>resultat</th>
          <th>Action</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->animaux; ?></td>
            <td><?= $person->typeBilanSante; ?></td>
			<td><?= $person->dateTest; ?></td>
			<td><?= $person->nomMedicament; ?></td>
			<td><?= $person->qteMedic; ?></td>
			<td><?= $person->resultat; ?></td>
            <td>
              <a href="editBilanSante.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteBilanSante.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<!-- ***************************************************************************** -->
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
          