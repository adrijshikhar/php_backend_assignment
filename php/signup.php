<?php
session_start();
include('conn.php');
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$username = $_POST['username'];
$gender = $_POST['gender'];
$mobile = $_POST['mobile'];
$enroll = $_POST['enroll'];
$branch = $_POST['branch'];
$year = $_POST['year'];
$sql = "insert into users(name,password,email,gender,mobile,enroll,branch,year,username) values('$name','$password','$email','$gender','$mobile','$enroll','$branch',$year,'$username')";
if ($conn->query($sql) == true) {
  echo "true";
} else {
  echo "false";
}
