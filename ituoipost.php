<!DOCTYPE html>
<html>
<?php
require 'header.php';
require 'layout.php';
$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
if (isset($_SESSION['username'])) {
  require 'loggedmenu.php';
  navbarActivator('ituoipost');
  $stmt = $conn->prepare("SELECT Id FROM utenti
            WHERE username =:username");
  $stmt->bindParam(':username', $username);
  $username = $_SESSION['username'];
  $stmt->execute();
  $row = $stmt->fetch();
  $id = $row['Id'];
  $stmt2 = $conn->prepare("SELECT Id,NomeFile,Extension,Descrizione FROM post WHERE(:IdUtente=IdUtente)");
  $stmt2->bindParam(':IdUtente', $id);
  $stmt2->execute();
?>
  <div class="container" style="align-items:center">
    <div class="row d-flex justify-content-center" style=align-items:center>
      <form method="post" action="rimuovipost.php">
        <h3 id="fontnotsized" style="color:blueviolet;text-align:center">I tuoi post</h3>
        <hr>
        <table style="align-items:center">
          <?php
          while ($row = $stmt2->fetch()) {
            switch ($row['Extension']) {
              case 'jpeg':
              case 'jpg':
              case 'png':
                $stmt3 = $conn->prepare("SELECT IdUtente,DataCreazione FROM post 
              WHERE Id=:Id");
                $id = $row['Id'];
                $stmt3->bindParam(':Id', $id);
                $stmt3->execute();
                $row3 = $stmt3->fetch();
                $datacreazione = $row3['DataCreazione'];
                $stmt4 = $conn->prepare("SELECT Username FROM utenti WHERE 
                              Id=:Id");
                $idutente = $row3['IdUtente'];
                $stmt4->bindParam(':Id', $idutente);
                $stmt4->execute();
                $row4 = $stmt4->fetch();
                $username = $row4['Username'];
                $nomefile = $row['NomeFile'];
                $descrizione = $row['Descrizione'];
                $stmt6 = $conn->prepare("SELECT NomeFoto from fotoprofilo 
              WHERE IdUtente= :IdUtente
              ORDER BY Id DESC LIMIT 1 ");
                $stmt6->bindParam(':IdUtente', $idutente);
                $stmt6->execute();
                $row6 = $stmt6->fetch();
                $nomefotoprofilo = $row6['NomeFoto'];
          ?><tr>
                  <td><input type="checkbox" name="<?php echo $row['Id']; ?>" class="checkbox" value="cb"></td>
                  <td>
                    <?php
                    postlayout($id, $username, $nomefile, $descrizione, $nomefotoprofilo, $datacreazione, $url);
                    ?></td>
                </tr><?php
                      break;
                    case 'mp3':
                      $stmt3 = $conn->prepare("SELECT IdUtente,DataCreazione FROM post 
              WHERE Id=:Id");
                      $id = $row['Id'];
                      $stmt3->bindParam(':Id', $id);
                      $stmt3->execute();
                      $row3 = $stmt3->fetch();
                      $datacreazione = $row3['DataCreazione'];
                      $stmt4 = $conn->prepare("SELECT Username FROM utenti WHERE 
                              Id=:Id");
                      $idutente = $row3['IdUtente'];
                      $stmt4->bindParam(':Id', $idutente);
                      $stmt4->execute();
                      $row4 = $stmt4->fetch();
                      $username = $row4['Username'];
                      $nomefile = $row['NomeFile'];
                      $descrizione = $row['Descrizione'];
                      $stmt6 = $conn->prepare("SELECT NomeFoto from fotoprofilo 
              WHERE IdUtente= :IdUtente
              ORDER BY Id DESC LIMIT 1 ");
                      $stmt6->bindParam(':IdUtente', $idutente);
                      $stmt6->execute();
                      $row6 = $stmt6->fetch();
                      $nomefotoprofilo = $row6['NomeFoto'];
                      ?><tr>
                  <td><input type="checkbox" class="checkbox" name="<?php echo $row['Id']; ?>" value="cb"></td>
                  <td>
                    <?php
                      postlayoutmp3($id, $username, $nomefile, $descrizione, $nomefotoprofilo, $datacreazione, $url);
                    ?></td>
                </tr><?php
                      break;
                  }
                }
                      ?>
        </table>
        <div style="text-align:center">
          <button class="btn btn-delete btn-sm " type="submit">Rimuovi post selezionati</button>
        </div>
      </form>
    <?php
  } else {
    header('Location: index.php');
    exit;
  }
    ?>
    <br>
    </div>
  </div>
  <div style="text-align:center">
    <form action="nuovopost.php" style="text-align:center">
      <button class="btn btn-primary btn-sm" type="submit">Inserisci un nuovo post</button>
    </form>
  </div>
  <br><br>
  </body>

</html>