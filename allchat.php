<!DOCTYPE html>
<html>
<?php 
    require 'header.php';
    require 'layout.php';
    $url = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

    if(isset($_SESSION['username'])){
        header("Refresh: 120;");
        require 'loggedmenu.php';
        navbarActivator('chat');
        ?>
        <div class="container">
                <div class="row d-flex justify-content-center ">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-4" id="showpost">
                        <h3 id="fontnotsized" style="color:blueviolet;text-align:center">Messaggi</h3>
                        <hr>
                        <?php
                        $stmt=$conn->prepare('SELECT IdUtente2 from chatcominciate where( IdUtente1 = :Id)
                                              UNION 
                                              SELECT IdUtente1 from chatcominciate where( IdUtente2 = :Id)');
                        $stmt->bindParam(':Id',$_SESSION['Id']);
                        $stmt->execute();
                        while($row=$stmt->fetch()){
                            
                            echo '<br>';
                            if(isset($row['IdUtente2'])){
                                $stmt2=$conn->prepare('SELECT Username,NomeFoto 
                                                        from utenti 
                                                        inner join fotoprofilo on utenti.Id = fotoprofilo.IdUtente 
                                                        WHERE utenti.Id = :Id');
                                $stmt2->bindParam(':Id',$row['IdUtente2']);
                                $stmt2->execute();
                                $user=$stmt2->fetch();
                                ?>
                                <div id="showchat">
                                    <h4 id="fontnotsized">
                                    <img class="rounded-circle" src="profilephotos/<?php echo $user['NomeFoto'] ?>" style="width:30px;height:30px" alt="fotoprofilo">
                                    <?php echo $user['Username']; ?>
                                    <a href="chat.php?username=<?php echo $user['Username']; ?>">
                                    <button  name="vai" class="btn btn-primary btn-sm" style="float:right"> Vai </button>
                                    </a>
                                    </h4>
                                    <hr>
                                </div>
                                <?php
                            }else if(isset($row['IdUtente1'])){
                                $stmt2=$conn->prepare('SELECT Username,NomeFoto 
                                                        from utenti 
                                                        inner join fotoprofilo on utenti.Id = fotoprofilo.IdUtente 
                                                        WHERE utenti.Id = :Id');
                                $stmt2->bindParam(':Id',$row['IdUtente1']);
                                $stmt2->execute();
                                $user=$stmt2->fetch();
                                ?>
                                <div id="showchat">
                                    <h4 id="fontnotsized">
                                    <img class="rounded-circle" src="profilephotos/<?php echo $user['NomeFoto'] ?>" style="width:30px;height:30px" alt="fotoprofilo">
                                    <?php echo $user['Username']; ?>
                                    <a href="chat.php?username=<?php echo $user['Username']; ?>">
                                    <button  name="vai" class="btn btn-primary btn-sm" style="float:right"> Vai </button>
                                    </a>
                                    </h4>
                                    <hr>
                                </div>
                                <?php
                            }   
                        }
                        ?>
                    </div>
                </div>
        </div>
        <?php
    }else{
        header('location:index.php');
        exit;
    }