<?php
$servername = 'localhost';
$username = 'assignment';
$password = 'assignment123';
$db = 'backendassignment';
$conn = new mysqli($servername,$username,$password,$db);
if($conn->error){
 die("connection_failed".$conn->connect_error);
}
?>
