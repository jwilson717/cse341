<?php
   session_start();
   $_SESSION['cart'] = 'test';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
</head>
<body>
   <header>
      <h1>Wilsons Watches</h1>
   </header>
   <hr>
   <nav>
      <ul>
         <li><a href='browseItems.php'>Home</a></li>
      </ul>
   </nav>
   <main>
      <div id='itemscontainer'>
         <div>
            <button type='button' onclick='addToCart()'>Add</button>
         </div>
      </div>
   </main>
   <footer>
      <p> &copy; Jaden Wilson 2020 (CSE 341, BYUI)
   </footer>
</body>
<script src='functions.js'></script>
</html>