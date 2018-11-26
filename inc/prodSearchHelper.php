    <?php
        include 'dbConnection.php';
       
        $conn = getDatabaseConnection("csumbFinal"); //Starts the Db connection
        
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
                 $sql .=  " AND lower(productDescription) LIKE :productName";
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
                      $sql .= " ORDER BY productDescription";
                 }
                 
                 
             }
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($records as $record) 
            {
                 echo  $record["productName"] . " " . $record["productDescription"] . " $" . $record["price"] . "<br /><br />";
            }
        }
        
    }
        
        //Working
        function getCarosel()
        {
            $arr = array();
            
            return $arr;
        }
    
    ?>
    