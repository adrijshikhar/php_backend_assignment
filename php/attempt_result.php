<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Result</h1>
    <?php
session_start();
include "conn.php";
$a = array($_POST[a1], $_POST[a2], $_POST[a3], $_POST[a4]);
$uid = $_SESSION["id"];
$qid = $_POST["qid"];
$sql = "select * from correct_answer where question_no=$qid";
$sql2 = "select points from questions where id=$qid";
$p = $conn->query($sql2)->fetch_assoc();
$correct_ans = $conn->query($sql);
$number_correct_ans = $correct_ans->num_rows;
$flag = 0;

for ($i = 0; $i < 4; $i++) {
    if (!empty($a[$i])) {
        $sql = "insert into answered_questions(uid,qid,aid) values('$uid','$qid','$a[$i]')";
        $conn->query($sql);
        while ($c = $correct_ans->fetch_assoc()) {

            if (strcmp($a[$i], $c[correct_ans]) == 0) {
                $flag++;
            }
        }
    }
}
if ($flag == $number_correct_ans) {
    $ucheck = "select * from points where uid=$uid";
    $u = $conn->query($ucheck);
   
    if ($u->num_rows > 0) {
        $upoint = $u->fetch_assoc();
        $sum_points = $upoint[points] + $p[points];
        $sql = "update points set points=$sum_points where uid=$uid";
        $conn->query($sql);
    } else {
        $sql = "insert into points(uid,points) values($uid,$p[points])";
        $conn->query($sql);
    }

    echo "<h3>Right</h3>";
} else {
    $ucheck = "select * from points where uid=$uid";
    $u = $conn->query($ucheck);
   
    if ($u->num_rows > 0) {
        $upoint = $u->fetch_assoc();
        $sum_points = $upoint[points] + 0;
        $sql = "update points set points=$sum_points where uid=$uid";
        $conn->query($sql);
    } else {
        $sql = "insert into points(uid,points) values($uid,0)";
        $conn->query($sql);
    }

    echo "<h3>Wrong</h3>";
}
?>
<button type='submit' class='btn btn-primary mb-2'><a href='/php_backend_assignment/php/welcome.php'class='badge badge-primary'>Go To Home</a></button>
</body>
</html>