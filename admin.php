<?php
    
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection("finalproject");
    
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:login.php");
    }
    
    function displayAllProducts(){
        global $conn;
        $sql= "SELECT * FROM f_product ORDER BY productID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CST336: Team 9 Final Project need store name Product Search</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Mukta" rel="stylesheet">
        <script>
            function confirmDelete(){
                return confirm("Are you sure you want to delete the product?");
            }
        </script>
    </head>
    <body>
        <h1> Team 9 final project need store name Product Search </h1>
        <div id="addProduct">
            <form class="adminButtons" action="addProduct.php">
                <input type="submit" id='beginning' name='adproduct' value="Add Product" />
            </form>
            <form class="adminButtons" action="logout.php">
                <input type="submit" id='beginning' value="Logout" />
            </form>
        </div>
        <br /> <br />
        <?php 
            $records = displayAllProducts();
            echo "<table clas='table'>";
            echo "<thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Update</th>
                        <th scope='col'>Remove</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            foreach($records as $record){
                echo "<tr>";
                echo "<td>" . $record['productID'] . "</td>";
                echo "<td>" . $record['productName'] . "</td>";
                echo "<td>" . $record['productDescription'] . "</td>";
                echo "<td>" . $record['price'] . "</td>";
                echo "<td><a class='btn' href='updateProduct.php?productId=".$record['productID']."'>Update</a></td>";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='productId' value= " . $record['productId'] . " />";
                echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
                echo "</form>";
                
                
                
            }
            
            echo "</tbody>";
            echo "</table>";
        ?>
        <div id="footer">
            <hr>
            <br /><br />
            <p>
                CST 336 Internet Programming 2018 &copy; Team 9 <br />
                This website is for academic purposes only.
                <br /><br />
                <img src="img/logo.png" alt="CSUMB logo">
            </p>
        </div>
    </body>
</html>