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
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
            return $record;
        }
        
    }
     function getCategory($catId) {
        global $conn;
        
        $sql = "SELECT categoryID, categoryName FROM f_category WHERE categoryID = $catId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    function getBrand($brandID) {
        global $conn;
        
        $sql = "SELECT brandID, brandName FROM f_brands WHERE brandID = $brandID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
    
    
    $product = getProductResult();
    $productCategory = getCategory($product['categoryID']);
    $productBrand = getBrand($product['brandID']);

    include 'inc/header.php';
?>
    <script>
        function goBack() {
            window.history.back();
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
                      <a class="nav-item nav-link" href="#">Admin Page</a>
                    </div>
                  </div>
                  <a class="btn btn-outline-light" href="scart.php">
                    <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                    </span>Cart: <?php displayCount();?> </a>
                       
                </div>
            </nav>
        </div>
        <div class="container">
                <form id="prodSearch">
                <input type="hidden" name="productId" value="<?=$product['productID']?>" />
                
                    <div class="container">
                      <div class="row">  
                        <div class="col-sm-3">
                            <!-- 2 empty sections in the left -->
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h4 id="pageTitle">Product Details</h4>
                                <img class="form-control" src="<?=$product['productImage']?>"/>
                            </div>
                            <div class="form-group">
                                
                                <label><strong>Product Name</strong></label>    
                                <label class="form-control" ><?=$product['productName']?></label>
                            </div>  
                            <div class="form-group">
                                <label><strong>Description</strong></label>    
                                <label class="form-control" cols="50" rows="4"><?=$product['productDescription']?></label>
                            </div>
                            <div class="form-group">
                                <label><strong>Price</strong></label>    
                                <label class="form-control" ><?=$product['price']?></label>
                            </div>
                        
                            <div class="form-group">
                                <label><strong>Category</strong></label>    
                                <label class="form-control" ><?=$productCategory['categoryName']?></label>
                            </div>
                            <div class="form-group">
                                <label><strong>Brand</strong></label>    
                                <label class="form-control"><?=$productBrand['brandName']?></label>
                            </div>
                            
                        
                            <div class="form-group">
                                <a class="btn btn-primary btn-block" onclick="goBack()" >Return</a>
                            </div>
                        </div> 
                        <div class="col-sm-3">
                        <!-- 2 empty sections in the right -->
                        </div>
                      </div>
                    </div>
               </div>
            </form>
            
        </div>
        
      
      
      <?php include 'inc/footer.php'; ?>