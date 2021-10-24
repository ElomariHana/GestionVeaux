<?php
require 'db.php';        
$select = $connection->prepare('
SELECT *
FROM livestock
');

$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

$newReservations = $select->fetchAll();

$excel = "";

$excel .=  "idl\type\Troupeau\sexe\ID\DateNaissance\PoidsNaissance \dateAchat \PrixAchat\PoidsAchat\n";

foreach($newReservations as $row) {
 $excel .= "$row[idl]\t$row[type]\t$row[Troupeau]\t$row[sexe]\t$row[ID]\t$row[DateNaissance]\t$row[PoidsNaissance]\t$row[dateAchat]\t$row[PrixAchat]\t$row[PoidsAchat]\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=livestock.xls");

print $excel;
exit;

?>

