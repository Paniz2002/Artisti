<?php
require 'header.php';
if (isset($_SESSION['username'])) {
   require 'loggedmenu.php';
   navbarActivator('profilo');
   ini_set('display_errors', 0);
   error_reporting(E_ERROR | E_WARNING | E_PARSE); 
      if (isset($_FILES['image']) ) {      
         $errors = array();
         $file_name = $_FILES['image']['name'];
         $file_size = $_FILES['image']['size'];
         $file_tmp = $_FILES['image']['tmp_name'];
         $file_type = $_FILES['image']['type'];
         $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
         $extensions = array("png","jpg","jpeg");
         if (in_array($file_ext, $extensions) === false) {
            $errors[] = "il file inserito deve essere in formato jpeg,jpg,jpg o mp3"; 
         }
         if ($file_size > 5000000) {
            $errors[] = 'File size must be 5 MB max.';
         }
         if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "profilephotos/" . $file_name);
         } else {
            ?>
            <div class="container">
            <div class="row align-items-center" >
              <div class="col-sm alert alert-danger" role="alert">
                <?php print_r($errors); ?>
              </div>
            </div>
          </div>
          <?php  
         }
         $stmt = $conn->prepare("SELECT Id,Cognome,Nome,Mail FROM utenti
                 WHERE username =:username");
         $stmt->bindParam(':username', $username);
         $username = $_SESSION['username'];
         $stmt->execute();
         $row = $stmt->fetch();
         $id = $row['Id'];
         $nome = $row['Nome'];
         $cognome = $row['Cognome'];
         $email = $row['Mail'];
         if(empty($errors)==true){
         $stmt2 = $conn->prepare("INSERT into fotoprofilo(IdUtente,NomeFoto,Extension) VALUES(:IdUtente,'$file_name',:Extension)");
         $stmt2->bindParam(':IdUtente', $id);
         $stmt2->bindParam(':Extension', $file_ext);    
         $stmt2->execute();
         header('location:profilo.php');
         }
      }
} else {
   require('menu.php');
   echo ' 
      <div class="container">
        <div class="row align-items-center" >
          <div class="col-sm alert alert-danger" role="alert">
            Devi effettuare il <a href="login.php" class="alert-link">login o la registrazione</a>. 
          </div>
        </div>
      </div>
      '; 
   exit;
}
?>
<html>
<body>
   <br>
   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <div class="d-flex flex-column align-items-center text-center">
                        <?php
                        $stmt3 = $conn->prepare("SELECT Id,NomeFoto from fotoprofilo 
                        WHERE IdUtente= :IdUtente
                        ORDER BY Id DESC LIMIT 1 ");
                        $stmt3->bindParam(':IdUtente', $_SESSION['Id']);
                        $stmt3->execute();
                        while ($row = $stmt3->fetch()) {
                           echo '<img src="' . 'profilephotos/' .

                              $row['NomeFoto'] . ' " alt="foto profilo" class="img-fluid img-thumbnail rounded-circle " style="width:200px; height:200px;">';

                              $stmt5 = $conn->prepare("DELETE from fotoprofilo WHERE (
                              Id!= :Id AND IdUtente= :IdUtente )");
                              $stmt5->bindParam(':Id',$row['Id']);
                              $stmt5->bindParam(':IdUtente', $_SESSION['Id']);
                              $stmt5->execute();
                        }                  
                        $follower = $conn->prepare("SELECT COUNT(*) FROM follow WHERE(IdSeguito=:IdSeguito)");                       
                             $follower->bindParam(':IdSeguito',$_SESSION['Id']);                   
                             $follower->execute();
                             $followercount=$follower->fetch();
                        $follow = $conn->prepare("SELECT COUNT(*) FROM follow WHERE(IdSegue=:IdSegue)");                         
                             $follow->bindParam(':IdSegue',$_SESSION['Id']);           
                             $follow->execute();
                             $followcount=$follow->fetch();
                        ?>
                        <div class="mt-3">
                           <h4 id="fontnotsized"><?php echo $_SESSION['username'] ; ?> </h4>
                           <a id="font"><strong id="font">Follower: </strong><?php echo $followercount['COUNT(*)'] ?></a>
                           <a id="font"><strong id="font">Seguiti: </strong><?php echo$followcount['COUNT(*)'] ?></a><br><br>
                           <form action="" method="POST" enctype="multipart/form-data">
                           <div class="custom-file" id="customFile" lang="es">
                              <input type="file" class="custom-file-input" name="image" id="image" >
                              <label class="custom-file-label" for="image" id="font">cerca una foto...</label>
                              <button class="btn btn-primary btn-sm" type="submit"  id="font">Cambia foto </button>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12">
               <div class="card mb-3">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-3 ">
                           <h6 id="font" class="mb-0" style="color:blueviolet">Nome </h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                           <?php
                           $stmt = $conn->prepare("SELECT Id,Cognome,Nome,Mail FROM utenti
                           WHERE username =:username");
                           $stmt->bindParam(':username', $username);
                           $username = $_SESSION['username'];
                           $stmt->execute();
                           $row = $stmt->fetch();
                           $id = $row['Id'];
                           $nome = $row['Nome'];
                           $cognome = $row['Cognome'];
                           $email = $row['Mail'];
                           ?> <span id="font"> <?php 
                           echo $nome;
                           ?></span>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-sm-3">
                           <h6 id="font" class="mb-0" style="color:blueviolet">Cognome</h6>
                        </div>
                        <div id="font" class="col-sm-9 text-secondary">
                           <?php
                           echo $cognome;
                           ?>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-sm-3">
                           <h6 id="font" class="mb-0" style="color:blueviolet">Username</h6>
                        </div>
                        <div id="font" class="col-sm-9 text-secondary">
                           <?php
                           echo $username;
                           ?>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-sm-3">
                           <h6 id="font" class="mb-0" style="color:blueviolet">Arte</h6>
                        </div>
                        <div id="font" class="col-sm-9 text-secondary">
                           <?php
                           $stmt4 = $conn->prepare("SELECT Tipo from tipiutente INNER JOIN utenti
                           WHERE ((utenti.IdTipoUtente= tipiutente.Id) AND (utenti.Id = :IdUtente))");
                              $stmt4->bindParam(':IdUtente', $_SESSION['Id']);
                              $stmt4->execute();
                              $row = $stmt4->fetch();
                              $tipoartista =$row['Tipo'];
                              echo $tipoartista;
                           ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>
</html>