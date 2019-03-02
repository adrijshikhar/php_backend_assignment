<?php
include "conn.php";
session_start();
$sql = "select * from points order by points desc";
$points = $conn->query($sql);
$i=0;
echo "<table class='table'>
<thead class='thead-dark'>
 <tr>
    <th scope='col'>S.No.</th>
    <th scope='col'>Name</th>
    <th scope='col'>Points</th>
   </tr>
   </thead>
   <tbody>
   ";
while ($p=$points->fetch_assoc()) {
    $i++;
    $sql1="select name from users where id=$p[uid]";
    $name=$conn->query($sql1)->fetch_assoc();
    echo "<tr><td>$i</td><td>$name[name]</td><td>$p[points]</td></tr>";
}
echo "";
