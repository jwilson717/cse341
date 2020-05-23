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
   <title>Search</title>
   <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type='text/css' href='css/indexStyles.css'>
</head>
<body>
   <header>
      <h2 id='pagetitle'>Surgery Search</h2>
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
      <form>
         <label for="surgeryDate">Surgery Date: </label>
         <input type="text" id='surgeryDate' name='surgeryDate' require> <span class='hide' id='error1'>Surgery date is required</span><br>
         <label for="patientfname">First Name: </label>
         <input type="text" name="patientfname" id="patientfname"><br>
         <label for="patientlname">Last Name: </label>
         <input type="text" name="patientlname" id="patientlname"><br>
         <Button type="button" name="search" id="search" class='btn btn-secondary'>Search</button>
      </form>
      <div id='out'></div>
   </main>
   <footer>
      <p>&copy; Jaden Wilson 2020 (CSE 341 BYUI)</p>
   </footer>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src='functions.js'></script>
</body>
</html>