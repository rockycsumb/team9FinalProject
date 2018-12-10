<?php

    include '../inc/dbConnection.php';
    $dbConn = getDatabaseConnection("finalproject"); 
    $sql = "SELECT * 
            FROM f_brands 
            WHERE brandID = :id";
        
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute(array("id"=>$_GET['brandID']));
    $resultSet = $stmt -> fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);
?>