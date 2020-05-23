<?php
   session_start();
   echo 'Test 1';
   if(!isset($_SESSION['loggedin'])){
   header('Location: login.php');
   }
   echo 'Test 2';
   if(isset($_POST['surgeryDate'])) {
      $surgeryDate = htmlspecialchars($_POST['surgeryDate']);
   } else {
      $surgeryDate = '0000-00-00';
   }
   echo 'Test 3';
   if(isset($_POST['patientfname'])){
      $fname = '%' . htmlspecialchars($_POST['patientfname']) . '%';
   } else {
      $fname = '% %';
   }
   echo 'Test 4';
   if (isset($_POST['patientlname'])) {
      $lname = '%' . htmlspecialchars($_POST['patientlname']) . '%';
   } else {
      $lname = '% %';
   }
   echo 'Test 5';
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
      echo "Test 6";
      if($surgeryDate != '0000-00-00') {
         $stmt = $db->prepare('SELECT * FROM Surgery s JOIN Patient p on s.patient_id = p.record_num 
         WHERE s.surgery_date = ?  AND p.f_name like ? AND p.l_name like ?');
         $stmt->execute([$surgeryDate, $fname, $lname]);
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
         foreach ($rows as $row=>$r) {
            $id = $r['surgery_id'];
            echo "<a href='details.php?record=$id'><div class='border border-dark m-2 p-2 item'> <h2>" . $r['f_name'] . ' ' . $r['l_name'] . "</h2>";
            echo "<p class='ml-3'>" . $r['surgery_date'] . " " . $r['procedure'] . "</p></div></a>";
         }
      } 
?>