<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>
</head>
<body>
   <?php foreach ($_SESSION['cart'] as $i) {
      echo $i;  
   }?>
</body>
</html>