<?php
    include 'inc/prodSearchHelper.php';
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
        echo $_POST['itemPrice'];
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
    include 'inc/header.php';
?>
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
              <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="#">Features</a>
              <a class="nav-item nav-link" href="admin.php">Admin Page</a>
            </div>
          </div>
          <a class="btn btn-outline-light" href="scart.php">
            <span class="glyphicon glyphicon-shopping-cart">
            </span>Cart: <?php displayCount();?> </a>
        </div>
      </nav>
    </div>
    
    <div class="container">            
      <form id="prodSearch">
        <h4 id="pageTitle">Product Search</h4>
        <div class="form-row">
    
          <div class="col-md-3 mb-3">
            <label><strong>Product ID</strong></label>    
            <input type="text" class="form-control" name="product" placeholder="Enter product name" value="<?php if(isset($_GET['product'])){ echo $_GET['product'];} ?>"/>
          </div>  
          
          <div class="col-md-2 mb-2">             
            <label><strong>Category</strong></label>
            <select name="category" class="form-control">
                <option value=""> Select One </option>
              <?= displayCategories()?>
            </select>
          </div>
      
          <div class="col-md-2 mb-2">
            <label><strong>Brand</strong></label>
            <select name="brand" class="form-control">
              <option value=""> Select One </option>
              <?= displayBrands()?>
            </select>
          </div>
          
          <div class="col-md-1 mb-1">
            <label><strong>From:</strong></label>
            <input type="text" class="form-control" name="priceFrom" value="<?php if(isset($_GET['priceFrom'])){ echo $_GET['priceFrom'];} ?>"/>
          </div>
          
          <div class="col-md-1 mb-1">
            <label for=""><strong>To:</strong></label>
            <input type="text" class="form-control" name="priceTo" value="<?php if(isset($_GET['priceTo'])){ echo $_GET['priceTo'];} ?>"/>
          </div>              
          
          <div class="col-md-2 mb-2">
            <label><strong>Sort By</strong></label><br>
            <div class="form-check form-check-inline">
              
              <input type="radio" class="form-check-input radio" name="orderBy" value="name" <?php if(isset($_GET['orderBy']) && $_GET['orderBy'] == 'name') echo 'checked="checked"'; ?>/>
              <label class="custom-control-label radioLabel" for="name"><strong>Name</strong></label>
              <input type="radio" class="form-check-input radio" name="orderBy" value="price" <?php if(isset($_GET['orderBy']) && $_GET['orderBy'] == 'price') echo 'checked="checked"'; ?>/>
              <label class="custom-control-label radioLabel" for="price"><strong>Price</strong></label>
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
                    
          </div>
        </div>
        
        <?php include 'productDetail.php'; ?>
        <?php include 'inc/footer.php'; ?>