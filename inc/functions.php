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
    echo '<br>';
    $itemTotal = 0;
    
    if(!empty($_SESSION['cart']))
    {
        
        echo "<table id='displayCartTable'>";
        echo "<tr>";
        echo "<td></td>";
        echo "<td>Description</td>";
        echo "<td>Price</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        
        foreach ($_SESSION['cart'] as $item)
        {
            $itemName = $item['name'];
            
            
            $itemPrice = $item['price'];
            //Format price
            $itemPriceFormatted = number_format($itemPrice, 2);
            
            $itemImage = $item['image'];
            $itemId= $item['id'];
            $itemQuant = $item['quantity'];
            $itemDescription = $item['description'];
            
           
            
            echo "<tr id='product'>";
            echo "<td><img width='200px' height='200px' src='$itemImage'></td>";
            echo '<td><h4>' . $itemName . " " . $itemDescription .  ' </h4></td>';
            //echo "<td><h4>$itemDescription</h4></td>";
            echo "<td><h4>  $$itemPriceFormatted</h4></td>";
           //echo "<td><h4>$itemQuant</h4></td>";
            
            echo '<form method="post">';
            echo "<input type='hidden' name='itemId' value='$itemId'>";
            echo "<td id='quantNum'><input type='text' maxlength='3' size='3' name='update' class='form-control' placeHolder='$itemQuant'></td>";
            echo '<td><button class="btn btn-danger">Update</button></td>';
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
            echo '<td> Total: $' . $itemTotal . '</td>';
            echo "</tr>";
        echo "</table>";
    }
    else
    {
        echo "Your cart is empty";
    }
}

?>
