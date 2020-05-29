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
         <form action="data.php" method='post' id='surgeryData' class='row justify-content-center'>
            <div class='col-6'>
               <input type="checkbox" id='surgerycheck' name='surgerycheck' value='New Surgery'>
               <label for="surgerycheck">New Surgery</label><br class='surg hide'>
               <label for="f_name" class='surg hide'>Patient First Name: </label>
               <input type="text" name='f_name' id='f_name' class='surg hide req'><br class='surg hide'>
               <label for="l_name" class='surg hide'>Patient Last Name: </label>
               <input type="text" name='l_name' id='l_name' class='surg hide req'><br class='surg hide'>
               <label for="age" class='surg hide'>Age: </label>
               <input type="text" name="age" id="age" class='surg hide req'><br class='surg hide'>
               <label for="sdate" class='surg hide'>Surgery Date: </label>
               <input type="text" name="sdate" id="sdate" class='surg hide req'><br class='surg hide'>
               <label for="procedure" class='surg hide'>Procedure: </label>
               <input type="text" name="procedure" id="procedure" class='surg hide req'><br class='surg hide'>
               <label for="duration" class='surg hide'>Procedure Duration: </label>
               <input type="text" name="duration" id="duration" class='surg hide'><br class='surg hide'>
               <label for="bloodloss" class='surg hide'>Blood Loss: </label>
               <input type="text" name="bloodloss" id="bloodloss" class='surg hide'><br class='surg hide'>
               <label for="sweight" class='surg hide'>Specimen Weight: </label>
               <input type="text" name="sweight" id="sweight" class='surg hide'><br class='surg hide'>
               <label for="notes" class='surg hide'>Surgery Notes: </label>
               <input type="text" name="notes" id="notes" class='surg hide'><br class='surg hide'>
               <label class='surg hide'>Pathologies: </label><br class='surg hide'>
               <?php
                  $stmt = $db->prepare('SELECT * FROM pathology');
                  $stmt->execute();
                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($rows as $row=>$r) {
                     $p = $r['pathology'];
                     $id = $r['pathology_id'];
                     echo "<input type='checkbox' name='pathologies[]' value='$id' class='surg hide'><label class='surg hide'>$p</label><br class='surg hide'>";
                  }
               ?>
            </div>
            <div class='col-6'>
               <input type="checkbox" id='patientcheck' name='patientcheck' value='New Patient'>     
               <label for="patientcheck">New Patient</label><br class='pat hide'>
               <label for="recordnum" class='pat hide'>Record Numer: </label>
               <input type="text" name="recordnum" id="recordnum" class='pat hide preq'><br class='pat hide'>
               <label for="pf_name" class='pat hide'>Patient First Name: </label>
               <input type="text" name="pf_name" id="pf_name" class='pat hide preq'><br class='pat hide'>
               <label for="pl_name" class='pat hide'>Patient Last Name</label>
               <input type="text" name="pl_name" id="pl_name" class='pat hide preq'><br class='pat hide'>
               <label for="dob" class='pat hide'>Date of Birth: </label>
               <input type="text" name="dob" id="dob" class='pat hide preq'> <br class='pat hide'>
               <label for='insurance' class='pat hide'>Insurance: </label>
               <select name="insurance" id="insurance" class='pat hide'>
                  <option value='na'>--SELECT--</option>
               <?php
                  $stmt = $db->prepare('SELECT * FROM insurance');
                  $stmt->execute();
                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($rows as $row=>$r) {
                     $p = $r['name'];
                     $id = $r['id'];
                     echo "<option value='$id'>$p</option>";
                  }
               ?>
               </select>
            </div>
            <input type="submit" value='insert' id='insert' class='hide'>
         </form>
      </div>
   </main>
   <footer>
      <p>&copy; Jaden Wilson 2020 (CSE 341 BYUI)</p>
   </footer>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src='functions.js'></script>
</body>
</html>