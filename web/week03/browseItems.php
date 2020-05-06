<?php
   session_start();
   if(isset($_POST['item'])) {
      if(isset($_SESSION['cart'])) {
         $_SESSION['cart'].array_push($_POST['item']);
      } else {
         $_SESSION['cart'] = array($_POST['item']);
      }
   }

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
            <button type='button' class='addCart' value='Watch1'>Add</button>
         </div>
         <?php echo $_SESSION['cart'];?>
      </div>
   </main>
   <footer>
      <p> &copy; Jaden Wilson 2020 (CSE 341, BYUI)
   </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='functions.js'></script>
</html>