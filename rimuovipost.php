<?php
require 'header.php';
if (isset($_SESSION['username'])) {
        $stmt = $conn->prepare("DELETE FROM post WHERE
                   IdUtente=:userId AND Id=:postId");
        $stmt->bindValue(':userId', $_SESSION['Id']);
        // $foodId is a new variable
        $stmt->bindParam(':postId', $postId);
        // for each element of $_POST, place in $index its index
        // and in $value its value
        foreach ($_POST as $index => $value) {
            if (is_int($index)) {
                echo $index . '<br>';
                $postId = $index;
                $stmt->execute();
            }
        }
        header('Location: ituoipost.php');
} else {
    header('Location: index.php');
    exit;
}

