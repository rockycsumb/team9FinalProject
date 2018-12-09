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
    
    function displayAveragePrice(){
        global $conn;
        $sql= "SELECT AVG(price) FROM f_product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $avg = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "$".number_format($avg['AVG(price)'], 2, '.', ',');        
    }
    
    function displayTopThreeItems(){
        global $conn;
        $sql= "SELECT productName, price FROM f_product ORDER BY price DESC LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<ol>";
        foreach($items as $item){
          echo "<li>" . $item['productName'] . " - $" . number_format($item['price'],0,'.',',') . "</li>";
        }
        echo "<ol>";
    }
    
    function displayLowThreeItems(){
        global $conn;
        $sql= "SELECT productName, price FROM f_product ORDER BY price ASC LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<ol>";
        foreach($items as $item){
          echo "<li>" . $item['productName'] . " - $" . number_format($item['price'],0,'.',',') . "</li>";
        }
        echo "<ol>";
    }
    
    function displayMostLikedItems(){
        global $conn;
        $sql= "SELECT productName, COUNT(likesID)
               FROM f_product NATURAL JOIN f_likes
               GROUP BY productName
               ORDER BY COUNT(likesID) DESC 
               LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<ol>";
        foreach($items as $item){
          echo "<li>" . $item['productName'] . " Likes: " . $item['COUNT(likesID)'] . "</li>";
        }
        echo "<ol>";
    }
    
    function displayItemCount(){
        global $conn;
        $sql= "SELECT COUNT(*) FROM f_product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $count['COUNT(*)'];        
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
          <!--<a class="btn btn-outline-light" href="addProduct.php">Add Product</a>  &nbsp;-->

          <a class="btn btn-outline-light" href="logout.php">Logout</a>            
        </div>
      </nav>
    </div>
    
  <div class="container">
    <div id="prodSearch">
      <h4 id="pageTitle">Admin Stats</h4>
      <div class="card-group">
      <div class="card bg-light mb-3" style="min-width:10em">
        <div class="card-header">Average Price</div>
        <div class="card-body">
        <p class="card-title">The average price of all items currently in stock</p>
        <h5 class="card-text"><?= displayAveragePrice()?></h5>
        </div>
      </div>
      <div class="card bg-light mb-3" style="min-width:10em">
        <div class="card-header">Most Expensive</div>
        <div class="card-body">
          <p class="card-title">Top 3 Most Expensive Items</p>
          <p class="card-text"><?= displayTopThreeItems()?></p>
        </div>
      </div>
      <div class="card bg-light mb-3" style="min-width:10em">
        <div class="card-header">Number of Items</div>
        <div class="card-body">
          <p class="card-title">Total number of items currently in stock</p>
          <p class="card-text"><?= displayItemCount()?></p>
        </div>
      </div>
      <div class="card bg-light mb-3" style="min-width:10em">
        <div class="card-header">Least Expensive Items</div>
        <div class="card-body">
          <p class="card-title">Top 3 Items</p>
          <p class="card-text"><?= displayLowThreeItems()?></p></p>
        </div>
      </div>
      <div class="card bg-light mb-3" style="min-width:10em">
        <div class="card-header">Most Liked Items</div>
        <div class="card-body">
          <p class="card-title">Top 3 Items</p>
          <p class="card-text"><?= displayMostLikedItems()?></p>
        </div>
      </div>
      </div>
    </div>
    
    <div id="prodSearch">
      <div class="d-flex bd-highlight mb-3">
        <div class="p-2 bd-highlight">
          <h4 id="pageTitle">Product List</h4>
        </div>
        <div class="ml-auto p-2 bd-highlight">
          <a class="btn btn-primary" href="addProduct.php" >Add Product</a>
        </div>
      </div>

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
  </div>
  </div>
  <?php include 'inc/footer.php'; ?>