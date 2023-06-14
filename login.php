 <!DOCTYPE html>
<html>
	<video autoplay muted loop>
            <source src="extra/sfondo4.mp4" type="video/mp4">
    </video>
    <body>
    <?php
    require 'header.php';?>
        <br><br><br><br>
        <div class="container justify-content-center" >
            <div class="row justify-content-center">
            <div class="col-sm-9 col-md-7 col-lg-5 ">
                <div class="card card-signin my-5" id="registrazione">
                <div class="card-body">
                    <img class="img-fluid float-right" style="width:30px;height:30px;" src="extra/logo_post.png" alt="logo">
                    <h5 id="fontnotsized" class="card-title text-center">Sign in</h5>
                    <form class="form-signin" action="loginok.php" method="post">
                    <div class="form-label-group">
                        <label id="font" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-label-group">
                        <label id="font" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <br>
                    <button id="font" class="btn  btn-primary btn-block " type="submit" >Sign in</button>                 
                    </form>
                    <br>
                    <p id="font">Non hai ancora un account? <a id="font" href="registrazione.php">Clicca qui</a></p>
                </div>
                </div>
            </div>
            </div>
        </div>     
    </body>
</html>
