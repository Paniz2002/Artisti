
<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=progetto", $username, $password); 
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      $stmt = $conn->prepare("SELECT Id,Username from utenti");
      $stmt->execute();
      while($row=$stmt->fetch()){
        $users[] = array(
            "Id" => $row["Id"],
            "Username" => $row["Username"],
        );
      }
      $file = "gfguserdetails.txt";
      if(file_put_contents($file, 
        json_encode($users)))
        echo("");
      else
        echo("Failed");
    }catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
?>