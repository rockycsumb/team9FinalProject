<!--AJAX Modal From-->

<script>
    $(document).ready( function(){
        var prodID = 0;
        $(".prodDetails").click( function(){
            
            //alert($(this).attr('id'));
            $('#prodInfoModal').modal("show");
            $("#prodInfo").html("<img src='img/loading.gif'>");
            var brandID = 0;
            var categoryID = 0;
            var productID = $(this).attr('id');
            prodID = productID;
            $.ajax({

                type: "GET",
                url: "api/getProdInfo.php",
                dataType: "json",
                data: {"productId": $(this).attr('id')},
                success: function(data,status) {
                    //console.log(data);
                    brandID = data.brandID;
                    categoryID = data.categoryID;
                    var prodDetails = "";
                    prodDetails += "<form>";
                    prodDetails += "<div class='form-group'>";
                    prodDetails += "<input id='" + productID + "' type='hidden' class='prodDetailsId'>";
                    prodDetails += "<img src='" + data.productImage + "' class='detailsImg'>";
                    prodDetails += "</div><div class='form-group'>";
                    prodDetails += "<label><strong>Description</strong></label>";
                    prodDetails += "<label class='form-control' cols='50' rows='4'>" + data.productDescription + "</label>";
                    prodDetails += "</div><div class='form-group'>";
                    prodDetails += "<label><strong>Price</strong></label>";
                    prodDetails += "<label class='form-control' >$" + data.price + "</label>";
                    prodDetails += "</div><div class='form-group'>";
                    prodDetails += "<label><strong>Category</strong></label>";    
                    prodDetails += "<label id='category' class='form-control' ></label>";
                    prodDetails += "</div><div class='form-group'>";
                    prodDetails += "<label><strong>Brand</strong></label>";
                    prodDetails += "<label id='brand' class='form-control'></label>";
                    prodDetails += "</div><div class='form-group'>";
                    prodDetails += "<label><strong>Comments</strong></label>";
                    prodDetails += "<label id='comments' class='form-control' cols='50' rows='4'></label>";
                    prodDetails += "</div></form>";
                    $("#prodInfo").html(prodDetails);
                    /*$("#prodInfo").html(<br >" + <img src='" + data.productImage + "' class='detailsImg'> +
                                            "<div class='dscBckgrnd'><strong>Description:</strong> " + data.productDescription + "<br>" +
                                            "<strong>Price:</strong> $" + data.price + "<br>" +
                                            "<strong>Rating:</strong> ****** stars</div>");      
                    */ 
                   $("#prodNameModalLabel").html("<h4>Product Details: "+data.productName+"</h4>");                   
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                    getBrand(brandID);
                    getCategory(categoryID);
                    getComments(productID);
                }
            });//ajax

        }); //.getLink click
        
        $(".addComment").click(function(){
            
            var comment = $("#newComment").val();
            //console.log(prodID);
            //console.log(comment);
            $.ajax({
                type: "GET",
                url: "api/setComment.php",
                data: {"productID": prodID, "comments": comment },
                success: function(data,status) {
                    //console.log(comment);
                },
                complete: function(data,status){
                    getComments(prodID);
                    $("#newComment").val("");
                }
            });//ajax 
        }); //#addComment click
        
        function getBrand(brandID){
            $.ajax({
            type: "GET",
            url: "api/getBrand.php",
            dataType: "json",
            data: {"brandID": brandID},
            success: function(data,status) {
                $("#brand").html(data.brandName);
            }
        });
        }
        function getCategory(categoryID){
         //get category
            $.ajax({
                type: "GET",
                url: "api/getCategory.php",
                dataType: "json",
                data: {"categoryID": categoryID},
                success: function(data,status) {
                    $("#category").html(data.categoryName);
                }
            });
        }
        function getComments(productID){
         //get category
            $.ajax({
                type: "GET",
                url: "api/getComments.php",
                dataType: "json",
                data: {"productID": productID},
                success: function(data,status) {
                    var comments = "";
                    if(data == false){
                        comments += "No comments yet! Be the first!";
                    }
                    else{
                        $.each(data, function(index, item){
                        comments +="<p>" + item.comments + "</p>";
                    });
                    }
                    
                    
                    $("#comments").html(comments);
                }
            });
        }
    });//document.ready
    
</script>  

<!--Modal Form-->
<div class="modal fade" id="prodInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prodNameModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="prodInfo"></div>
                <form>
                    <div class='form-group'>
                        <input id='newComment' class='form-control' type='text' placeholder='Add a Comment'>
                    </div><div class='form-group'>
                        <button type='button' class='btn btn-primary addComment'>Add Comment</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                    
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

