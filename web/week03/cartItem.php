<?php
    $cartItem = "<div class='cartItem'> 
    <h2 class='itemTitle'>$i Watch</h2> 
    <img src='images/$f' alt='$i' width='150' height='150' class='cartImg'>";
    $counts = array_count_values($_SESSION['cart']);
    $q = $counts[$i];
    $price = $_SESSION['prices'][$i] * $q;
    $_SESSION['total'] += $price;
    $cartItem .= "<div class='details'> <span class='quantity'>Quantity: $q</span>
    <button type='button' class='removeone' value='$i'>Remove One </button> <button type='button' class='removeall' value='$i'>Remove</button><br>
    <span id='price'>Price: $$price</span></div> </div>";
    echo $cartItem;
?>