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
        (productName, productDescription, productImage, brandID, categoryID, price, likesID)
        VALUES(:productName, :productDescription, :productImage, :brandID, :catId, :price, :likesID)";
        
        $np = array();
        $np[':productName'] = $productName;
        $np[':productDescription'] = $productDescription;
        $np[':productImage'] = $productImage;
        $np[':brandID'] = $brandID;
        $np[':catId'] = $catId;
        $np[':price'] = $productPrice;
        $np[':likesID'] = 1;
        
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        
        $submit = true;
    }
    
    include 'inc/header.php';
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
            if($submit == true){
                echo '<div class="alert alert-success" role="alert"> Product Add Succesful </div>';
            }
              
        ?>
        <form id="prodSearch">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label><strong>Product Name</strong></label>    
                        <input type="text" class="form-control" name="productName" placeholder="Enter product name" />
                    </div>  
                    <div class="col-md-3 mb-3">
                        <label><strong>Description</strong></label>    
                        <textarea class="form-control" name="description" cols="50" rows="4" placeholder="Enter product description"></textarea>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Price</strong></label>    
                        <input type="text" class="form-control" name="price" placeholder="Enter price"/>
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
                        <input type="text" class="form-control" name="productImage" placeholder="Enter image url" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <input type="submit" class="btn btn-primary" name="submitProduct" value="Add Product" />
                    </div>
                </div>
                
                
            </form>
        
        </div>
       <?php include 'inc/footer.php'; ?>