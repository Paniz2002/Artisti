<!DOCTYPE html>
<html>
<?php
require 'header.php';
$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

if (isset($_SESSION['username'])) {
    header("Refresh: 120;");
    require 'loggedmenu.php';
    navbarActivator('chat');
    $stmt = $conn->prepare("SELECT Id,Cognome,Nome,Mail FROM utenti
                 WHERE username =:username");
    $stmt->bindParam(':username', $username);
    $username = htmlentities($_GET['username']);
    $stmt->execute();
    $row = $stmt->fetch();
    $id = $row['Id'];
    $stmt3 = $conn->prepare("SELECT Id,NomeFoto from fotoprofilo 
                        WHERE IdUtente= :IdUtente
                        ORDER BY Id DESC LIMIT 1 ");
    $stmt3->bindParam(':IdUtente', $id);
    $stmt3->execute();
    $row3 = $stmt3->fetch();
    $fotoprofilo = $row3['NomeFoto'];
?>

    <div class="container">
        <div class="row d-flex justify-content-center ">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-4" id="showpost">
                <div class="align-items-center text-center sticky-top">
                    <br>
                    <h4 id="fontnotsized">
                        <a href="showprofilo.php?username=<?php echo $_GET['username'] ?>">
                            <img class="rounded-circle" style="height:30px;width:30px;" src="profilephotos/<?php echo $fotoprofilo; ?>" alt="foto profilo">
                        </a>
                        <strong><?php echo $_GET['username'] ?> </strong>
                        <form action="" method="post" style="float:right">
                            <button name="refresh" class="btn btn-primary btn-sm">&#x21bb</button>
                        </form>
                    </h4>
                    <hr>
                </div>
                <div class="overflow" style="height:520px" id="scroll">
                    <?php
                    $stmt5 = $conn->prepare(
                        '(SELECT 
                            Id,IdInvia,IdRiceve,Messaggio,DataMessaggio 
                            from chat
                            WHERE(IdInvia=:IdInvia AND IdRiceve=:IdRiceve)
                           )
                           UNION
                           (SELECT Id,IdInvia,IdRiceve,Messaggio,DataMessaggio 
                            from chat 
                            WHERE(IdInvia=:IdRiceve AND IdRiceve=:IdInvia)
                           )
                            ORDER BY DataMessaggio'
                    );
                    $stmt5->bindParam(':IdInvia', $_SESSION['Id']);
                    $stmt5->bindParam(':IdRiceve', $id);
                    $stmt5->execute();
                    while ($comments = $stmt5->fetch()) {
                        if ($comments['IdInvia'] == $_SESSION['Id']) {
                    ?>
                            <div class="rounded invia">
                                <p id="fontnotsized" style="text-align:right;font-size:small"> <?php echo $comments['DataMessaggio']; ?> </p>
                                <p><?php echo $comments['Messaggio']; ?></p>
                            </div>
                            <div style="text-align:right;padding:1px;">
                                <form method="post" action="">
                                    <button type="submit" value="<?php echo $comments['Id'] ?>" name="delete" style="" class="btn btn-sm btn-delete">elimina</button>
                                </form>
                            </div>
                            <br>
                        <?php
                        } else {
                        ?>
                            <div class="rounded riceve">
                                <p id="fontnotsized" style="text-align:right;font-size:small"> <?php echo $comments['DataMessaggio']; ?> </p>
                                <p><?php echo $comments['Messaggio']; ?></p>
                            </div>
                            <br>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div style="background-color:white" class="col-md-12 col-sm-12 col-lg-12 col-xs-4 sticky-bottom" id="scroll">
                <hr>
                <form method="post" action="">
                    <textarea id="font" style="width:85%;float:left;height:35px" name="messaggio" class="form-control" id="fontnotsized" placeholder="invia un messaggio..." required></textarea>
                    <button id="font" type="submit" class="btn btn-primary " name="submit" style="width:15%">invia</button>
                </form>
                <br>
            </div>
        </div>
    </div>
<?php
    if (isset($_POST['messaggio'])) {
        $stmt = $conn->prepare('SELECT * from chat where((IdInvia=:IdInvia and IdRiceve=:IdRiceve) or (IdInvia=:IdRiceve and IdRiceve = :IdInvia))');
        $stmt->bindParam(':IdInvia', $_SESSION['Id']);
        $stmt->bindParam(':IdRiceve', $id);
        $stmt->execute();
        $chat = $stmt->fetch();

        if (empty($chat)) {
            $stmt2 = $conn->prepare('INSERT INTO chatcominciate(IdUtente1,IdUtente2) VALUES(:Id1,:Id2)');
            $stmt2->bindParam(':Id1', $id);
            $stmt2->bindParam(':Id2', $_SESSION['Id']);
            $stmt2->execute();
        }

        $stmt2 = $conn->prepare('INSERT into chat(IdInvia,IdRiceve,Messaggio) VALUES(:IdInvia,:IdRiceve,:Messaggio)');
        $stmt2->bindParam(':IdInvia', $_SESSION['Id']);
        $stmt2->bindParam(':IdRiceve', $id);
        $stmt2->bindParam(':Messaggio', $_POST['messaggio']);
        $stmt2->execute();

        header('refresh:0');
    }

    if (isset($_POST['refresh'])) {
        header('refresh:0');
    }

    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare('DELETE from chat WHERE Id = :Id');
        $stmt->bindParam(':Id', $_POST['delete']);
        $stmt->execute();
        header('refresh:0');
    }
} else {
    header('Location: index.php');
    exit;
}
