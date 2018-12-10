<?php
    include 'dbConnection.php';
    $conn = getDatabaseConnection("finalproject");
    
    $sql = "SELECT comments
            FROM f_comments
            WHERE productID = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("id"=>$_GET['productID']));
    $likesResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($newArray);
?>