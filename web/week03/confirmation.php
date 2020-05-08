<?php
   session_start();

   if (isset($_POST['streeta']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip'])) {
      $sucess = "Your order was placed successfully!";
   } else {
      $success = 'Your order could not be placed at this time.';
   }

   if (isset($_POST['streeta'])){
      $street = htmlspecialchars($_POST['streeta']);
   } else {
      $street = '';
   }

   if (isset($_POST['city'])){
      $city = htmlspecialchars($_POST['city']);
   } else {
      $city = '';
   }

   if (isset($_POST['state'])){
      $state = htmlspecialchars($_POST['state']);
   } else {
      $state = '';
   }

   if (isset($_POST['zip'])){
      $state = htmlspecialchars($_POST['zip']);
   } else {
      $state = '';
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type="text/css" href='css/confirmationStyles.css'>
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
   <div id='items'>
   <h2 id='itemsTitle'>Your Items</h2>
      <?php
         if (isset($success)){
            echo "<h2 id='orderPlaced'>$success</h2>";
         }
         foreach ($_SESSION['watches'] as $i=>$f) {
            if (array_search($i, $_SESSION['cart'], true)) {
               $counts = array_count_values($_SESSION['cart']);
               $q = $counts[$i];
               echo "<p>$i watch: $q</p>";
            }
         }
         echo "<h2> Shipping Address</h2>";
         echo "<p>$street</p>";
         echo "<p>$city, $state $zip</p>";
      ?>
    </div>
   </main>
   <footer>
      <p> &copy; Jaden Wilson 2020 (CSE 341, BYUI)
   </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='functions.js'></script>
</html>