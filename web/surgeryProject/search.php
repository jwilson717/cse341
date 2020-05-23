<?php
   session_start();

   if(!isset($_SESSION['loggedin'])){
     header('Location: login.php');
   }

   if(isset($_POST['surgeryDate'])) {
      $surgeryDate = htmlspecialchars($_POST['surgeryDate']);
   } 

   if(isset($_POST['patientfname'])){
      $fname = htmlspecialchars($_POST['patientfname']);
   } else {
      $fname = ' ';
   }

   if (isset($_POST['patientlname'])) {
      $lname = htmlspecialchars($_POST['patientlname']);
   } else {
      $lname = ' ';
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
      <form action="search.php" method='post'>
         <label for="surgeryDate">Surgery Date: </label>
         <input type="text" id='surgeryDate' name='surgeryDate'><br>
         <label for="patientfname">First Name: </label>
         <input type="text" name="patientfname" id="patientfname"><br>
         <label for="patientlname">Last Name: </label>
         <input type="text" name="patientlname" id="patientlname"><br>
         <input type="submit" name="search" id="search" value='search'>

      </form>
      <?php 
         if(isset($surgeryDate)) {
            $stmt = $db->prepare('SELECT * FROM Surgery s JOIN Patient p on s.patient_id = p.record_num 
            WHERE s.surgery_date = ?  AND p.f_name like ? AND p.l_name like ?');
            $stmt->execute([$surgeryDate, "%$fname%", "%$lname%"]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row=>$r) {
               $id = $r['surgery_id'];
               echo "<a href='details.php?record=$id'><div class='border border-dark m-2 p-2 item'> <h2>" . $r['f_name'] . ' ' . $r['l_name'] . "</h2>";
               echo "<p class='ml-3'>" . $r['surgery_date'] . " " . $r['procedure'] . "</p></div></a>";
            }
         } else {
            $stmt = $db->prepare('SELECT * FROM Surgery s JOIN Patient p on s.patient_id = p.record_num 
            WHERE p.f_name like ? OR p.l_name like ?');
            $stmt->execute(["%$fname%", "%$lname%"]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row=>$r) {
               $id = $r['surgery_id'];
               echo "<a href='details.php?record=$id'><div class='border border-dark m-2 p-2 item'> <h2>" . $r['f_name'] . ' ' . $r['l_name'] . "</h2>";
               echo "<p class='ml-3'>" . $r['surgery_date'] . " " . $r['procedure'] . "</p></div></a>";
            }
         }
         
      ?>
   </main>
   <footer>
      <p>&copy; Jaden Wilson 2020 (CSE 341 BYUI)</p>
   </footer>
</body>
</html>