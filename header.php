<head>
<link href="https://fonts.googleapis.com/css2?family=Antonio:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="normalyze.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artisti</title>
<link rel="shortcut icon" href="extra/logo_white_largo.png" type="image/png">
<link rel="icon" href="extra/logo_white_largo.png" sizes="32x32" type="image/png">
<link rel="apple-touch-icon-precomposed" href="extra/logo_white_largo.png" type="image/png" sizes="152x152">
<link rel="apple-touch-icon-precomposed" href="extra/logo_white_largo.png" type="image/png" sizes="120x120">
<link rel="icon" href="extra/logo_white_largo.png" sizes="96x96" type="image/png">
</head>
<body>
<?php
    session_start();
    require_once('DBHandler.php');
    require_once('DBHandlerObject.php');
    require 'utentijson.php';
    ob_start();


