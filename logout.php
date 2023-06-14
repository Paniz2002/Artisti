<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<?php 
    require 'header.php';
    if(isset($_SESSION['username'])){
        require 'loggedmenu.php';
        navbarActivator('logout');              
    }
    else{
        header('Location: index.php');
        exit;  
    }
?>
          <br>
            <div class="container">
                <div class="align-items-center text-center rounded" style="background-color:white; text-align:center; padding:20px;">
                    <br>                    
                    <form action="esci.php" method="POST" enctype="multipart/form-data" sty>
                        <h5 id="fontnotsized" >Vuoi uscire dal tuo account?<br>(Dovrai rieffettuare il login in seguito)</h5>
                        <button class="btn btn-primary" type="submit">Esci</button>
                    </form>
                    <br>
                </div>
            </div>   
</body>
</html>

