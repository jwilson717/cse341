<?php
   session_start();

   if(!isset($_SESSION['loggedin'])){
      $_SESSION['returnpage'] = 'index.php';
      header('Location: login.php');
      die();
   }

   require('dbconnect.php');
   $db = getDb();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Surgery List</title>
   <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
   <link rel='stylesheet' type='text/css' href='css/styles.css'>
   <link rel='stylesheet' type='text/css' href='css/indexStyles.css'>
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
      <?php 
         $stmt = $db->query('SELECT * FROM Surgery s JOIN Patient p on s.patient_id = p.record_num ORDER BY s.surgery_date');
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
         foreach ($rows as $row=>$r) {
            $id = $r['surgery_id'];
            echo "<a href='details.php?record=$id'><div class='border border-dark m-2 p-2 item'> <h2>" . $r['f_name'] . ' ' . $r['l_name'] . "</h2>";
            echo "<p class='ml-3'>" . $r['surgery_date'] . " " . $r['procedure'] . "</p></div></a>";
         }
      ?>
   </main>
   <footer>
      <p>&copy; Jaden Wilson 2020 (CSE 341 BYUI)</p>
   </footer>
</body>
</html>