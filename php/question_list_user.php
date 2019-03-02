<?php
include('conn.php');
function check_ques_attempt($qid) {
include('conn.php');
$sql="select * from answered_questions where uid=$_SESSION[id] and qid=$qid";
$s=$conn->query($sql);
if($s->num_rows>0)
{
    return "disabled";
}
else{
    return "";
}

}
$sql = "select * from questions";
$ques = $conn->query($sql);
echo "<table class='table'>
<thead class='thead-dark'>
 <tr>
    <th scope='col'>S.No.</th>
    <th scope='col'>Question</th>
    <th scope='col'>Answer</th>
    <th scope='col'>Points</th>
   </tr>
   </thead>
   <tbody>
   ";
if ($ques->num_rows > 0) {
    $i = 0;
    
    while ($q = $ques->fetch_assoc()) {
        $i++;
        if(check_ques_attempt($q[id])=='disabled'){
            $check="Attempted";
        }
        else {
            $check="<a href='quiz.php?qid=$q[id]'class='badge badge-primary'>Attempt</a>";
        }
        echo "  <tr>  <td>$i</td>
                  <td>$q[question]</td>
                  <td> <button  class='btn btn-primary mb-2' id='question_attempt_button' ".check_ques_attempt($q[id]).">".$check."</button></td>
                  <td>$q[points] </td></tr>";
                
    }
} else {
    echo "<td colspan='4'>No Record Found</td>";
}
echo "</tbody></table>";
