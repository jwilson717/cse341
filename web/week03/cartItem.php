<?php
    $cartItem = "<div class='cartItem'> 
    <h2 class='itemTitle'>$i</h2> 
    <img src='images/$f' alt='$i' width='150' height='150' class='cartImg'>";
    $counts = array_count_values($_SESSION['cart']);
    $q = $counts[$i];
    $cartItem .= "<div class='details'> <span class='quantity'>Quantity: $q</span>
    <button type='button' class='removeone'>Remove One </button> <button type='button' class='removeall'>Remove</button></div> </div>";
    echo $cartItem;
?>