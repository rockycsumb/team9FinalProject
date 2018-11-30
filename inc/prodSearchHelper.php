    <?php
        include 'dbConnection.php';
       
        $conn = getDatabaseConnection("finalproject"); //Starts the Db connection
        
        //Working 
        function displayCategories() {
        global $conn;
        
        $sql = "SELECT categoryID, categoryName FROM `f_category` ORDER BY categoryName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            echo "<option value='".$record["categoryID"]."' >" . $record["categoryName"] . "</option>";
        }
        
        
    }
        
        //Working
        function displayBrands() {
        global $conn;
        
        $sql = "SELECT brandID,brandName FROM `f_brands` ORDER BY brandName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            echo "<option value='".$record["brandID"]."' >" . $record["brandName"] . "</option>";
        }
        
    }
    
        //Working    
        function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { 
            
            echo "<h3>Products Found </h3>"; 
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM f_product WHERE 1";
            
            if (!empty($_GET['product'])) { 
                 $sql .=  " AND lower(productName) LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%" ; //contains any case in the decirption
            }
                  
            if (!empty($_GET['category'])) { 
                 $sql .=  " AND categoryID = :categoryId";
                 $namedParameters[":categoryId"] =  $_GET['category'];
             }    
             
             if (!empty($_GET['brand'])) { 
                 $sql .=  " AND brandID = :brandId";
                 $namedParameters[":brandId"] =  $_GET['brand'];
             }    
            
             if (!empty($_GET['priceFrom'])) {
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
             }
             
            if (!empty($_GET['priceTo'])) {
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
             }
            
             if (isset($_GET['orderBy'])) {
                 
                 if ($_GET['orderBy'] == "price") {
                     
                     $sql .= " ORDER BY price";
                     
                 } else {
                      //Implied
                      $sql .= " ORDER BY productName";
                 }
                 
                 
             }
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<table class='table'>";
                foreach($records as $item)
                {
                 
                    $itemName = $item['productName'];
                    $itemPrice = $item['price'];
                    $itemImage = $item['productImage'];
                    $itemId = $item['productID'];
                    
                    echo "<tr>";
                    
                    echo "<td><img width='200px' height='200px' src='$itemImage'></td>";
                    echo "<td><h4>$itemName</h4></td>";
                    echo "<td><h4>$itemPrice</h4></td>";
                    echo "<form method='post'>";
                    
                    echo "<input type='hidden' name='itemName' value='$itemName'>";
                    echo "<input type='hidden' name='itemId' value='$itemId'>";
                    echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
                    echo "<input type='hidden' name='itemImage' value='$itemImage'>";
                        
                    if($_POST['itemId'] == $itemId)
                        echo "<td><button class='btn btn-success'>Added</button></td>";
                    else
                        echo "<td><button class='btn btn-warning'>Add</button></td>";
                    echo "</form>";
                    
                    echo "</tr>";        
                 }
                }
                echo "</table>";
    
            
        
        
    }
        
        //Working
        function getCarosel()
        {
         $arr = array();
         global $conn;
         $sql = "SELECT * FROM `f_product` ORDER BY price LIMIT 10";
         $stmt = $conn->prepare($sql);
         $stmt->execute();
         $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $index = 0;
        foreach ($records as $record) {
           $arr[$index]= $record;
           $index ++;
        }
            return $arr;
        }
    
        
         function displayCount(){
            echo count($_SESSION['cart']);
        }
    ?>
    