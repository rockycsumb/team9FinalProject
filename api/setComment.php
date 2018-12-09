<?php
    include '../inc/dbConnection.php';
    $dbConn = getDatabaseConnection("finalproject"); 
    
    $sql = "INSERT INTO f_likes 
            (productID, comments)
            VALUES (:productID, :comments)";
    
    $np = array();
    $np[':productID']=$_GET['productID'];
    $np[':comments']=$_GET['comments'];
        
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute($np);
    $result =  $stmt -> fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>