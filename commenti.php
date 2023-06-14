
<html>

<?php 
require 'header.php';
require 'layout.php';

    if(isset($_SESSION['username'])){
        require 'loggedmenu.php';
        navbarActivator('');
        ob_start();

        $stmt=$conn->prepare('SELECT * FROM post WHERE Id=:Id');
        $stmt->bindParam(':Id',$_GET['id']);
        $stmt->execute();
        $row=$stmt->fetch();

        $datacreazione=$row['dataCreazione'];
        $descrizione=$row['Descrizione'];
        $extension=$row['Extension'];
        $idutente=$row['IdUtente'];
        $nomefile=$row['NomeFile'];

        $stmt2=$conn->prepare('SELECT NomeFoto FROM fotoprofilo WHERE IdUtente=:IdUtente');
        $stmt2->bindParam(':IdUtente',$idutente);
        $stmt2->execute();
        $row2=$stmt2->fetch();
        $nomefotoprofilo=$row2['NomeFoto'];

        $stmt3=$conn->prepare('SELECT username FROM utenti WHERE Id=:IdUtente');
        $stmt3->bindParam(':IdUtente',$idutente);
        $stmt3->execute();
        $row3=$stmt3->fetch();
        $username=$row3['username'];
?>
            <div class="jumbotron" >
                <div class="row d-flex justify-content-center ">
                <br>
                    <div class="col-md-8 col-sm-10 col-lg-8 col-xs-4">
                        <form action="" method="post">
                            <button name="redirect" type="submit" style="float:left;width:15%" class="btn btn-primary btn-sm"> &#8592 </button>
                        </form>
                    </div>
                    <div class="col-md-8 col-sm-10 col-lg-8 col-xs-4">

                    <br>
                    </div>
                    <div class="col-md-8 col-sm-10 col-lg-8 col-xs-4" style="min-width:400px;" id="showpost" >
                        <br>
                        <a href="showprofilo.php?username=<?php echo $username; ?>"><img class="img-fluid rounded-circle float-left" style="width:20px;height:20px" src="profilephotos/<?php echo $nomefotoprofilo ;?>" alt="foto profilo"></a>
                        <img class="img-fluid float-right" style="width:25px;height:25px" src="extra/logo_post.png" alt="logo">
                        <p id="postfont" class="float">&nbsp<?php echo $username; ?></p>
                        <p id="postfont" style="color:dimgrey; font-size:x-small" > &nbsp&nbsp<?php echo $datacreazione ?></p>
                        <hr>   
                        <div id="showpost" style="text-align:center;min-height:300px">
                            <?php 
                            switch($row['Extension']){
                                case 'png':
                                case 'jpg':
                                case 'jpeg':
                            ?>
                            <img class="img-fluid imgpost" style="max-height:700px;object-fit:contain" id=""src="uploads/<?php echo $nomefile; ?>" alt ="post">
                            <?php 
                                break; 
                                case 'mp3':
                            ?>
                            <audio controls > 
                                    <source src="uploads/<?php echo $nomefile ?> "><br>
                            </audio>
                            <?php 
                            break;
                            }
                            ?>
                        </div>
                        <hr>
                        <p id="postfont" style="font-size:80%"><?php echo $descrizione; ?></p>
                        <hr>
                        <div id="showpost">
                        <?php
                            $stmt=$conn->prepare('SELECT * from commenti WHERE(IdPost = :IdPost) ORDER BY Data DESC
                            ');
                            $stmt->bindParam(':IdPost',$_GET['id']);
                            $stmt->execute();
                            while($row=$stmt->fetch()){
                                $stmt2=$conn->prepare('SELECT Id FROM utenti WHERE(Username=:Username)');
                                $stmt2->bindParam(':Username',$row['Username']);
                                $stmt2->execute();
                                while($row2=$stmt2->fetch()){
                                    $stmt3=$conn->prepare('SELECT NomeFoto FROM fotoprofilo WHERE IdUtente=:IdUtente');
                                    $stmt3->bindParam(':IdUtente',$row2['Id']);
                                    $stmt3->execute();
                                    $row3=$stmt3->fetch();
                                    $nomefotoprofilo=$row3['NomeFoto'];
                                    ?>
                                    <br><p><a href="showprofilo.php?username=<?php echo $row['Username']; ?>"><img class="img-fluid rounded-circle float-left" style="width:20px;height:20px" src="profilephotos/<?php echo $nomefotoprofilo ;?>" alt="foto profilo"></a>
                                    <strong><?php echo $row['Username'] ?></strong> <?php echo $row['Commento'] ?>
                                    

                                    <?php
                                    if($row['Username']==$_SESSION['username']){
                                        ?>
                                            <form method="post" action="" >
                                                <button type="submit" value="<?php echo $row['Id'] ?>" name="delete" style= ""class="btn btn-sm btn-delete">elimina</button>
                                            </form>
                                        </p>
                                        <?php
                                    }else{
                                        ?>
                                        </p>
                                        <?php
                                    }
                                    ?>
                                    <p id="postfont" style="color:dimgrey; font-size:x-small" > &nbsp&nbsp<?php echo $row['Data'] ?></p>
                                    <?php
                                }
                            }
                            

                        ?>
                        </div>
                        <div style="text-align:center">
                            <form method="post" action="">
                            <input style="width:85%;float:left" name="commento" class="form-control form-control-sm" id="fontnotsized" type="text" placeholder="aggiungi un commento..." required>
                            <button type="submit" class="btn btn-primary btn-sm" name="submit" style="width:15%">invia</button>
                            </form>
                        </div>
                        
                    </div>

                </div>
            </div>
            <br>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    ob_start();
    $stmt=$conn->prepare('INSERT into commenti(Username,Commento,IdPost) 
                          VALUES (:Username,:Commento,:IdPost)');
    $stmt->bindParam(':Username',$_SESSION['username']);
    $stmt->bindParam(':Commento',$_POST['commento']);
    $stmt->bindParam(':IdPost', $_GET['id']);
    $stmt->execute();
    header('refresh:0');
}
        

if(isset($_POST['delete'])){
    ob_start();
    echo $_POST['delete'];
    $stmt=$conn->prepare('DELETE FROM commenti WHERE Id = :Id');
    $stmt->bindParam(':Id',$_POST['delete']);
    $stmt->execute();
    header('refresh:0');
}

if(isset($_POST['redirect'])){
    header('location:'. $_GET['url']);
}

}
    
