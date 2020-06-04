<?php
   session_start();

   if (isset($_SESSION['loggedin'])) {
      if (isset($_SESSION['returnpage'])) {
         $returnpage = $_SESSION['returnpage'];
         header("Location: $returnpage");
      } else {
         header('Location: index.php');
      }
   }

   require('dbconnect.php');
   $db = getDb();

   if(isset($_POST['username']) && isset($_POST['passwd'])){
      $username = htmlspecialchars($_POST['username']);
      $passwd = htmlspecialchars($_POST['passwd']);
      $statement = $db->prepare('SELECT * FROM system_user WHERE system_username = ? AND password = ?');
      $statement->execute([$username, $passwd]);
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);

      if(count($results) > 0) {
         $_SESSION['loggedin'] = True;
         if (isset($_SESSION['returnpage'])) {
            $returnpage = $_SESSION['returnpage'];
            header("Location: $returnpage");
         } else {
            header('Location: index.php');
         }
      } else {
         $error = 'Incorrect username or password.';
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
   <link rel='stylesheet' type='text/css' href='css/login.css'>
</head>
<body>
   <div class='container'>
      <div class='row justify-content-center h75'>
         <div class='col-6 text-center align-self-center border border-light rounded-lg p-4'>
            <h2>Please Sign In</h2>
            <?php
               if(isset($error)){
                  echo "<p style='color: red;'> $error </p>";
               }
            ?>
            <form action="login.php" method="post">
               <label for="username">Username</label>
               <input type="text" name="username" id="username" required><br>
               <label for="passwd">Password</label>
               <input type="password" name="passwd" id="passwd" required><br>
               <input type='submit' value='login' class='btn btn-primary'>
               <a href="signup.php">signup</a>
            </form>
         </div>
      </div>
   </div>
</body>
</html>


