<?php
include 'conn.php';
if (!empty($_POST[question]) && !empty($_POST[a1]) && !empty($_POST[a2]) && !empty($_POST[a3]) && !empty($_POST[a4]) && !empty($_POST[c1]) && !empty($_POST[c2]) && !empty($_POST[c3]) && !empty($_POST[c4]) && !empty($_POST[p])) {
    $q = $_POST[question];
    $a = array($_POST[a1], $_POST[a2], $_POST[a3], $_POST[a4]);
    $c = array($_POST[c1], $_POST[c2], $_POST[c3], $_POST[c4]);
    $p = $_POST[p];

    $sql = "insert into questions(question,points) values('$q','$p')";
    $conn->query($sql);
    $qid = $conn->query("select id from questions where question='$q'")->fetch_assoc();

    for ($i = 0; $i < 4; $i++) {
        $sql2 = "insert into multiple_answer(question_no,multiple_answers) values('$qid[id]','$a[$i]')";
        $conn->query($sql2);
        $aid = $conn->query("select id from multiple_answer where multiple_answers='$a[$i]'")->fetch_assoc();
        if ($c[$i] != 0) {
            $sql3 = "insert into correct_answer(question_no,correct_answer) values('$qid[id]','$aid[id]')";
            $conn->query($sql3);
        }
    }
    echo "true";
} else {
    echo "false";
}
