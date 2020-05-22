<?php
   session_start();

   if(isset($_SESSION['loggedin'])){
      if(!$_SESSION['loggedin']) {
         header('Location: login.php');
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Surgery List</title>
</head>
<body>
   Test
</body>
</html>