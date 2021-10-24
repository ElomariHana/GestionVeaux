<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require 'db.php';
$idl = $_GET['idl'];
$sql = 'DELETE FROM livestock WHERE idl=:idl';
$statement = $connection->prepare($sql);
if ($statement->execute([':idl' => $idl])) {
  header("Location: livestock.php");
}