<?php

    include '../inc/dbConnection.php';
    $dbConn = getDatabaseConnection("finalproject"); 
    $sql = "SELECT * 
            FROM f_product 
            WHERE productId = :id";
        
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute(array("id"=>$_GET['productId']));
    $resultSet = $stmt -> fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);
?>