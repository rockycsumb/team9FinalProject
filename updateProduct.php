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
        <div class="container">
        <!-- Bootstrap Navagation Bar -->
              <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <div id="addProduct">
                        <a class="btn btn-primary" href="admin.php">Return</a>
                        <form class="adminButtons" action="logout.php">
                            <input class="btn btn-primary" type="submit" id='beginning' value="Logout" />
                        </form>
                    </div>
                            
                        </ul>
                </div>
            </nav>
            <?php
                echo $updateAlert;
            ?>
        
            <form id="prodSearch">
                <input type="hidden" name="productId" value="<?=$product['productID']?>" />
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label><strong>Product Name</strong></label>    
                        <input type="text" class="form-control" name="productName" placeholder="Enter product name" value="<?=$product['productName']?>"/>
                    </div>  
                    <div class="col-md-3 mb-3">
                        <label><strong>Description</strong></label>    
                        <textarea class="form-control" name="description" cols="50" rows="4"><?=$product['productDescription']?></textarea>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Price</strong></label>    
                        <input type="text" class="form-control" name="price" value="<?=$product['price']?>"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label><strong>Category</strong></label>    
                        <select name="catId" class="form-control">
                            <option>Select One</option>
                            <?php 
                                getCategories($product['categoryID']); 
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Brand</strong></label>    
                        <select name="brandID" class="form-control">
                            <option>Select One</option>
                            <?php 
                                getBrands($product['brandID']); 
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Set Image Url</strong></label>    
                        <input type="text" class="form-control" name="productImage" value="<?=$product['productImage']?>"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <input type="submit" class="btn btn-primary" name="updateProduct" value="Update Product" />
                    </div>
                </div>
                
                
            </form>
        
        </div>
        <?php include 'inc/footer.php'; ?>