<?php

function displayCartCount()
{
    echo count($_SESSION['cart']);
}

function displayCart()
{
    
    // NOTE TO SELF -- changes were done in mainPage $newItem['description'] = $_POST['itemDescription']; 
    // this will grab from post in prodSearch which is from the input type with name description hidden.
    // then below itemDescription = item[description]
    
    
   // print_r($_SESSION["cart"]); 
    $itemTotal = 0;
    
    if(!empty($_SESSION['cart']))
    {
        echo "<div id='searchResults'>";
        echo "<table class='table table-hover'>";
        echo "<thead class='thead-light'>";
        echo "<tr>";
        echo "<th scope='col'></th>";
        echo "<th scope='col'>Product Name</th>";
        echo "<th scope='col'>Price</th>";
        echo "<th scope='col'>Qty</th>";
        echo "<th scope='col'></th>";
        echo "<th scope='col'></th>";
        echo "</tr>";
        echo "</thead>";
        
        foreach ($_SESSION['cart'] as $item)
        {
            $itemName = $item['name'];
            $itemPrice = number_format($item['price'],2);
            $itemImage = $item['image'];
            $itemId= $item['id'];
            $itemQuant = $item['quantity'];
            $itemDescription = $item['description'];
            
            echo "<tr>";
            // echo "<td><img width='100px' height='50px' src='$itemImage'></td>";
            echo "<td><div id='mpRowImgDiv'><img id='mpRowImg' src='$itemImage'></div></td>";
            // echo '<td><h4>' . $itemName . " " . $itemDescription .  ' </h4></td>';
            echo "<td><strong>" . $itemName . "</strong><br>" . $itemDescription."</td>"; 
            //echo "<td><h4>$itemDescription</h4></td>";
            echo "<td>$$itemPrice</td>";
           //echo "<td><h4>$itemQuant</h4></td>";
            
            echo '<form method="post">';
            echo "<input type='hidden' name='itemId' value='$itemId'>";
            echo "<td id='quantNum'><input type='text' maxlength='3' size='3' name='update' class='form-control' placeHolder='$itemQuant'></td>";
            echo '<td><button class="btn btn-warning">Update</button></td>';
            echo "</form>";
            
            echo '<form method="post">';
            echo "<input type='hidden' name='removeId' value='$itemId'>";
            echo "<td><button class='btn btn-danger'>Remove</button></td>";
            echo "</form>";
            
            $itemTotal += floatval($itemPrice) * floatval($itemQuant);
            
            
        }
        // Format Money
        $itemTotal = number_format($itemTotal, 2);
        
        echo "</tr>";
            echo "<tr>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo '<td><strong> Total: $' . $itemTotal . '</strong></td>';
            echo "</tr>";
        echo "</table>";
        echo "</div>";
    }
    else
    {
        echo "Your cart is empty";
    }
}

?>
