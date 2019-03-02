<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<h1>Question</h1>
<form action="attempt_result.php" method="post">
<?php
include "conn.php";
$qid = $_GET["qid"];
$sql="select * from questions where id=$qid";
$q=$conn->query($sql)->fetch_assoc();
echo "<h3>$q[question]</h3>";
$sql2="select * from multiple_answer where question_no=$qid";
$a=$conn->query($sql2);
if($a->num_rows>0)
echo "<input type='text' hidden/ value=$qid name='qid'>";
$i=0;
    while($ans=$a->fetch_assoc())
    {
        $i++;
        echo "<div class='form-check'>
        <input class='form-check-input' type='checkbox' name=a$i value=$ans[id] >
        <label class=form-check-label'>$ans[multiple_answers]</label>
      </div>";
    }
    echo "<button type='submit' class='btn btn-primary mb-2'>Submit</button>";
?>
<button type='submit' class='btn btn-primary mb-2'><a href='/php_backend_assignment/php/welcome.php'class='badge badge-primary'>Go To Home</a></button>

</form>
</body>
</html>





