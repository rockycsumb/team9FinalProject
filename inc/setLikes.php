<?php
    function setLikes($id, $newComment){
        
        include 'dbConnection.php';
        $conn = getDatabaseConnection("finalproject");
        
        $sql = "INSERT INTO f_likes (productID, comments)
                VALUES(:productID, :comments)";
            
        $stmt = $conn->prepare($sql);
        $stmt->execute(array("productID"=>$id, "comments"=>$newComment));
    }
    
?>