<?php
include 'conn.php';
$sql = "select * from questions";
$result = $conn->query($sql);

echo "<table class='table'>
<thead class='thead-dark'>
 <tr>
    <th scope='col'>S.No.</th>
    <th scope='col'>Id</th>
    <th scope='col'>Question</th>
    <th scope='col'>Answer</th>
    <th scope='col'>Multiple Answer</th>
    <th scope='col'>Points</th>
   </tr>
   </thead>
   <tbody>
   ";
$i = 0;
if ($result->num_rows > 0) {
    while ($r = $result->fetch_assoc()) {
        $i++;
        echo "<tr>
        <td>$i</td>
        <td>$r[id]</td>
        <td>$r[question]</td>";
        $s = "select * from correct_answer where question_no=$r[id]";
        $ans = $conn->query($s);

        echo "  <td>";
        if ($ans->num_rows > 0) {
            while ($ans_id = $ans->fetch_assoc()) {
                $correct_ans = $conn->query("select * from multiple_answer where id=$ans_id[correct_ans]")->fetch_assoc();
                echo "<li>$correct_ans[multiple_answers]</li>";
            }
        }
        echo "</td>";
        $ma = $conn->query("select * from multiple_answer where question_no=$r[id]");
        echo "<td>";
        if ($ma->num_rows > 0) {

            while ($mans = $ma->fetch_assoc()) {
                echo "<li>$mans[multiple_answers]</li>";
            }
        }
        echo "</td>";

        echo "  <td>$r[points]</td>
      </tr>";
    }

} else {
    echo "<td colspan='6'>No Record Found</td>";
}
echo "</tbody></table>";
