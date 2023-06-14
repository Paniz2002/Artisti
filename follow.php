<?php 
require('header.php');
          
  $stmt0 = $conn->prepare("SELECT Id FROM utenti WHERE(Username=:UsernameSeguito)");

  $stmt0->bindParam(':UsernameSeguito',$_GET['username']);

  $stmt0->execute();

  $row0 = $stmt0->fetch();

  $stmt = $conn->prepare("INSERT INTO follow(IdSegue,IdSeguito) VALUES(:IdSegue,:IdSeguito)");

  $stmt->bindParam(':IdSegue',$_SESSION['Id']);

  $stmt->bindParam(':IdSeguito',$row0['Id']);

  $stmt->execute();

  header('location:showprofilo.php?username=' . $_GET['username']);
   