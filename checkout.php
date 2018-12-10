<?php
    include 'inc/functions.php';
    session_start();
    
    if (isset($_POST['removeId'])){
      echo'what is this';
      foreach ($_SESSION['cart'] as $itemKey => $item){
        if ($item['id'] == $_POST['removeId']){
          unset($_SESSION['cart'][$itemKey]);
        }
      }
    }
    
    if (isset($_POST['itemId'])){
      foreach($_SESSION['cart'] as &$item){
        if ($item['id'] == $_POST['itemId']){
          $item['quantity'] = $_POST['update'];
        }
      }
    }
    
 ?>
                
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <title>Checkout: Summary</title>
  </head>
  
  <body>
    <!-- Bootstrap Navagation Bar -->
    <div class="sticky-top">
      <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand" href="index.php">E-Wheels </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link" href="index.php">Home</a>
              <!-- <a class="nav-item nav-link" href="#">Features</a>-->
              <a class="nav-item nav-link" href="admin.php">Admin Page</a>
            </div>
          </div>
          <a class="btn btn-outline-light" href="scart.php">
            <span class="fa fa-shopping-cart" ></span>
            Cart: <?php displayCartCount();?> 
          </a>
        </div>
      </nav>
    </div>
              
    <!-- Cart Items -->
    <div class="container" id="prodSearch">
      <h4 id="pageTitle">Checkout: Summary</h4>
      <?php displaySummary();?>
    </div>
    
    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>
  </body>
</html>