<?php

    include '../dbConnection.php';
    $dbConn = getDatabaseConnection("ottermart"); 
    $sql = "SELECT * 
            FROM f_product 
            WHERE productId = :id";
        
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute(array("id"=>$_GET['productId']));
    $resultSet = $stmt -> fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);
?>