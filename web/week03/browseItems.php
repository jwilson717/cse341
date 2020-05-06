<?php
   session_start();
   if(isset($_POST['item'])) {
      if(isset($_SESSION['cart'])) {
         array_push($_SESSION['cart'], $_POST['item']);
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
   <link rel='stylesheet' type='text/css' href='css/browseStyles.css'>
</head>
<body>
   <header>
      <h1>Wilsons Watches</h1>
   </header>
   <hr>
   <nav>
      <ul>
         <li><a href='browseItems.php'>Home</a></li>
         <li><a href='cart.php'>Cart</a></li>
      </ul>
   </nav>
   <main>
      <div id='itemscontainer'>
         <?php
            $watches = array('Analog Calendar'=>'analogCalendar.png', 'Digital'=>'digital.jpg', 'Modern Horizontal'=>'modernhorizontal.png', 'Roman Numeral'=>'romanNumeral', 'Tactical'=>'tactical.jpg', 'Wooden'=>'wood.jpg');
            foreach ($watches as $t=>$f) {
               $item = "<div class='item'> <img src='images/$f' alt='$t Watch' width='200' height='200' class='itemimg'>";
               $item .= "<button type='button' class='addCart' value='$t'> Add to Cart</button> </div>";
               echo $item;
            }
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