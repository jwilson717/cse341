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
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
</head>
<body>
   <header>
      <h2 id='pagetitle'>Surgery List</h2>
   </header>
   <hr>
   <nav>
      <ul>
         <li><a href="index.php">List</a></li>
         <li><a href="search.php">Search</a></li>
         <li><a href="insert.php">Data Entry</a></li>
      </ul>
   </nav>
   <main>
      
   </main>
</body>
</html>