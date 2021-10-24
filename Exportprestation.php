<?php
require 'db.php';        
$select = $connection->prepare('
SELECT *
FROM prestation
');

$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

$newReservations = $select->fetchAll();

$excel = "";

$excel .=  "id\type\Troupeau\dateAchat\PrixAchat\PoidsAchat\idl\dateVente\herd \poidVente\prixVente\transport\n";

foreach($newReservations as $row) {
$excel .= "$row[id]\t$row[type]\t$row[Troupeau]\t$row[dateAchat]\t$row[PrixAchat]\t$row[PoidsAchat]\t$row[idl]\t$row[dateVente]\t$row[herd]\t$row[poidVente]\t$row[prixVente]\t$row[transport]\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=prestation.xls");

print $excel;
exit;

?>

