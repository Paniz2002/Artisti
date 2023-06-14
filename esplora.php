<!DOCTYPE html>
<html>
<?php 
    require 'header.php';
    require 'layout.php';
    $url = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    if(isset($_SESSION['username'])){
        require 'loggedmenu.php';
        navbarActivator('esplora');

          $stmt = $conn->prepare("SELECT Id,NomeFile,Extension,Descrizione FROM post ORDER BY DataCreazione DESC");
          
          $stmt->execute();
          ?>
          <div class="container">
          <div class="jumbotron">
          
          <?php
          while($row = $stmt->fetch()){
            switch($row['Extension']){
              case 'jpeg' :
              case'png':
              case 'jpg':
                $stmt2 = $conn->prepare("SELECT IdUtente,DataCreazione FROM post 
                WHERE Id=:Id" );

                $id=$row['Id'];

                $stmt2->bindParam(':Id',$id);

                $stmt2->execute();
                $row2=$stmt2->fetch();
                $datacreazione=$row2['DataCreazione'];

                

                $stmt3 = $conn->prepare("SELECT Username FROM utenti WHERE 
                                Id=:Id");
                $idutente=$row2['IdUtente'];
                $stmt3->bindParam(':Id',$idutente);
                $stmt3->execute();
                $row3=$stmt3->fetch();
                $username=$row3['Username'];
                $nomefile=$row['NomeFile'];
                $descrizione=$row['Descrizione'];

                $stmt6 = $conn->prepare("SELECT NomeFoto from fotoprofilo 
                WHERE IdUtente= :IdUtente
                ORDER BY Id DESC LIMIT 1 ");
                $stmt6->bindParam(':IdUtente', $idutente);
                $stmt6->execute();
                $row = $stmt6->fetch();
                $nomefotoprofilo=$row['NomeFoto'];

                postlayout($id,$username,$nomefile,$descrizione,$nomefotoprofilo,$datacreazione,$url);
                break;
              
              case 'mp3' :
                $stmt2 = $conn->prepare("SELECT IdUtente,DataCreazione FROM post 
                                        WHERE Id=:Id" );
                
                $id=$row['Id'];
                
                $stmt2->bindParam(':Id',$id);
          
                $stmt2->execute();
                $row2=$stmt2->fetch();
                $datacreazione=$row2['DataCreazione'];

                

                $stmt3 = $conn->prepare("SELECT Username FROM utenti WHERE 
                                        Id=:Id");
                $idutente=$row2['IdUtente'];
                $stmt3->bindParam(':Id',$idutente);
                $stmt3->execute();
                $row3=$stmt3->fetch();
                $username=$row3['Username'];
                $nomefile=$row['NomeFile'];
                $descrizione=$row['Descrizione'];

                $stmt6 = $conn->prepare("SELECT NomeFoto from fotoprofilo 
                        WHERE IdUtente= :IdUtente
                        ORDER BY Id DESC LIMIT 1 ");
                        $stmt6->bindParam(':IdUtente', $idutente);
                        $stmt6->execute();
                        $row = $stmt6->fetch();
                        $nomefotoprofilo=$row['NomeFoto'];

                postlayoutmp3($id,$username,$nomefile,$descrizione,$nomefotoprofilo,$datacreazione,$url);
                break;
              
            }
            
              
          }
          ?>
          </div>
          <?php             
    }
    else{
        header('Location: index.php');
        exit;  
    }
?>
  </div>

  </body>
  </html>