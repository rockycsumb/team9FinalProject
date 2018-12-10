<?php

    session_start();
    
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("finalproject");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    //echo $password;
    
    $sql = "SELECT *
            FROM f_admin
            WHERE username = :username
            AND   password = :password";
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); // expecting one single record
    
    if(empty($record)){
        $_SESSION['incorrect'] = true;
        header("Location:../login.php");
    }
    else{
        //echo $record['firstName'] . " " . $record['lastName'];
        $_SESSION['incorrect'] = false;
        $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
        header("location:../admin.php");
    }
    
?>