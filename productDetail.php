<!--AJAX Modal From-->

<script>
    $(document).ready( function(){
        
        $(".prodDetails").click( function(){
            
            //alert($(this).attr('id'));
            $('#prodInfoModal').modal("show");
            $("#prodInfo").html("<img src='img/loading.gif'>");
          
            $.ajax({

                type: "GET",
                url: "api/getProdInfo.php",
                dataType: "json",
                data: {"productId": $(this).attr('id')},
                success: function(data,status) {
                  
                $("#prodInfo").html(" <img src='" + data.productImage + "' class='detailsImg'><br >" + 
                                        "<div class='dscBckgrnd'><strong>Description:</strong> " + data.productDescription + "<br>" +
                                        "<strong>Price:</strong> $" + data.price + "<br>" +
                                        "<strong>Rating:</strong> ****** stars</div>");      
                 
                   $("#prodNameModalLabel").html("<h4>"+data.productName+"</h4>");                   
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
            });//ajax
        }); //.getLink click
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
