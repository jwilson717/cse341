<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type='text/css' href='css/checkoutStyles.css'>
</head>
<body>
   <header>
      <h1 id='siteTitle'>Wilsons Watches</h1>
   </header>
   <hr>
   <nav>
      <ul>
         <li><a href='browseItems.php'>Home</a></li>
         <li><a href='cart.php'>Cart</a></li>
      </ul>
   </nav>
   <main>
     <h2>Checkout</h2>
     <form id='checkoutForm' action="confirmation.php" method='post'>
     <label for="streeta">Street Address: </label>
     <input type="text" id='streeta' name='streeta' required><br>
     <label for="city">City: </label>
     <input type="text" id='city' name='city' required><br>
      <label for="state">State: </label>
      <input type="text" id='state' name='state' required><br>
      <label for="zip">Zip: </label>
      <input type="text" id='zip' name='zip' required><br>
      <button type='button' onclick="window.location.href='cart.php';">Return to Cart</button>
      <input type="submit" value='Place Order' id='placeorder'>
     </form>
   </main>
   <footer>
      <p> &copy; Jaden Wilson 2020 (CSE 341, BYUI)
   </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='checkout.js'></script>
</html>