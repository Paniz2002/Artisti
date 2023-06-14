<?php
function navbarActivator($active)
{
  try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=progetto", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //require pdoprefix.php;
    $stmt = $conn->prepare("SELECT NomeFoto from fotoprofilo 
                        WHERE IdUtente= :IdUtente
                        ORDER BY Id DESC LIMIT 1 ");
    $stmt->bindParam(':IdUtente', $_SESSION['Id']);
    $stmt->execute();
    $row = $stmt->fetch();
?>
    <head>
      <script src="autocomplete.js"></script>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    </head>
    <style>
      #font {
        font-family: 'Cairo', sans-serif;
      }
      #postfont {
        font-family: 'Cairo', sans-serif;
      }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:hotpink;">
    <a class="navbar-brand">
        <img src="extra/logo_white_largo2.png" style="width:35px;text-align:right;" alt="logo navbar bianco">
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if ($active == "profilo") {
                                      echo "active";
                                    } else {
                                      echo "noactive";
                                    } ?>">
              <a class="nav-link" id="font" href="profilo.php">
                <img class="rounded-circle" src="profilephotos/<?php echo $row['NomeFoto']; ?> " style="width:25px;height:25px" alt="foto profilo">
              </a>
          <li class="nav-item <?php if ($active == "home") {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>">
            <a class="nav-link " id="font" href="home.php">Home</a>
          </li>

          <li class="nav-item <?php if ($active == "esplora") {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>">
            <a class="nav-link " id="font" href="esplora.php">Esplora</a>
          </li>

          <li class="nav-item <?php if ($active == "ituoipost") {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>">
            <a class="nav-link " id="font" href="ituoipost.php">I&nbsptuoi&nbsppost</a>
          </li>

          <li class="nav-item <?php if ($active == "chat") {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>">
            <a class="nav-link " id="font" href="allchat.php">Chat</a>
          </li>                    

          <li class="nav-item <?php if ($active == "logout") {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>">
            <a class="nav-link " id="font" href="logout.php">Logout</a>
          </li>

          
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" autocomplete="off" action="/panizzolo/artisti/showprofilo.php">
          <div class="autocomplete" >
            <input id="myInput" class="form-control form-control-sm mr-sm-2" type="search" name="username" placeholder="Search users..." >
            <button id="font" type="submit" class="btn btn-primary btn-sm " >Search</button>
          </div>
        </form>
    </div>
    </nav><br><br><br>
<?php if($active=="home"){
function  buttonActivator($activebutton){
?>
<a href="home.php">
  <button class="btn btn-primary btn-sm <?php if ($activebutton == "home") {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>" type="submit" style="width:20%;float:left">Tutti</button>
</a>
<a href="home.php?id=1">
<button class="btn btn-primary btn-sm <?php if ($activebutton == 1) {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>" type="submit" style="width:20%;float:left">Musica</button>
</a>
<a href="home.php?id=2">
<button class="btn btn-primary btn-sm <?php if ($activebutton == 2) {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>" type="submit" style="width:20%;float:left">Disegno</button>
</a>
<a href="home.php?id=3" >
<button class="btn btn-primary btn-sm <?php if ($activebutton == 3) {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>" type="submit" style="width:20%;float:left">Scultura</button>
</a>
<a href="home.php?id=4" >
<button class="btn btn-primary btn-sm <?php if ($activebutton == 4) {
                                echo "active";
                              } else {
                                echo "noactive";
                              } ?>" type="submit" style="width:20%;float:left">Architettura</button>
</form>
</a>
<?php
}
}} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
} ?>