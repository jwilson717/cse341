<?php
session_start();
   
   if(!isset($_SESSION['loggedin'])){
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

   if(isset($_POST['surgerycheck'])) {
      $insertsurgery = true;
   } else {
      $insertsurgery = false;
   }

   if (isset($_POST['patientcheck'])) {
      $insertpatient = true;
   } else {
      $insertpatient = false;
   }

   if (isset($_POST['f_name'])) {
      $fname = htmlspecialchars($_POST['f_name']);
   }

   if (isset($_POST['l_name'])) {
      $lname = htmlspecialchars($_POST['l_name']);
   }

   if(isset($_POST['age'])){
      $age = htmlspecialchars($_POST['age']);
   }

   if (isset($_POST['sdate'])) {
      $sdate = htmlspecialchars($_POST['sdate']);
   }

   if(isset($_POST['procedure'])) {
      $procedure = htmlspecialchars($_POST['procedure']);
   }

   if (isset($_POST['duration'])) {
      $duration = htmlspecialchars($_POST['duration']);
   } else {
      $duration = -1;
   }

   if ($duration == '') {
      $duration = -1;
   }

   if (isset($_POST['bloodloss'])) {
      $bloodloss = htmlspecialchars($_POST['bloodloss']);
   } else {
      $bloodloss = -1;
   }

   if($bloodloss == '') {
      $bloodloss = -1;
   }
   
   if (isset($_POST['sweight'])) {
      $sweight = htmlspecialchars($_POST['sweight']);
   } else {
      $sweight = -1;
   }

   if ($sweight == '') {
      $sweight = -1;
   }

   if(isset($_POST['notes'])) {
      $notes = htmlspecialchars($_POST['notes']);
   } else {
      $notes = 'null';
   }

      if(isset($_POST['pathologies'])) {
         $pathologies = $_POST['pathologies'];
      } else {
         $pathologies = [];
      }

      if (isset($_POST['recordnum'])) {
         $recordnum = htmlspecialchars($_POST['recordnum']);
      }

      if (isset($_POST['pf_name'])) {
         $pf_name = htmlspecialchars($_POST['pf_name']);
      }

      if (isset($_POST['pl_name'])) {
         $pl_name = htmlspecialchars($_POST['pl_name']);
      }

      if (isset($_POST['dob'])) {
         $dob = htmlspecialchars($_POST['dob']);
      }

      if(isset($_POST['insurance'])) {
         $insurance = $_POST['insurance'];
      }

      if($insertpatient) {
         $stmt = $db->prepare("INSERT INTO patient (record_num, f_name, l_name, dob, insurance_id) VALUES ($recordnum, '$pf_name', '$pl_name', '$dob', NULLIF($insurance, -1))");
         $stmt->execute();
         $message = 'Insert Successfully Completed.';
      }

      if($insertsurgery) {
         $q = $db->prepare("SELECT * FROM patient WHERE f_name = '$fname' AND l_name = '$lname'");
         $q->execute();
         $rows = $q->fetchAll(PDO::FETCH_ASSOC);
   
         if (count($rows) > 0) {
            $stmt = $db->prepare("INSERT INTO surgery (patient_id, age, surgery_date, procedure, procedure_duration, blood_loss, specimen_weight, notes) VALUES ((SELECT record_num FROM patient WHERE f_name = '$fname' AND l_name = '$lname'), $age, '$sdate', '$procedure', NULLIF($duration, -1), NULLIF($bloodloss, -1), NULLIF($sweight, -1), NULLIF('$notes', 'null'))");
            $stmt->execute();
            $sid = $db->lastInsertId('surgery_surgery_id_seq');

            foreach ($pathologies as $path=>$p) {
               $con = $db->prepare("INSERT INTO pathology_connect (surgery_id, pathology_id) VALUES ($sid, $p)");
               $con->execute();
            }

            $message = 'Insert Successfully Completed.';
         } else {
            $error = "Incorrect Patient Data.";
         }
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
      <?php 
         if(isset($error)) {
            echo $error;
         } else {
            echo $message . "<br>";
            echo "<a href='insert.php'> Return to insert page</a>";
         }
      ?>
   </main>
   <footer>
      <p>&copy; Jaden Wilson 2020 (CSE 341 BYUI)</p>
   </footer>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src='functions.js'></script>
</body>
</html>