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
            <br /> <br /> <br />
        <div class="row" id="productSearch">
        <div class="col">
             <h1> <span class="fa fa-search" ></span></h1>
        <form>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Product Name</th>
                  <th scope="col">Category</th>
                  <th scope="col">Brand</th>
                  <th scope="col">Price</th>
                  <th scope="col">OrderBy</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>
                          <input type="text" name="product" />
                    </td>
                    <td>
                        <select name="category">
                            <option value=""> Select One </option>
                          <?= displayCategories()?>
                        </select>
                    </td>
                    <td>
                         
                        <select name="brand">
                            <option value=""> Select One </option>
                          <?= displayBrands()?>
                        </select>
                    </td>
                    <td>
                        From : <input type="text" name="priceFrom" size="7" />
                        To   :<input type="text" name="priceTo" size="7" />
                    </td>
                    <td>
            
                        Price : <input type="radio" name="orderBy" value="price"/> 
                        Name  : <input type="radio" name="orderBy" value="name" checked/> 
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="center">
                        
                        <input type="submit"  name="searchForm" />
                       
                    </td>
                </tr>
            </tbody>
            </table>
        </form>
        </div>
        <br/>
        <hr>  
        <hr>
        </div>
        <div class="row">
             <div class="col">
                  <?= displaySearchResults() ?> 
            </div>
         </div>
        <hr>  
        <div id="electricDeals" class="row" >
            <div class="col">
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
                                
                                echo  '<div class="carousel-caption d-none d-md-block">
                                    <h5>'.$dealURL[$randomIndex]['productName'].'<br/>MSRP$:'
                                    .$dealURL[$randomIndex]['price'].'</h5> about:<p>'
                                    .$dealURL[$randomIndex]['productDescription'].'</p>  </div>';
                                    
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
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </body>
</html>