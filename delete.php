<?php
require 'config.php';
// echo $_GET['id'];
$pdo_statement = $pdo->prepare(" DELETE FROM note WHERE id=".$_GET['id']);
$pdo_statement->execute();

echo "<script>alert('successfully deleted.');window.location.href='index.php';</script>";

 ?>
