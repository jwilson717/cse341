<?php
   session_start();
   $items = $_SESSION['watches'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type='text/css' href='css/cartStyles.css'>
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
      <?php 
         if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 1) {
            echo "<h2 id='empty'>Your Cart is Empty</h2>";
         } else {
            foreach ($items as $i=>$f) {
               if (array_search($i, $_SESSION['cart'], true)) {
                  include 'cartItem.php';
               }
            } 
            $total = $_SESSION['total'];
            echo "<div id='total'> <h3>Total: $total</h3></div>";
            echo "<div id='checkoutb'><button type='button' id='checkout' onclick=" . "window.location.href='checkout.php';" . ">Checkout</button></div>";
         }
         echo "<button type='button' id='continue' onclick=" . "window.location.href='browseItems.php';" . ">Continue Shopping</button>";
      ?>
   </main>
   <footer>
      <p> &copy; Jaden Wilson 2020 (CSE 341, BYUI)
   </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='functions.js'></script>
</body>
</html>