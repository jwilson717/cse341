<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
</head>
<body>
   <?php foreach ($_SESSION['cart'] as $i) {
      echo $i . '<br>';  
   }?>
</body>
</html>