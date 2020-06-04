<?php
   session_start();
   $db = null;

   try {
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
   catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
   }

   if (isset($_POST['username'])) {
      $username = htmlspecialchars($_POST['username']);
   }

   if (isset($_POST['password'])) {
      $passwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
   }

   if (isset($_POST['password2'])) {
      $passwd2 = password_hash($_POST['password2'], PASSWORD_BCRYPT);
   }

   if (isset($username) && isset($passwd)) {
      try {
         $insert = $db->prepare("INSERT INTO system_user (system_username, password) VALUES ('$username', '$passwd')");
         $insert->execute();
         
      } catch (Exception $e) {
         $error = 'Failed to Create Account <br>Error: ' . $e->getMessage();
      } 
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign up</title>
   <style>
      .hide {
         display: none;
      }
   </style>
</head>
<body>
   <?php if(isset($error)) {echo "<h3>" . $error . "</h3>";}?>
   <span class='hide' id='seven'>Password must be at least 7 characters</span><br>
   <span class='hide' id='match'>Passwords do not match</span>
   <form action="signup.php" onsubmit='return validate()' method='post'>
      <label for="username">Username: </label>
      <input type="text" name='username' id='username' required><br>
      <label for="password">Password: </label>
      <input type="password" name='password' id='password' required><br>
      <label for="password2">Confirm Password: </label>
      <input type="password" name='password2' id='password2' required><br>
      <input type="submit" name="signup" id="signup" value='Sign Up'>
   </form>
   <script>
      function validate() {
         var passwd = document.getElementById('password').value;
         var passwd2 = document.getElementById('password2').value;
         var valid = true;

         if (!(passwd == passwd2)) {
            valid = false;
            document.getElementById('match').classList.remove('hide');
         } else {
            document.getElementById('match').classList.add('hide');
         }

         if (!(passwd.length >= 7)) {
            valid = false;
            document.getElementById('seven').classList.remove('hide');
         } else {
            document.getElementById('seven').classList.add('hide');
         }

         return valid;
      }
   </script>
</body>
</html>