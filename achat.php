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
<form method="post">

</form>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All Animal</h2>
    <button  style="color: pink; float: right;"><a href="createLivestock.php">Ajouter noveau animal</a></button> 
    </div>
    <div class="card-body">
      <table class="table table-bordered">
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
	 
    </div>
  </div>
</div>
<?php //require 'footer.php'; ?>