<?php

    include '../inc/dbConnection.php';
    $dbConn = getDatabaseConnection("finalproject"); 
    $sql = "SELECT * 
            FROM f_category 
            WHERE categoryID = :id";
        
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute(array("id"=>$_GET['categoryID']));
    $resultSet = $stmt -> fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);
?>