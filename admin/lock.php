<?php
include('config.php');
session_start();
$user_check=$_SESSION['login_user'];
$sql="SELECT username from users WHERE username='$user_check'";
$ses_sql=mysqli_query($bd,$sql);
$row=mysqli_fetch_array($ses_sql);
$login_session=$row['username'];
if(!isset($login_session)){
header("Location:index.php");
}
?>