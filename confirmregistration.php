<?php
require 'header.php';
$_SESSION['confirm']=false;

$key= random_bytes(20);

$_SESSION['key']=bin2hex($key);

echo $_SESSION['key'];

$msg = 'Benvenuto su artisti, clicca su questo link per confermare la tua email
        \n http://localhost/panizzolo/artisti/confirmregistration.php?confirm='.$_SESSION['key'];

$from_address = "nicola.panizzolo@ptpvenezia.edu.it";

mail($_POST['mail'],
     "Conferma registrazione",
     $msg,
    "From: $from_address",
    "-f $from_address");

?>
<div class="container">
    <div class="align-items-center text-center rounded" style="background-color:white; text-align:center; padding:20px;">
    Conferma la tua registrazione al link che ti abbiamo inviato sulla mail.

    </div>
</div>
