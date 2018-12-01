<?php
    include 'inc/functions.php';
    session_start();
    
    if (isset($_POST['removeId']))
    {
        echo'what is this';
        foreach ($_SESSION['cart'] as $itemKey => $item)
        {
            if ($item['id'] == $_POST['removeId'])
            {
                unset($_SESSION['cart'][$itemKey]);
            }
        }
    }
    
    
    if (isset($_POST['itemId']))
    {
        foreach($_SESSION['cart'] as &$item)
        {
            if ($item['id'] == $_POST['itemId'])
            {
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
        <title>Shopping Cart</title>
    </head>
    <body>
        <div class='container'>
            <div class='text-center'>
                
                <!-- Bootstrap Navagation Bar -->
                <nav class='navbar navbar-default - navbar-fixed-top'>
                    <div class='container-fluid'>
                        <div class='navbar-header'>
                            <a class='navbar-brand' href='#'>Shopping Land</a>
                        </div>
                        <ul class='nav navbar-nav'>
                            <li><a href='mainPage.php'>Home</a></li>
                            <li><a href='scart.php'>
                        <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                        </span>Cart: <?php displayCartCount();?> </a></li>
                        </ul>
                    </div>
                </nav>
                <br /> <br /> <br />
                
                <!-- Cart Items -->
                <div id="displayCart">
                <h2>Shopping Cart</h2>
                <?php
                
                displayCart();
               
                    
                ?>
                </div>

            </div>
        </div>
    </body>
</html>