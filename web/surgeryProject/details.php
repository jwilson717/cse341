<?php
   session_start();

   if(!isset($_SESSION['loggedin'])){
     header('Location: login.php');
   }

   if (isset($_GET['record'])) {
      $record = $_GET['record'];
   } else {
      $record = '';
   }

   // $db = null;
   // try
   //    {
   //      $dbUrl = getenv('DATABASE_URL');
      
   //      $dbOpts = parse_url($dbUrl);
      
   //      $dbHost = $dbOpts["host"];
   //      $dbPort = $dbOpts["port"];
   //      $dbUser = $dbOpts["user"];
   //      $dbPassword = $dbOpts["pass"];
   //      $dbName = ltrim($dbOpts["path"],'/');
      
   //      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
      
   //      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   //    }
   //    catch (PDOException $ex)
   //    {
   //      echo 'Error!: ' . $ex->getMessage();
   //      die();
   //    }

   require('dbconnect.php');
   $db = getDb();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Entry</title>
   <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type='text/css' href='css/detailStyles.css'>
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
      <h2>Surgery Details</h2>
      <?php
         $stmt = $db->prepare('SELECT * FROM Surgery s JOIN Patient p ON s.patient_id = p.record_num JOIN Insurance i on p.insurance_id = i.insurance_id LEFT JOIN Pathology_connect pc ON s.surgery_id = pc.surgery_id LEFT JOIN pathology pa ON pc.pathology_id = pa.pathology_id WHERE s.surgery_id = ?');
         $stmt->execute([$record]);
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
         
         $r = $rows[0];
         echo "<p class='hide' id='record'>$record</p>";
         echo "<p>Procedure: " . $r['procedure'] . "</p>";
         echo "<p>Surgery Date: " . $r['surgery_date'] . "</p>";
         echo "<p>Procedure Duration: " . $r['procedure_duration'] . "</p>";
         echo "<p>Blood Loss: " . $r['blood_loss'] . "</p>";
         echo "<p>Specimen Weight: " . $r['specimen_weight'] . "</p>";
         echo "<p>Pathology:</p>";
         foreach ($rows as $row=>$p) {
            echo "<p class='path'>" . $p['pathology'] . "</p>";
         }
         echo "Notes: <textarea name='newnotes' id='newnotes'>" . $r['notes'] . "</textarea><br>";
         echo "<button class='btn btn-secondary' id='updatenote'>Update</button>";
         echo "<div id='res'></div>";
         echo "<h2>Patient Info</h2>";
         echo "<p>Name: " . $r['f_name'] . " " . $r['l_name'] .  "</p>";
         echo "<p>Record Number: " . $r['record_num'] . "</p>";
         echo "<p>Age: " . $r['age'] . "</p>";
         echo "<p>DOB: " . $r['dob'] . "</p>";
         echo "<p>Insurance: " . $r['name'] . "</p>";
      ?>
   </main>
   <footer>
      <p>&copy; Jaden Wilson 2020 (CSE 341 BYUI)</p>
   </footer>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src='functions.js'></script>
</body>
</html>