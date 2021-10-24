<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$id = $_GET['id'];
$sql = 'DELETE FROM vente WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute(
	      [':id' => $id])) {
  header("Location: vente.php");
}