<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcom</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
   <h1>Welcome  <?php echo $_SESSION[name]?></h1>
  <div class="row p-3">
   <div class="col col-9"><?php include("question_list_user.php")?></div>
   <div class="col col-3"><h3>Leader Board <?php include("leaderboard.php")?></h3></div>
  </div>  




   
</body>
</html>