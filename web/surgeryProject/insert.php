<?php
   session_start();

   if(!isset($_SESSION['loggedin'])){
      $_SESSION['returnpage'] = 'insert.php';
      header('Location: login.php');
      die();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Entry</title>
   <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type='text/css' href='css/insertStyles.css'>
</head>
<body>
   <header>
      <h2 id='pagetitle'>Surgery Data Entry</h2>
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
      <div class='container container-fluid'>
         <div class='row'>
            <div class='col-6'>
               <input type="checkbox" id='surgery'>
               <form action="data.php" method='post' id='surgeryData' class='hide'>
                  test
               </form>
            </div>
            <div class='col-6'>
               <input type="checkbox" id='patient'>     
               <form action="data.php" action='post' id='patientData' class='hide'>
               test
               </form>
            </div>
         </div>
      </div>
   </main>
   <footer>
      <p>&copy; Jaden Wilson 2020 (CSE 341 BYUI)</p>
   </footer>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src='functions.js'></script>
</body>
</html>