<?php
   session_start();
      
   if(!isset($_SESSION['loggedin'])){
   header('Location: login.php');
   die();
   }

   // $db = null;
   // try
   //    {
   //    $dbUrl = getenv('DATABASE_URL');
      
   //    $dbOpts = parse_url($dbUrl);
      
   //    $dbHost = $dbOpts["host"];
   //    $dbPort = $dbOpts["port"];
   //    $dbUser = $dbOpts["user"];
   //    $dbPassword = $dbOpts["pass"];
   //    $dbName = ltrim($dbOpts["path"],'/');
      
   //    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
      
   //    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   //    }
   //    catch (PDOException $ex)
   //    {
   //    echo 'Error!: ' . $ex->getMessage();
   //    die();
   //    }

   require('dbconnect.php');
   $db = getDb();
   
   if (isset($_POST['newnotes'])) {
      try {
         $note = htmlspecialchars($_POST['newnotes']);
         $id = $_POST['record'];
         $up = $db->prepare("UPDATE surgery SET notes = NULLIF('$note', '') WHERE surgery_id = $id");
         $up->execute();
         
         echo "<p>Note successfully updated.";
      } catch (Exception $e) {
         echo "<p class='error'>Error updating note</p>";
      }

      
   }
?>