<!DOCTYPE html>
<html>
<?php
    require 'header.php';
    ob_start();
    require 'loggedmenu.php';
                  navbarActivator('');
    if(isset($_SESSION['username'])){
                if(isset($_FILES['image'])){                
                    $errors= array();
                    $file_name = $_FILES['image']['name'];
                    $file_size =$_FILES['image']['size'];
                    $file_tmp =$_FILES['image']['tmp_name'];
                    $file_type=$_FILES['image']['type'];
                    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                    
                    $extensions= array("jpeg","jpg","png","mp3","txt");
                    
                    if(in_array($file_ext,$extensions)=== false){
                       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                    }
                    
                    if($file_size > 2097152){
                       $errors[]='File size must be excately 2 MB';
                    }
                    
                    if(empty($errors)==true){
                       move_uploaded_file($file_tmp,"uploads/".$file_name);
                       echo "Success";
                    }else{
                       print_r($errors);
                    }
                $stmt = $conn->prepare("SELECT Id FROM utenti
                WHERE username =:username");
                $stmt->bindParam(':username', $username);
                $username = $_SESSION['username'];
                $stmt->execute();
                $row=$stmt->fetch();
                $id = $row['Id']; 
                $stmt2 = $conn->prepare("INSERT into post(IdUtente,NomeFile,Extension,Descrizione) VALUES(:IdUtente,'$file_name',:Extension,:Descrizione)");              
                $stmt2->bindParam(':IdUtente' , $id);
                $stmt2->bindParam(':Extension',$file_ext);
                $stmt2->bindParam(':Descrizione',$_POST['descrizione']);
                $stmt2->execute();
                header('location: ituoipost.php');
                }         
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
         <h4 id="fontnotsized" style="color:blueviolet" >Nuovo post</h4><br>         
         <form action="" method="POST" enctype="multipart/form-data" sty>
            <div class="custom-file" id="customFile" lang="es">
               <input type="file" class="custom-file-input" name="image" required>
               <label class="custom-file-label" for="image">cerca il file nel tuo dispositivo</label>
            </div>
            <br><br><p id="fontnotsized">Descrizione:</p>
            <input type="text" class="form-control" name="descrizione" maxlength="1024" required><br>
            <button class="btn btn-primary btn-sm" id="font" type="submit">Invia</button>
         </form>        
         <br>
      </div>
   </div>     
   </body>
</html>