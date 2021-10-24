<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
 ?>
<?php require 'header.php'; ?>
<!-- ******************************************************************************-->

<?php
require 'db.php';
$message = '';
if (isset ($_POST['nomMedicament'])  
  && isset($_POST['datePerime']) 
 && isset($_POST['qte']) ) {

  $nomMedicament = $_POST['nomMedicament'];
  $datePerime  = $_POST['datePerime'];
  $qte  = $_POST['qte'];
  $sql = 'INSERT INTO stockmedicament(nomMedicament, datePerime, qte) 
  VALUES(:nomMedicament, :datePerime, :qte)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':nomMedicament' => $nomMedicament, 
          ':datePerime' => $datePerime, 
          ':qte' => $qte])) {
    $message = 'data inserted successfully';
  }}
  $sql = 'SELECT * FROM stockmedicament';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
 <div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h4>Create Medicament</h4>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">nomMedicament</label>
          <input  type="text" name="nomMedicament" id="nomMedicament" class="form-control" required="required">
        </div>
		<div class="form-group">
          <label for="datePerime">datePerime</label>
          <input  type="date" name="datePerime" id="datePerime" required="required" class="form-control">
        </div>
		<div class="form-group">
          <label for="qte">qte</label>
          <input  type="text" name="qte" id="qte" class="form-control" required="required">
        </div>
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create Medicament</button>
		 
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h4>All Medicament</h4>
    </div>
    <div class="card-body">
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
      <table id="table" class="table" class="table table-bordered">
        <tr>
          <th>id</th>
          <th>nomMedicament</th>
		   <th>datePerime</th>
		   <th>qte</th>
		   
          <th>Action</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->nomMedicament; ?></td>
			<td><?= $person->datePerime; ?></td>
			<td><?= $person->qte; ?></td>
			
            <td>
              <a href="editStockMedi.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteStockMedi.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
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