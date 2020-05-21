<?php
   session_start();
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

      if(isset($_POST['username']) && isset($_POST['passwd'])){
         $username = htmlspecialchars($_POST['username']);
         $passwd = htmlspecialchars($_POST['passwd']);
         $statement = $db->prepare('SELECT * FROM surgery');
         $statement->execute();
         // $statement = $db->prepare('SELECT * FROM system_user where username = :username and password = :password');
         // $statement->bindValue(':username', $username, PDO::PARAM_STR);
         // $statement->bindValue(':password', $passwd, PDO::PARAM_STR);
         // $statement->execute();
         $results = $statement->fetchAll(PDO::FETCH_ASSOC);

         if(count($results) > 0) {
            // header('index.php');
            echo 'Success';
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
            <form action="login.php" method="post">
               <label for="username">Username</label>
               <input type="text" name="username" id="username" required><br>
               <label for="passwd">Password</label>
               <input type="password" name="passwd" id="passwd" required><br>
               <input type='submit' value='login' class='btn btn-primary'>
            </form>
         </div>
      </div>
   </div>
</body>
</html>


