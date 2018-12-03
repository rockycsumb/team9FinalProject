<?php
    include './inc/prodSearchHelper.php';
    $dealURL = array();
    $dealURL = getCarosel();

    session_start();
    
    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
    }
 
    if(isset($_POST['itemName']))
    {
        
        $newItem = array();
        $newItem['name'] = $_POST['itemName'];
        $newItem['id'] = $_POST['itemId'];
        $newItem['price'] = $_POST['itemPrice'];
        $newItem['image'] = $_POST['itemImage'];
        $newItem['description'] = $_POST['itemDescription']; // Added by Rocky
        
      foreach($_SESSION['cart'] as &$item){
          if($newItem['id'] == $item['id']){
              $item['quantity'] += 1;
              $found = true;
          }
      }
      
      if($found != true){
          $newItem['quantity'] = 1;
          array_push($_SESSION['cart'], $newItem);
      }
      
    }
?>

<!DOCTYPE html>
<html>
    
    <head>
      <title>Search Page</title>
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
            
      <form id="prodSearch">
        <div class="form-row">
    
          <div class="col-md-3 mb-3">
            <label><strong>Product ID</strong></label>    
            <input type="text" class="form-control" name="product" placeholder="Enter product name" value="<?php if(isset($_GET['product'])){ echo $_GET['product'];} ?>"/>
          </div>  
          
          <div class="col-md-2 mb-3">             
            <label><strong>Category</strong></label>
            <select name="category" class="form-control">
                <option value=""> Select One </option>
              <?= displayCategories()?>
            </select>
          </div>
      
          <div class="col-md-2 mb-3">
            <label><strong>Brand</strong></label>
            <select name="brand" class="form-control">
              <option value=""> Select One </option>
              <?= displayBrands()?>
            </select>
          </div>
          
          <div class="col-md-1 mb-3">
            <label><strong>From:</strong></label>
            <input type="text" class="form-control" name="priceFrom" value="<?php if(isset($_GET['priceFrom'])){ echo $_GET['priceFrom'];} ?>"/>
          </div>
          
          <div class="col-md-1 mb-3">
            <label for=""><strong>To:</strong></label>
            <input type="text" class="form-control" name="priceTo" value="<?php if(isset($_GET['priceTo'])){ echo $_GET['priceTo'];} ?>"/>
          </div>              
          
          <div class="col-md-2 mb-3">
            <label><strong>Sort By</strong></label><br>
            <div class="form-check-inline">
              <input type="radio" class="form-check-input" name="orderBy" value="name" <?php if(isset($_GET['orderBy']) && $_GET['orderBy'] == 'name') echo 'checked="checked"'; ?>/>Name
            </div>
            <div class="form-check-inline">
              <input type="radio" class="form-check-input" name="orderBy" value="price" <?php if(isset($_GET['orderBy']) && $_GET['orderBy'] == 'price') echo 'checked="checked"'; ?>/>Price 
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary" name="searchForm">Search</button>  
      </form>
      
      <?php displaySearchResults()?>
          
      <div id="electricDeals">
            <!--<div class="col">-->
                <h1>Electric <span class="fa fa-bolt" ></span> Deals</h1>
                <?php if (count($dealURL) > 0) { ?>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <?php
                            for($i = 0 ; $i < 5 ; $i++)
                            {
                              echo  "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                              echo ($i == 0)?" class='active'":"";
                              echo " ></li>";
                                
                            }
                        ?>
                    </ol>
                    
                    <div class="carousel-inner" > 
                    <?php 
                          $randomIndex = 0;
                          if(count($dealURL) > 0) //Control the empty ones
                            for( $i = 0; $i <5 ;$i++)
                            {
                              do
                                {
                                    $randomIndex = rand(0,count($dealURL));
                                }while(!isset($dealURL[$randomIndex]));
                                echo '<div class="carousel-item ';
                                echo ($i == 0)?"active": "";
                                echo '">';
                              /*  echo ''.$dealURL[$randomIndex]['productName'] .'';*/
                                echo '<img id="caroImg" align="middle" src="'.$dealURL[$randomIndex]['productImage'].'">';
                                
                                echo  '<div class="carousel-text">
                                    <h5>'.$dealURL[$randomIndex]['productName'].' MSRP$:'
                                    .$dealURL[$randomIndex]['price'].'</h5><p>'
                                    .$dealURL[$randomIndex]['productDescription'].'</p><br></div>';
                                    
                                echo '</div>';
                                unset($dealURL[$randomIndex]);
                            }
                      ?>
                    </div>
                    
                      <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="carousel-control-next-icon " aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    <?php } ?>
                    
                   
            <!--</div>-->
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