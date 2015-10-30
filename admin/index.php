<?php
include("config.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
// username and password sent from form 
$myusername=addslashes($_POST['inputUsername']); 
$mypassword=addslashes($_POST['inputPassword']); 
$sql="SELECT id FROM users WHERE username='$myusername' and password='$mypassword'";
$result=  mysqli_query($bd,$sql);
$row=  mysqli_fetch_array($result);
$count=mysqli_num_rows($result);

if($count == 1){
$_SESSION['login_user']=$myusername;
header("location: welcome.php");
}
else{
$error="Your Login Name or Password is invalid";
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Incarnation :: Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="../resources/css/admin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <div class="container">
       <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputEmail" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../resources/js/bootstrap.min.js"></script>
  </body>
</html>