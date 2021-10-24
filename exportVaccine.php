<?php
require 'db.php';        
$select = $connection->prepare('
SELECT *
FROM vaccine
');

$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

$newReservations = $select->fetchAll();

$excel = "";
 
$excel .=  "id\animaux\date\note\veterinaire\transport\n";

foreach($newReservations as $row) {
 $excel .= "$row[id]\t$row[animaux]\t$row[date]\t$row[note]\t$row[veterinaire]\t$row[transport]\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=vaccine.xls");

print $excel;
exit;

?>

