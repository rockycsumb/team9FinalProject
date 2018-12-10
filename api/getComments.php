<?php

    include '../inc/dbConnection.php';
    $dbConn = getDatabaseConnection("finalproject"); 
    $sql = "SELECT * 
            FROM f_comments 
            WHERE productID = :id";
        
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute(array("id"=>$_GET['productID']));
    $resultSet = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);
?>