<?php
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    
    
    function getCategories() {
        global $conn;
        
        $sql = "SELECT categoryID, categoryName FROM f_category ORDER BY categoryName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record){
            echo "<option value='" . $record["categoryID"] . "'>" . $record['categoryName'] . " </option>";
        }
    }
    
    function getBrands() {
        global $conn;
        
        $sql = "SELECT brandID, brandName FROM f_brands ORDER BY brandName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record){
            echo "<option value='" . $record["brandID"] . "'>" . $record['brandName'] . " </option>";
        }
    }
    
    if(isset($_GET['submitProduct'])){
        $productName = $_GET['productName'];
        $productDescription = $_GET['description'];
        $productImage = $_GET['productImage'];
        $brandID = $_GET['brandID'];
        $catId = $_GET['catId'];
        $productPrice = $_GET['price'];
        
        
        $sql = "INSERT INTO f_product
        (productName, productDescription, productImage, brandID, categoryID, price)
        VALUES(:productName, :productDescription, :productImage, :brandID, :catId, :price)";
        
        $np = array();
        $np[':productName'] = $productName;
        $np[':productDescription'] = $productDescription;
        $np[':productImage'] = $productImage;
        $np[':brandID'] = $brandID;
        $np[':catId'] = $catId;
        $np[':price'] = $productPrice;
        
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        
        $submit = true;
    }
    
    include 'inc/header.php';
?>

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
                        <a class="nav-item nav-link" href="admin.php">Admin Page</a>
                    </div>
                </div>
              <!--<a class="btn btn-outline-light" href="admin.php">Return</a>&nbsp;-->
              <a class="btn btn-outline-light" href="logout.php">Logout</a>            
            </div>
          </nav>
        </div>
    
        <?php 
            if($submit == true){
                echo '<div class="alert alert-success" role="alert"> Product Successfully Added </div>';
            }
        ?>
        
        <div class="container">
            <form id="prodSearch">
                <input type="hidden" name="productId" value="<?=$product['productID']?>" />
                
                    <div class="container">
                      <div class="row">  
                        <div class="col-sm-3">
                            <!-- 2 empty sections in the left -->
                        </div>
                        <div class="col-sm-6">
                            <h4 id="pageTitle">Fill Out New Product Information</h4>
                            <div class="form-group">
                                <label><strong>Product Name</strong></label>    
                                <input type="text" class="form-control" name="productName" placeholder="Enter product name"/>
                            </div>
                            <div class="form-group">
                                <label><strong>Description</strong></label>    
                                <textarea class="form-control" name="description" cols="50" rows="4" placeholder="Enter product description"></textarea>                        
                            </div>
                            <div class="form-group">
                                <label><strong>Price</strong></label>    
                                <input type="text" class="form-control" name="price" placeholder="Enter price"/>
                            </div>
                            <div class="form-group">
                                <label><strong>Category</strong></label>    
                                <select name="catId" class="form-control">
                                    <option>Select One</option>
                                    <?php getCategories($product['categoryID']); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><strong>Brand</strong></label>    
                                <select name="brandID" class="form-control">
                                    <option>Select One</option>
                                    <?php getBrands($product['brandID']); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><strong>Set Image Url</strong></label>    
                                <input type="text" class="form-control" name="productImage" placeholder="Enter image url" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="submitProduct" value="Add Product">Add Product</button>
                                <a class="btn btn-info btn-block" href="admin.php" >Cancel</a>
                            </div>  
                        </div> 
                        <div class="col-sm-3">
                        <!-- 2 empty sections in the right -->
                        </div>
                      </div>
                    </div>
               </div>
            </form>    
        
       <?php include 'inc/footer.php'; ?>