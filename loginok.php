<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
    require('header.php');    
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=progetto", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $stmt = $conn->prepare("SELECT password, Id FROM Utenti
                    WHERE username =:username");
            $stmt->bindParam(':username', $username);                       
            $username = $_POST['username'];          
            $stmt->execute();          
            $row = $stmt->fetch();                                      
            if($row){
                if(password_verify($_POST['password'], $row['password'])){
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['Id'] = $row['Id'];
                    $stmt2 = $conn->prepare("SELECT IdUtente FROM fotoprofilo WHERE
                                    IdUtente=:IdUtente");
                        $stmt2->bindParam(':IdUtente', $_SESSION['Id']);                      
                        $stmt2->execute(); 
                        $row2=$stmt2->fetch();
                        if($row2){
                        }else{
                            $stmt3 = $conn->prepare("INSERT into fotoprofilo(IdUtente,NomeFoto,Extension) VALUES(:IdUtente,'fotoprofilodefault.png','png')");
                            $stmt3->bindParam(':IdUtente', $_SESSION['Id']);
                            $stmt3->execute(); 
                        }
                        header('location:profilo.php');         
                    exit;
                }
                else{
                    ?><div class="container">
                    <br><div class="row align-items-center" >
                    <div class="col-sm alert alert-danger" role="alert" style="text-align:center">
                        password errata, <a href="login.php" class="alert-link">torna al login</a>
                    </div>
                    </div>
                </div>
                <?php               
                    exit;                    
                }
            }   
            else{
                ?> <div class="container">
                    <br><div class="row align-items-center" >
                    <div class="col-sm alert alert-danger" role="alert" style="text-align:center">
                        username insesistente, <a href="login.php" class="alert-link">torna al login</a>
                    </div>
                    </div>
                </div>
                <?php
                exit;
            } 
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
?>
    </body>
</html>
