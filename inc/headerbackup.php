
<?php
    include 'inc/prodSearchHelper.php';
    include 'inc/header.php';
    
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

?>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
            $(document).ready( function(){
                
                $(".likesLink").click( function(){
                    
                    $("#likesNameLabel").html("<?=$product['productName']?>");
                    $('#likesModal').modal("show");
                    $("#likes").html("<img id='loadingImg' src='img/loading.gif'>");
                    
                    $.ajax({
                        
                        type: "GET",
                        url: "inc/getLikes.php",
                        dataType: "json",
                        data: { "id": $("#prodID").val()},
                        success: function(data, status) {
                            console.log(data);
                            console.log(status);
                            if(!data.length){
                                $("#likes").html("<label class='form-control'>No Comments, Add one below!</label> " );
                            }
                            else{
                                $("#likes").append("<form id='prodSearch'> " );
                                $("#likesNameLabel").append(data.length);
                             
                                for (var i = 0; i < data.length; i++) {
                                    $("#likes").append("<div class='form-group'>");
                                    $("#likes").append("<label class='form-control'>" + data[i].comments + "</label>");
                                    $("#likes").append("</div>");
                                }
                            
                                $("#likes").append("</form>");
                                $("#loadingImg").hide();
                            }
                            
                            
                        },
                        error: function(data, status){
                            console.log(data);
                            console.log(status);
                        },
                        complete: function(data, status){
                            //optional, used for debugging purposes
                            //alert(status);
                        }
                        
                        
                    }); // ajax 
                }); //likesLink click
                
                $(".addComment").click( function(){
                    $("#loadingImg").hide();
                    var text = $('#newComment').val();
                    $("#likes").append("<label class='form-control'>" + text + "</label>");
                    $('#newComment').val('');
                    
                    
                }); //addComment click
            }); //document.ready
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
                      <a class="nav-item nav-link" href="">Features</a>
                      <a class="nav-item nav-link" href="admin.php">Admin Page</a>
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
                <input id="prodID" type="hidden" name="productId" value="<?=$product['productID']?>" />
                
                    <div class="container">
                      <div class="row">  
                        <div class="col-sm-3">
                             2 empty sections in the left 
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
                                <button id='<?=$product['productID']?>' type='button' class='btn btn-primary btn-block likesLink'>Reviews</button>
                            </div>
                        </div> 
                        <div class="col-sm-3">
                         2 empty sections in the right 
                        </div>
                      </div>
                    </div>
               </div>
            </form>
            
        </div>
         Modal 
        <div class="modal fade" id="likesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hiden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="likesNameLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="likes"></div>
                    </div>
                    <div class="modal-footer">
                        <form class="container-fluid">
                            <div class='form-group'>
                                <label><strong>New Comment</strong></label>
                                <textarea class='form-control' name='description' id='newComment' cols='50' rows='4' placeholder='Enter new comment'></textarea>
                            </div>
                            <div class='form-group'>
                                <button type='button' class='btn btn-primary btn-block addComment' onclick="">Add Comment</button>
                            </div>
                            <div class='form-group'>
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
      
      <?php include 'inc/footer.php'; ?>
