<?php
   session_start();
   $_SESSION['watches'] = array('Analog Calendar'=>'analogCalendar.png', 'Digital'=>'digital.jpg', 'Modern Horizontal'=>'modernhorizontal.png', 'Roman Numeral'=>'romanNumeral.jpg', 'Tactical'=>'tactical.jpg', 'Wooden'=>'wood.jpg');
   $_SESSION['prices'] = array('Analog Calendar'=>19.99, 'Digital'=>14.99, 'Modern Horizontal'=>19.99, 'Roman Numeral'=>19.99, 'Tactical'=>14.99, 'Wooden'=>12.99);
   if(isset($_POST['item'])) {
      if(isset($_SESSION['cart'])) {
         array_push($_SESSION['cart'], $_POST['item']);
      } else {
         $_SESSION['cart'] = array(' ', $_POST['item']);
      }
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type='text/css' href='css/browseStyles.css'>
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
      <div id='itemscontainer'>
         <?php
            $watches = $_SESSION['watches'];
            foreach ($watches as $t=>$f) {
               $price = $_SESSION['prices'][$t];
               $item = "<div class='item'> <img src='images/$f' alt='$t Watch' width='250' height='250' class='itemimg'>";
               $item .= "<h2>$t</h2>";
               $item .= "<h3>$$price<h3>";
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