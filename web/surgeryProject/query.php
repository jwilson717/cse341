<?php
   session_start();
   
   if(!isset($_SESSION['loggedin'])){
   header('Location: login.php');
   die();
   }
   
   if(isset($_POST['surgeryDate'])) {
      $surgeryDate = htmlspecialchars($_POST['surgeryDate']);
   } else {
      $surgeryDate = '0000-00-00';
   }
   
   if(isset($_POST['patientfname'])){
      $fname = '%' . htmlspecialchars($_POST['patientfname']) . '%';
   } else {
      $fname = '% %';
   }
   
   if (isset($_POST['patientlname'])) {
      $lname = '%' . htmlspecialchars($_POST['patientlname']) . '%';
   } else {
      $lname = '% %';
   }

   require('dbconnect.php');
   $db = getDb();

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