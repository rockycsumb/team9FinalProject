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
        echo "Product has been updated!";
        
    }
    
    if(isset($_GET['productId'])){
        $product = getProductInfo();
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CST336: Team 9 Final Project need store name Product Search</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Mukta" rel="stylesheet">
    </head>
    <body>
        <h1> Team 9 Final Project need store name Product Search </h1>
        <div id="adminLogin">
            <a class="btn" href="admin.php">Return</a>
            <form class="adminButtons" action="logout.php">
                <input type="submit" id='beginning' value="Logout" />
            </form>
        </div>
        <div id="search">
            <form id="searchForm">
                <input type="hidden" name="productId" value="<?=$product['productID']?>" />
                <strong>Product name </strong><input type="text" name="productName" value="<?=$product['productName']?>"><br>
                <strong>Description </strong><textarea name="description" cols="50" rows="4"><?=$product['productDescription']?></textarea><br>
                <strong>Price </strong><input type="text" name="price" value="<?=$product['price']?>"><br>
                <strong>Category</strong>
                <select name="catId">
                    <option>Select One</option>
                    <?php 
                        getCategories($product['categoryID']); 
                    ?>
                </select><br>
                <strong>Brand</strong>
                <select name="brandID">
                    <option>Select One</option>
                    <?php 
                        getBrands($product['brandID']); 
                    ?>
                </select><br>
                <strong>Set Image Url </strong><input type="text" name="productImage" value="<?=$product['productImage']?>"><br>
                <input type="submit" class="btn" name="updateProduct" value="Update Product" />
                <br><br>
            </form>
        </div>
        <div id="footer">
            <hr>
            <br /><br />
            <p>
                CST 336 Internet Programming 2018 &copy; Team 9 <br />
                This website is for academic purposes only.
                <br /><br />
                <img src="img/logo.png" alt="CSUMB logo">
            </p>
        </div>
    </body>
</html>
