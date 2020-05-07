<?php
   session_start();

   if (isset($_POST['action']) && isset($_POST['item'])){
      if ($_POST['action'] == 'removeone') {
         $index = array_search($_POST['item'], $_SESSION['cart'], true);
         array_splice($_SESSION['cart'], $index, 1);
      } else if ($_POST['action'] == 'removeall') {
         while(array_search($_POST['item'],$_SESSION['cart'], true)) {
            $index = array_search($_POST['item'], $_SESSION['cart'], true);
            array_splice($_SESSION['cart'], $index, 1);
         }
      }
   }
?>