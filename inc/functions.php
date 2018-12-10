<?php

function displayCartCount()
{
    echo count($_SESSION['cart']);
}

function resetCart()
{
    unset($_SESSION['cart']);
    //echo count($_SESSION['cart']);
}

function displayCart()
{
    
    // NOTE TO SELF -- changes were done in mainPage $newItem['description'] = $_POST['itemDescription']; 
    // this will grab from post in prodSearch which is from the input type with name description hidden.
    // then below itemDescription = item[description]
    
    
    //print_r($_SESSION["cart"]); 
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
            $itemPrice = floatval($item['price']);
            $itemImage = $item['image'];
            $itemId= $item['id'];
            $itemQuant = $item['quantity'];
            $itemDescription = $item['description'];
            $itemTotal += floatval($itemPrice) * floatval($itemQuant);
            
            echo "<tr>";
            // echo "<td><img width='100px' height='50px' src='$itemImage'></td>";
            echo "<td><div id='mpRowImgDiv'><img id='mpRowImg' src='$itemImage'></div></td>";
            // echo '<td><h4>' . $itemName . " " . $itemDescription .  ' </h4></td>';
            echo "<td><strong>" . $itemName . "</strong><br>" . $itemDescription."</td>"; 
            //echo "<td><h4>$itemDescription</h4></td>";
            $itemPrice = number_format(floatval($itemPrice),2);
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
            
            //$itemTotal += floatval($itemPrice) * floatval($itemQuant);
            
            
        }
        // Format Money
        $itemTotal = number_format(floatval($itemTotal), 2);
        
        echo "</tr>";
            echo "<tr>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo '<td><strong> Total: $' . $itemTotal . '</strong> <br>';
            echo '<a class="btn btn-primary" href="checkout.php" role="button">Check Out</a></td>';
            echo "</tr>";
        echo "</table>";
        echo "</div>";
    }
    else
    {
        echo "Your cart is empty";
    }
}


function shipCharges($cartTotal)
{
    // if total is 5k and below, $200 ship charge
    // if total > 5k and < 10k $500 
    // if total > 10k congrats free shipping
    
    if ($cartTotal < 5000)
    {
        return 200;
    }
    else if ($cartTotal < 10000 and $cartTotal > 5000)
    {
        return 500;
    }
    else
    {
        return 0;
    }
    
}


function displaySummary()
{
    
    // NOTE TO SELF -- changes were done in mainPage $newItem['description'] = $_POST['itemDescription']; 
    // this will grab from post in prodSearch which is from the input type with name description hidden.
    // then below itemDescription = item[description]
    
    
    //print_r($_SESSION["cart"]); 
    echo '<a class="btn btn-primary" href="scart.php" role="button">Edit</a>';
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
            $itemPrice = floatval($item['price']);
            $itemImage = $item['image'];
            $itemId= $item['id'];
            $itemQuant = $item['quantity'];
            $itemDescription = $item['description'];
            $itemTotal += floatval($itemPrice) * floatval($itemQuant);
            $subTotal = number_format($itemTotal,2);
            
            echo "<tr>";
            // echo "<td><img width='100px' height='50px' src='$itemImage'></td>";
            echo "<td><div id='mpRowImgDiv'><img id='mpRowImg' src='$itemImage'></div></td>";
            // echo '<td><h4>' . $itemName . " " . $itemDescription .  ' </h4></td>';
            echo "<td><strong>" . $itemName . "</strong><br>" . $itemDescription."</td>"; 
            //echo "<td><h4>$itemDescription</h4></td>";
            echo "<td><h4>$itemQuant</h4></td>";
            $itemPrice = number_format(floatval($itemPrice),2);
            echo "<td>$$itemPrice</td>";
           
           
            echo "<td></td>";
            echo "<td></td>";
            
          
            
        }
        // Format Money
        $shippingCharge = shipCharges($itemTotal);
        
        
        $tax = ($itemTotal * .0925);
        $displayTax = number_format($tax,2);
        
        
        //echo ' <h2> from total ' . $itemTotal . '</h2><br>';
        //echo ' <h2> from tax ' . $tax . '</h2><br>';
        
        $newTotal = $itemTotal + $tax;
        //echo ' <h2> new total ' . $newTotal . '</h2><br>';
        
        
        
        if ($shippingCharge == 0)
        {
            $shippingCharge = 'Free Shipping';
            $itemTotal = $itemTotal + $tax;
            $itemTotal = number_format(floatval($itemTotal), 2);
          
        }
        else
        {
            $shippingCharge = number_format(floatval($shippingCharge), 2);
            $itemTotal = $itemTotal + $shippingCharge + $tax;
            $itemTotal = number_format(floatval($itemTotal), 2);
        
        }
        
        
        echo "</tr>";
            echo "<tr>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            
            echo '<td>';
            echo 'Sub Total: ' . $subTotal . '<br>';
            echo 'Shipping Charge: ' . $shippingCharge . '<br>';
            echo 'Taxes: ' . $displayTax . '<br>';
            echo '<strong> Total: $' . $itemTotal . '</strong> <br>';
            echo '<a class="btn btn-primary" href="ordercomplete.php" role="button">Buy</a>';
            echo '</td>';
            
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
