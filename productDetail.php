<?php
    include './inc/prodSearchHelper.php';
    session_start();
    
    function getProductResult(){
    $conn = getDatabaseConnection($dbname = "finalproject");
    
    if(isset($_GET['productID']))
    {
    $productID = $_GET['productID']; //Get from the Get request
    $sql = "SELECT * 
                    FROM f_product
                    WHERE productID = :pId
                    ";
            
    $np = array();
    $np[":pId"] = $productID;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<table>";
    echo "<tr>";
    echo '<th>Product Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th>Description</th>';
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo $records['productName'] . "";
    echo "</td>";
    echo "<td colspan='3'>";
    echo "<img src='" . $records['productImage'] . "' width='200'/>";
    echo "</td>";
    echo "<td>";
    echo $records['productDescription'];
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo "*******Likes are Here ********";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo "*******Comments are Here ********";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    }
        
    }


?>




<!DOCTYPE html>
<html>
    
    <head>
      <title>Product Details Page</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="css/styles.css" rel="stylesheet" type="text/css" />
      <link href="https://fonts.googleapis.com/css?family=Fira+Sans|Nunito|Roboto" rel="stylesheet">
    </head>
    <body>
        <div class="container">
           <!-- Bootstrap Navagation Bar -->
              <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                      <ul class='nav navbar-nav'>
                            <li><a href='mainPage.php'>Home</a></li>
                            <li><a href='scart.php'>
                            <span class='glyphicon glyphicon-shopping-cart' area-hidden='true'>
                                Cart: <?php displayCount();?>
                            </span>
                            </a></li>
                        </ul>
                </div>
            </nav>
            <div class="row">
               <?php
               getProductResult()
               ?>
            </div>
        </div>
        
      <footer>
        Team 9 | Final Project<br>
        CST336-40 Internet Programming 2018&copy; <br/>
        <strong>Disclaimer:</strong> The information in this webpage is ficticious.  It is used for academic purposes only.
        <figure><a href="https://csumb.edu/"><img src="img/csumb_logo.png" alt="CSUMB logo"/></a></figure>
      </footer>  
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      </div>
    </body>
</html>