<?php
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    session_start();
    if(!isset($_SESSION['adminName'])){
        header("Location:login.php");
    }
    
    function getCategories($catId) {
        global $conn;
        
        $sql = "SELECT categoryID, categoryName FROM f_category ORDER BY categoryName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
            echo "<option ";
            echo ($record["categoryID"] == $catId)? "selected": "";
            echo " value='" . $record["categoryID"] . "'>" . $record['categoryName'] . " </option>";
        }
    }
    
    function getBrands($brandID) {
        global $conn;
        
        $sql = "SELECT brandID, brandName FROM f_brands ORDER BY brandName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record){
            echo "<option ";
            echo ($record["brandID"] == $brandID)? "selected": "";
            echo " value='" . $record["brandID"] . "'>" . $record['brandName'] . " </option>";
        }
    }
    
    function getProductInfo(){
        global $conn;
        
        $sql = "SELECT * FROM f_product WHERE productID = " . $_GET['productId'];
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    
    
    if(isset($_GET['updateProduct'])){
        
        $sql = "UPDATE f_product
                SET productName = :productName,
                    productDescription = :productDescription,
                    productImage = :productImage,
                    brandID = :brandID,
                    categoryID = :catId,
                    price = :price
                WHERE productID = :productId";
                
        $np = array();
        $np[":productName"] = $_GET['productName'];
        $np[":productDescription"] = $_GET['description'];
        $np[":productImage"] = $_GET['productImage'];
        $np[":brandID"] = $_GET['brandID'];
        $np[":catId"] = $_GET['catId'];
        $np[":price"] = $_GET['price'];
        $np[":productId"] = $_GET['productId'];
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $updateAlert= '<div class="container"><div class="alert alert-success" role="alert">Product has been updated!</div></div>';
        
    }
    
    if(isset($_GET['productId'])){
        $product = getProductInfo();
    }

    include 'inc/header.php'    ;
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
              <a class="nav-item nav-link" href="#">Features</a>
              <a class="nav-item nav-link" href="#">Admin Page</a>
            </div>
          </div>
          <a class="btn btn-outline-light" href="admin.php">Return</a>&nbsp;
          <a class="btn btn-outline-light" href="logout.php">Logout</a>            
        </div>
      </nav>
    </div>
    <div class="container-fluid h-100" id="prodSearch">
         <div class="row justify-content-center align-items-center h-100">
                <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <?php
                echo $updateAlert;
            ?>
        
            <form>
                <h4 id="pageTitle">Update Product Information</h4>
                <input type="hidden" name="productId" value="<?=$product['productID']?>" />
                
                    <div class="form-group">
                        <label><strong>Product Name</strong></label>    
                        <input type="text" class="form-control" name="productName" placeholder="Enter product name" value="<?=$product['productName']?>"/>
                    </div>  
                    <div class="form-group">
                        <label><strong>Description</strong></label>    
                        <textarea class="form-control" name="description" cols="50" rows="4"><?=$product['productDescription']?></textarea>
                    </div>
                    <div class="form-group">
                        <label><strong>Price</strong></label>    
                        <input type="text" class="form-control" name="price" value="<?=$product['price']?>"/>
                    </div>
                
                    <div class="form-group">
                        <label><strong>Category</strong></label>    
                        <select name="catId" class="form-control">
                            <option>Select One</option>
                            <?php 
                                getCategories($product['categoryID']); 
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong>Brand</strong></label>    
                        <select name="brandID" class="form-control">
                            <option>Select One</option>
                            <?php 
                                getBrands($product['brandID']); 
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong>Set Image Url</strong></label>    
                        <input type="text" class="form-control" name="productImage" value="<?=$product['productImage']?>"/>
                    </div>
                
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="updateProduct" value="Update Product" />
                    </div>
               
                
                
            </form>
        
        </div></div></div>
        <?php include 'inc/footer.php'; ?>