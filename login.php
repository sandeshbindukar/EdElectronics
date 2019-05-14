<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>

<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file
//connect to database
$pdo = new PDO('mysql:dbname=webassignment;host=localhost','root','');

if (isset($_POST['login'])){ //when form submitted or login button is pressed
  //get details from users table by username 
  $stmt = $pdo-> prepare("SELECT * FROM tb_user_details WHERE username= :username");
  $criteria = [
  'username' => $_POST['username'],
  ];
  $stmt->execute($criteria);
  if($stmt ->rowCount() > 0){
     $row = $stmt ->fetch();
    if(password_verify($_POST['password'], $row['password'])){ //checks the password entered and the password in the database
      $_SESSION['sessUserId'] = $row['user_id'];
      $_SESSION['sessUserType'] = $row['user_type'];
      if($_SESSION['sessUserType'] == 'admin') //if the user is admin
        header('Location:adminindex.php'); // go to admin index page
      else
        header('Location:index.php'); //else go to index home page
      }
  else{
    $showError = '<p> Login Failed. Please Try Again.</p>'; //display error message
  }
}
else
  $showError ='<p> Login Failed. Please Try Again.</p>'; //display error message
}
?>

<!-- Form for the login page -->
<form action="login.php" method="post" >
<table cellspacing="15">
<caption><h2>LOGIN PAGE. .</h2></caption>
  <tr>
    <td colspan="2"><?php echo @$showError;?></td> <!-- shows error message in this column -->
  </tr>
  <tr>
    <td>Username: </td>
    <td><input type="username" placeholder="Enter Your Username" name="username" required/></td>
  </tr>
  <tr>
    <td>Password: </td>
    <td><input type="password" placeholder="Enter Your Password" name="password" required/></td>
  </tr>
  <tr>
    <td colspan="1" align="center"><input type="submit" value="Login" name="login"/>
  </tr>
  <tr>
    <td> <div class="register">
      <p>Don't have an account? <a href="register.php"><br>  Sign Up</a>.</p> <!-- Redirect to registration page if not registered -->
      </div></td>
  </tr>
</table>
</form>
</body>
</html>



