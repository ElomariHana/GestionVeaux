<?php
require 'db.php';
$sql = 'SELECT * FROM prestation';
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

      <h4>All Sales</h4>
      
 <a style="float:right" href="Exportprestation.php"
   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
   <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        
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
      <table id="table" class="table" class="table table-bordered"
          style="font-size: 14px;">
        <tr>
          <th>id</th>
          <th>idl</th>
          <th>Troupeau</th>
         <th>dateAchat</th>
         <th> PrixAchat</th>
         <th>PoidsAchat</th>
         <th>idl</th>
         <th>dateVente</th>
         <th>herd</th>
         <th> poidVente</th>
         <th>prixVente</th>
         <th>transport</th>
          <th>Action</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
      <td><?= $person->id; ?></td>
      <td><?= $person->idl; ?></td>
      <td><?= $person->Troupeau; ?></td>
      <td><?= $person->dateAchat; ?></td>
      <td><?= $person->PrixAchat; ?></td>
      <td><?= $person->PoidsAchat; ?></td>
      <td><?= $person->idl; ?></td>
      <td><?= $person->dateVente; ?></td>
      <td><?= $person->herd; ?></td>
      <td><?= $person->poidVente; ?></td>
      <td><?= $person->prixVente; ?></td>
      <td><?= $person->transport; ?></td>
            <td>
              <a href="editVente.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteVente.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
      
          </tr>
        <?php endforeach; ?>
      </table>
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