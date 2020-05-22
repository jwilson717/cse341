<?php
   session_start();

   if(!isset($_SESSION['loggedin'])){
     header('Location: login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Surgery List</title>
   <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
</head>
<body>
   <h2 class='col-10'>Surgery List</h2>
</body>
</html>