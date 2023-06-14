<?php
            require 'header.php';           
            $stmt = $conn->prepare("INSERT INTO utenti(Nome, Cognome, Username, Password, Mail, IdTipoUtente)
                    values(:name, :surname, :username, :password, :mail, :idtipoutente)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':idtipoutente', $idtipoutente);
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $mail = $_POST['mail'];
            $idtipoutente = $_POST['tipoUtente'];
            $_SESSION['username'] = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->execute();
            header('Location: login.php');
      

