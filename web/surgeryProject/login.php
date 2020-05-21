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

   // $statement = $db->prepare('SELECT * FROM Scriptures WHERE id = :id');
   // $statement->bindValue(':id', $verse, PDO::PARAM_INT);
   // $statement->execute();
   // $results = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
</head>
<body>
   <div class='container'>
      <div class='row justify-content-center'>
         <div class='col-4'>
            <h2>Please Sign In</h2>
            <form action="login.php" method="post">
               <label for="username">Username</label>
               <input type="text" name="username" id="username"><br>
               <label for="passwd">Password</label>
               <input type="text" name="passwd" id="passwd"><br>
               <input type='submit' value='login' class='btn btn-primary'>
            </form>
         </div>
      </div>
   </div>
</body>
</html>


