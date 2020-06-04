<?php
   session_start();
   
   if(!isset($_SESSION['loggedin'])){
   header('Location: login.php');
   die();
   }
   
   if(isset($_POST['surgeryDate'])) {
      if ($_POST['surgeryDate'] == '') {
         $surgeryDate = '0000-00-00';
      } else {
         $surgeryDate = htmlspecialchars($_POST['surgeryDate']);
      }
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

      // if($surgeryDate != '0000-00-00') {
      //    $stmt = $db->prepare('SELECT * FROM Surgery s JOIN Patient p on s.patient_id = p.record_num 
      //    WHERE s.surgery_date = ?  AND p.f_name like ? AND p.l_name like ?');
      //    $stmt->execute([$surgeryDate, $fname, $lname]);
      //    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      if ($surgeryDate = '0000-00-00') {
         $stmt = $db->prepare("SELECT * FROM surgery s JOIN patient p on s.patient_id = p.record_num WHERE p.f_name like '$fname' AND p.l_name like '$lname'");
      } else {
         $stmt = $db->prepare("SELECT * FROM surgery s JOIN patient p on s.patient_id = p.record_num WHERE s.surgery_date = '$surgeryDate' AND p.f_name like '$fname' AND p.l_name like '$lname'");
      }

      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo $surgeryDate;
      foreach ($rows as $row=>$r) {
         $id = $r['surgery_id'];
         echo "<a href='details.php?record=$id'><div class='border border-dark m-2 p-2 item'> <h2>" . $r['f_name'] . ' ' . $r['l_name'] . "</h2>";
          echo "<p class='ml-3'>" . $r['surgery_date'] . " " . $r['procedure'] . "</p></div></a>";
      }
      // } 

      
?>