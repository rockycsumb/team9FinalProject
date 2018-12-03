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
    
    include 'inc/header.php';
?>


        <script>
            function confirmDelete(){
                return confirm("Are you sure you want to delete the product?");
            }
        </script>
    </head>
    <body>
        <div class="container">
        <!-- Bootstrap Navagation Bar -->
              <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <div id="addProduct">
                        <form class="adminButtons" action="addProduct.php">
                            <input class="btn btn-primary" type="submit" id='beginning' name='adproduct' value="Add Product" />
                        </form>
                        <form class="adminButtons" action="logout.php">
                            <input class="btn btn-primary" type="submit" id='beginning' value="Logout" />
                        </form>
                    </div>
                            
                        </ul>
                </div>
            </nav>
        
        
        <div class="container-fluid" id="prodSearch">
        <?php 
            $records = displayAllProducts();
            echo "<table class='table table-striped'>";
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
                echo "<td>$" . number_format($record['price'], 2, '.', ',') . "</td>";
                echo "<td><a class='btn btn-primary' href='updateProduct.php?productId=".$record['productID']."'>Update</a></td>";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='productId' value= " . $record['productID'] . " />";
                echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
                echo "</form>";
                
                
                
            }
            
            echo "</tbody>";
            echo "</table>";
        
        ?>
        </div>
        </div>
        <?php include 'inc/footer.php'; ?>