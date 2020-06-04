<?php
   session_start();
      
   if(!isset($_SESSION['loggedin'])){
   header('Location: login.php');
   die();
   }

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