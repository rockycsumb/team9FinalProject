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
    <div class="sticky-top">
      <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand" href="index.php">E-Wheels</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link" href="index.php">Home</a>
              <a class="nav-item nav-link" href="#">Features</a>
              <a class="nav-item nav-link active" href="#">Admin Page<span class="sr-only">(current)</span></a>
            </div>
          </div>
          <a class="btn btn-outline-light" href="addProduct.php">Add Product</a>  
          <a class="btn btn-outline-light" href="logout.php">Logout</a>            
        </div>
      </nav>
    </div>

        <div class="container" id="prodSearch">
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