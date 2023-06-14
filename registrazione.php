<!DOCTYPE html>
<html>
    <?php
    require 'header.php';?>
        <video  autoplay muted loop>
            <source src="extra/sfondo4.mp4" type="video/mp4">
        </video>    
        <div class="container justify-content-center" >
            <div class="row justify-content-center">     
            <div class="col-sm-9 col-md-7 col-lg-5 justify-content-center"  > 
                <div class="card card-signin my-5" id="registrazione" >
                <div class="card-body">
                <img class="img-fluid float-right" style="width:30px;height:30px;" src="extra/logo_post.png" alt="logo">
                    <h5 class="card-title text-center" id="fontnotsized" >Registrazione</h5>
                    <form class="form-signin" action="registrationok.php" method="post">
                    <div class="form-label-group ">
                        <label for="name" id="font" >Nome</label>
                        <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Nome" required>
                    </div>
                    <div class="form-label-group">
                        <label for="surname" id="font">Cognome</label>
                        <input type="text" id="surname" name="surname" class="form-control form-control-sm" placeholder="Cognome" required>
                    </div>
                    <div class="form-label-group">
                        <label for="username" id="font">Username</label>
                        <input type="text" id="username" name="username" class="form-control form-control-sm" placeholder="Username" required>  
                    </div>
                    <div class="form-label-group">
                        <label for="mail" id="font">Email </label>
                        <input type="email" id="mail" name="mail" class="form-control form-control-sm" placeholder="Email address" required autofocus>                    
                    </div>
                    <div class="form-label-group">
                        <label for="password" id="font">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password" required>                     
                    </div>
                   <div class="form-label-group">
                        <label for="tipoUtente" id="font">Qual'è la tua skill principale?</label>                       
                        <select id="box1" class="form-control form-control-sm"name="tipoUtente" onChange="myNewFunction(this);">
                            <option value="1">Musica</option>
                            <option value="2">Disegno</option>
                            <option value="3">Scultura</option>
                            <option value="4">Architettura</option>
                        </select>
                    </div>
                    <p id="spectator" style="color:red"></p>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block " id="font" type="submit" >Registrati</button>                
                    </form>
                    <br>
                    <p id="font">Hai già un account? <a id="font" href="login.php">Clicca qui</a></p>
                </div>
                </div>
            </div>
            </div>
        </div>    
    </body>
</html>
