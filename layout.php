<?php
function postlayout($id, $usernameutente, $nomefile, $descrizione, $nomefotoprofilo, $datacreazione, $url)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=progetto", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT COUNT(Id) FROM commenti WHERE (IdPost=:Id)");
    $stmt->bindParam(':Id', $id);
    $stmt->execute();
    $row = $stmt->fetch();
    $countcomments = $row['COUNT(Id)'];
?>
    <div class="row d-flex justify-content-center ">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-6" style="min-width:400px" id="showpost">
            <br>
            <a href="showprofilo.php?username=<?php echo $usernameutente; ?>"><img class="img-fluid rounded-circle float-left" style="width:20px;height:20px" src="profilephotos/<?php echo $nomefotoprofilo; ?>" alt="foto profilo"></a>
            <img class="img-fluid float-right" style="width:25px;height:25px" src="extra/logo_post.png" alt="logo">
            <p id="postfont" class="float">&nbsp<?php echo $usernameutente; ?></p>
            <p id="postfont" style="color:dimgrey; font-size:x-small"> &nbsp&nbsp<?php echo $datacreazione ?></p>
            <hr>
            <div id="showpost" style="text-align:center;">
                <a href="commenti.php?id=<?php echo $id; ?>&url=<?php echo $url; ?>">
                    <img class="img-fluid imgpost" id="image" style="max-height:550px;object-fit:contain" src="uploads/<?php echo $nomefile; ?>" alt="post">
                </a>
            </div>
            <hr>
            <p id="postfont" style="font-size:80%"><?php echo $descrizione; ?></p>
            <hr>
            <?php
            if ($row['COUNT(Id)'] >= 1) {
            ?>
                <div id="showpost">
                    <?php
                    $stmt = $conn->prepare('SELECT * from commenti WHERE(IdPost = :IdPost) ORDER BY Data DESC LIMIT 2');
                    $stmt->bindParam(':IdPost', $id);
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {

                        $stmt2 = $conn->prepare('SELECT Id FROM utenti WHERE(Username=:Username)');
                        $stmt2->bindParam(':Username', $row['Username']);
                        $stmt2->execute();
                        while ($row2 = $stmt2->fetch()) {
                            $stmt3 = $conn->prepare('SELECT NomeFoto FROM fotoprofilo WHERE IdUtente=:IdUtente');
                            $stmt3->bindParam(':IdUtente', $row2['Id']);
                            $stmt3->execute();
                            $row3 = $stmt3->fetch();
                            $nomefotoprofilo = $row3['NomeFoto'];
                    ?>
                            <br><a href="showprofilo.php?username=<?php echo $row['Username']; ?>"><img class="img-fluid rounded-circle float-left" style="width:20px;height:20px" src="profilephotos/<?php echo $nomefotoprofilo; ?>" alt="foto profilo"></a>
                            <p><strong><?php echo $row['Username'] ?></strong> <?php echo $row['Commento'] ?>
                                <?php
                                if ($row['Username'] == $_SESSION['username']) {
                                ?>
                            <form method="post" action="">
                                <button type="submit" value="<?php echo $row['Id'] ?>" name="delete" style="" class="btn btn-sm btn-delete">elimina</button>
                            </form>
                            </p>
                        <?php
                                } else {
                        ?>
                            </p>
                        <?php
                                }
                        ?>
                        <p id="postfont" style="color:dimgrey; font-size:x-small"> &nbsp&nbsp<?php echo $row['Data'] ?></p>
                <?php
                        }
                    }
                ?>
                </div>
            <?php
            }
            ?>
            <div style="float:right">
                <p id="font" style="color:blueviolet">
                    <?php
                    echo $countcomments;
                    ?>
                    commenti <a href="commenti.php?id=<?php echo $id; ?>&url=<?php echo $url; ?>">
                        <button type="" class="btn btn-primary btn-sm"> &#x26f6</button>
                    </a>
                </p>
            </div>
        </div>
    </div>
    <br>
<?php
}
function postlayoutmp3($id, $usernameutente, $nomefile, $descrizione, $nomefotoprofilo, $datacreazione, $url)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=progetto", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT COUNT(Id) FROM commenti WHERE (IdPost=:Id)");
    $stmt->bindParam(':Id', $id);
    $stmt->execute();
    $row = $stmt->fetch();
    $countcomments = $row['COUNT(Id)'];
?>
    <div class="row d-flex justify-content-center ">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-6" style="min-width:400px" id="showpost">
            <br>
            <a href="showprofilo.php?username=<?php echo $usernameutente; ?>"><img class="img-fluid rounded-circle float-left" style="width:20px;height:20px" src="profilephotos/<?php echo $nomefotoprofilo; ?>"></a>
            <img class="img-fluid float-right" style="width:25px;height:25px" src="extra/logo_post.png" alt="logo">
            <p id="postfont" class="float">&nbsp<?php echo $usernameutente; ?></p>
            <p id="postfont" style="color:dimgrey; font-size:x-small"> &nbsp&nbsp<?php echo $datacreazione ?></p>
            <hr>
            <div id="showpost" style="text-align:center;min-height:300px">
                <audio controls>
                    <source src="uploads/<?php echo $nomefile ?> "><br>
                </audio>
            </div>
            <hr>
            <p id="postfont" style="font-size:80%"><?php echo $descrizione; ?></p>
            <hr>
            <?php
            if ($row['COUNT(Id)'] >= 1) {
            ?>
                <div id="showpost">
                    <?php
                    $stmt = $conn->prepare('SELECT * from commenti WHERE(IdPost = :IdPost) ORDER BY Data DESC LIMIT 2
                            ');
                    $stmt->bindParam(':IdPost', $id);
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                        $stmt2 = $conn->prepare('SELECT Id FROM utenti WHERE(Username=:Username)');
                        $stmt2->bindParam(':Username', $row['Username']);
                        $stmt2->execute();
                        while ($row2 = $stmt2->fetch()) {
                            $stmt3 = $conn->prepare('SELECT NomeFoto FROM fotoprofilo WHERE IdUtente=:IdUtente');
                            $stmt3->bindParam(':IdUtente', $row2['Id']);
                            $stmt3->execute();
                            $row3 = $stmt3->fetch();
                            $nomefotoprofilo = $row3['NomeFoto'];
                    ?>
                            <br><a href="showprofilo.php?username=<?php echo $row['Username']; ?>"><img class="img-fluid rounded-circle float-left" style="width:20px;height:20px" src="profilephotos/<?php echo $nomefotoprofilo; ?>" alt="foto profilo"></a>
                            <p>
                                <strong><?php echo $row['Username'] ?></strong> <?php echo $row['Commento'] ?>
                            </p>
                            <p id="postfont" style="color:dimgrey; font-size:x-small"> &nbsp&nbsp<?php echo $row['Data'] ?></p>
                    <?php
                        }
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <div style="float:right">
                <p id="font" style="color:blueviolet">
                    <?php
                    echo $countcomments;
                    ?>
                    commenti <a href="commenti.php?id=<?php echo $id; ?>&url=<?php echo $url; ?>">
                        <button type="" class="btn btn-primary btn-sm"> &#x26f6</button>
                    </a>
                </p>
            </div>
        </div>
    </div>
    <br>
<?php
}
?>