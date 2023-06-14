<?php 
require('header.php');
$servername = "localhost";
        $username = "root";
        $password = "";
        try {
          $conn = new PDO("mysql:host=$servername;dbname=progetto", $username, $password);    
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
          $stmt0 = $conn->prepare("SELECT Id FROM utenti WHERE(Username = :UsernameSeguito)");
          $stmt0->bindParam(':UsernameSeguito',$_GET['username']);
          $stmt0->execute();
          $row0 = $stmt0->fetch();
          $stmt = $conn->prepare("DELETE FROM follow WHERE(IdSegue = :IdSegue AND IdSeguito = :IdSeguito)");
          
          $stmt->bindParam(':IdSegue',$_SESSION['Id']);
          $stmt->bindParam(':IdSeguito',$row0['Id']);
          $stmt->execute();
          header('location:showprofilo.php?username=' . $_GET['username']);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }      