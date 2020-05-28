<?php
   session_start();

   if(!isset($_SESSION['loggedin'])){
      $_SESSION['returnpage'] = 'insert.php';
      header('Location: login.php');
      die();
   }

   $db = null;
   try
      {
      $dbUrl = getenv('DATABASE_URL');
      
      $dbOpts = parse_url($dbUrl);
      
      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');
      
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
      
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $ex)
      {
      echo 'Error!: ' . $ex->getMessage();
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
               <input type="checkbox" id='surgerycheck' value='New Surgery'>
               <form action="data.php" method='post' id='surgeryData' class='hide'>
                  <label for="f_name">Patient First Name: </label>
                  <input type="text" name='f_name' id='f_name'><br>
                  <label for="l_name">Patient Last Name: </label>
                  <input type="text" name='l_name' id='l_name'><br>
                  <label for="age">Age: </label>
                  <input type="text" name="age" id="age"><br>
                  <label for="sdate">Surgery Date: </label>
                  <input type="text" name="sdate" id="sdate"><br>
                  <label for="procedure">Procedure: </label>
                  <input type="text" name="procedure" id="procedure"><br>
                  <label for="duration">Procedure Duration: </label>
                  <input type="text" name="duration" id="duration"><br>
                  <label for="bloodloss">Blood Loss: </label>
                  <input type="text" name="bloodloss" id="bloodloss"><br>
                  <label for="sweight">Specimen Weight: </label>
                  <input type="text" name="sweight" id="sweight"><br>
                  <label for="notes">Surgery Notes: </label>
                  <input type="text" name="notes" id="notes"><br>
                  <label>Pathologies: </label>
                  <?php
                     $stmt = $db->prepare('SELECT * FROM pathology');
                     $stmt->execute();
                     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                     foreach ($rows as $row=>$r) {
                        $p = $r['pathology'];
                        $id = $r['id'];
                        echo "<input type='checkbox' name='pathologies[]' value='$id'>$p<br>";
                     }
                  ?>
               </form>
            </div>
            <div class='col-6'>
               <input type="checkbox" id='patientcheck' value='New Patient'>     
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