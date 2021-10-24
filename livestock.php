<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$sql = 'SELECT * FROM livestock';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>

<?php require 'header.php'; ?>
<!-- ******************************************************************************-->
<?php //require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All Animal</h2>
       <a style="float:right" href="exporterLivestock.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    
    </div>

        <div class="card-body">
	      <div class="input-group">
              
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
              <input type="text" class="form-control input-lg" 
                id="myInput" onkeyup="myFunction()"
        placeholder="recherche.....">
            </div><br>
      <table id="table" class="table" class="table table-bordered">
        <tr>
          <th>idl</th>
          <th>type</th>
          <th>Troupeau</th>
		  <th>sexe</th>
		  <th>ID</th>
		  <th>DateNai</th>
		  <th>PoidsNai</th>
		  <th>dateAchat</th>
		 <th>PrixAch</th>
		  <th>PoidsAch</th>
          <th>Action</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
             <td><?= $person->idl; ?></td>
            <td><?= $person->type; ?></td>
			<td><?= $person->Troupeau; ?></td>
			<td><?= $person->sexe; ?></td>
			<td><?= $person->ID; ?></td>
			<td><?= $person->DateNaissance; ?></td>
			<td><?= $person->PoidsNaissance; ?></td>
			<td><?= $person->dateAchat; ?></td>
			<td><?= $person->PrixAchat; ?></td>
			<td><?= $person->PoidsAchat; ?></td>
           
            <td>
              <a href="editLivestock.php?idl=<?= $person->idl ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteLivestock.php?idl=<?= $person->idl ?>" class='btn btn-danger'>Delete</a>
            </td>
			
          </tr>
        <?php endforeach; ?>
      </table>
	  <br> <a href="createLivestock.php">Add  Livestock</a>
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>
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
   