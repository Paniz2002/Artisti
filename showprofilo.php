<?php 
require 'header.php';
if (isset($_SESSION['username'])) {
   require 'loggedmenu.php';
   navbarActivator('');
   if ($_GET['username'] == "") {
      header('location:home.php');
   }
   if ($_SESSION['username'] == $_GET['username']) {
      header('location:profilo.php');
   }
   $stmt = $conn->prepare("SELECT Id,Cognome,Nome,Mail FROM utenti
                 WHERE username =:username");
   $stmt->bindParam(':username', $username);
   $username = $_GET['username'];
   $stmt->execute();
   $row = $stmt->fetch();
   if (empty($row)) {
      echo ' 
            <br>
            <div class="container">
            <div class="row align-items-center" >
               <div class="col-sm alert alert-danger" role="alert">
                  Username inesistente, torna alla <a href="home.php" class="alert-link">home</a>. 
               </div>
            </div>
            </div>
            ';
   } else {
      $id = $row['Id'];
      $nome = $row['Nome'];
      $cognome = $row['Cognome'];
      $email = $row['Mail'];
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
if (!empty($row)) { ?>
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
                           $stmt3->bindParam(':IdUtente', $id);
                           $stmt3->execute();
                           while ($row = $stmt3->fetch()) {
                              echo '<img src="' . 'profilephotos/' .
                                 $row['NomeFoto'] . ' " alt="" class="img-fluid img-thumbnail rounded-circle " style="width:200px; height:200px;">';
                           }
                           $statement = $conn->prepare("SELECT Id FROM utenti WHERE(Username=:UsernameSeguito)");
                           $statement->bindParam(':UsernameSeguito', $_GET['username']);
                           $statement->execute();
                           $rowstatement = $statement->fetch();
                           $follower = $conn->prepare("SELECT COUNT(*) FROM follow WHERE(IdSeguito=:IdSeguito)");
                           $follower->bindParam(':IdSeguito', $rowstatement['Id']);
                           $follower->execute();
                           $followercount = $follower->fetch();
                           $follow = $conn->prepare("SELECT COUNT(*) FROM follow WHERE(IdSegue=:IdSegue)");
                           $follow->bindParam(':IdSegue', $rowstatement['Id']);
                           $follow->execute();
                           $followcount = $follow->fetch();
                           ?>
                           <div class="mt-3">
                              <h4 id="fontnotsized"><?php echo $username; ?> </h4>
                              <a id="font"><strong id="font">Follower: </strong><?php echo $followercount['COUNT(*)'] ?></a>
                              <a id="font"><strong id="font">Seguiti: </strong><?php echo $followcount['COUNT(*)'] ?></a><br><br>
                              <?php
                              $stmt0 = $conn->prepare("SELECT Id FROM utenti WHERE(Username=:UsernameSeguito)");
                              $stmt0->bindParam(':UsernameSeguito', $_GET['username']);
                              $stmt0->execute();
                              $row0 = $stmt0->fetch();
                              $stmt = $conn->prepare("SELECT IdSeguito FROM follow WHERE(IdSegue=:IdSegue AND IdSeguito=:IdSeguito)");
                              $stmt->bindParam(':IdSegue', $_SESSION['Id']);
                              $stmt->bindParam(':IdSeguito', $row0['Id']);
                              $stmt->execute();
                              $row = $stmt->fetch();
                              if (!empty($row)) { ?>
                                 <a href="unfollow.php?username=<?php echo $_GET['username']; ?>">
                                    <button type="button" class="btn btn-success">Segui già&#10004</button>
                                 </a>
                              <?php } else { ?>
                                 <a href="follow.php?username=<?php echo $_GET['username']; ?>">
                                    <button type="button" class="btn btn-primary ">Segui</button>
                                 </a>
                              <?php }
                              ?>
                              <a href="chat.php?username=<?php echo $_GET['username']; ?>">
                                 <button type="button" class="btn btn-primary">Contatta</button>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12">
                  <div class="card mb-3">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-sm-3">
                              <h6 id="font" class="mb-0" style="color:blueviolet">Nome </h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php
                              $stmt = $conn->prepare("SELECT Id,Cognome,Nome,Mail FROM utenti
                           WHERE username =:username");
                              $stmt->bindParam(':username', $username);
                              $username = $_GET['username'];
                              $stmt->execute();
                              $row = $stmt->fetch();
                              $id = $row['Id'];
                              $nome = $row['Nome'];
                              $cognome = $row['Cognome'];
                              $email = $row['Mail'];
                              ?>
                              <span id="font"> <?php
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
                              $stmt4->bindParam(':IdUtente', $id);
                              $stmt4->execute();
                              $row = $stmt4->fetch();
                              $tipoartista = $row['Tipo'];
                              echo $tipoartista;
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php
            $stmt0 = $conn->prepare("SELECT Id FROM utenti WHERE(Username=:UsernameSeguito)");
            $stmt0->bindParam(':UsernameSeguito', $_GET['username']);
            $stmt0->execute();
            $row0 = $stmt0->fetch();
            $stmt = $conn->prepare("SELECT * from post 
   WHERE (IdUtente=:Id)");
            $stmt->bindParam(':Id', $row0['Id']);
            $stmt->execute();
            ?>
            <div class="row">
               <div class="col-12" style="text-align:center">
                  <div class="card">
                     <div class="card-body">
                        <h4 style="color:blueviolet" id="fontnotsized">Post</h4>
                        <hr>
                        <div class="card-deck">
                           <?php
                           while ($row = $stmt->fetch()) {
                              switch ($row['Extension']) {
                                 case 'png':
                                 case 'jpg':
                                 case 'jpeg':
                                    $nomefile = $row['NomeFile'];
                                    $descrizione = $row['Descrizione'];
                                    $datacreazione = $row['dataCreazione'];
                           ?>
                                    <div class="card border-secondary mb-3" style="min-width:300px; max-width:500px">
                                       <div class="row d-flex justify-content-center">
                                          <div class="col-md-8 col-sm-10 col-lg-8 col-xs-6">
                                             <br>
                                             <img class="img-fluid float-right" style="width:25px;height:25px" src="extra/logo_post.png">
                                             <hr>
                                          </div>
                                          <div class="col-md-8 col-sm-10 col-lg-8 col-xs-6 d-flex justify-content-center">
                                             <img class="img-fluid" id="image" src="uploads/<?php echo $nomefile; ?>">
                                          </div>
                                          <div class="col-md-8 col-sm-8 col-lg-8 col-xs-4">
                                             <hr>
                                             <p id="postfont" style="font-size:80%"><?php echo $descrizione; ?></p>
                                          </div>
                                       </div>
                                    </div>
                                 <?php break;
                                 case 'mp3':
                                    $nomefile = $row['NomeFile'];
                                    $descrizione = $row['Descrizione'];
                                 ?>
                                    <div class="card border-secondary mb-3" style=" min-width:300px; max-width:500px">
                                       <div class="row d-flex justify-content-center">
                                          <div class="col-md-8 col-sm-10 col-lg-8 col-xs-6">
                                             <br>
                                             <img class="img-fluid float-right" style="width:25px;height:25px" src="extra/logo_post.png">
                                             <hr>
                                          </div>
                                          <div class="col-md-8 col-sm-10 col-lg-8 col-xs-6 d-flex justify-content-center">
                                             <audio controls>
                                                <source src="uploads/<?php echo $nomefile ?> "><br>
                                             </audio>
                                          </div>
                                          <div class="col-md-8 col-sm-8 col-lg-8 col-xs-4">
                                             <hr>
                                             <p id="postfont" style="font-size:80%"><?php echo $descrizione; ?></p>
                                          </div>
                                       </div>
                                    </div>
                           <?php
                                    break;
                              }
                           } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </body>

   </html>
<?php }
?>