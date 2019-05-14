
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>

<?php 
include('header_p.php'); //includes header_p.php file
$pdo = new PDO('mysql:dbname=webassignment;host=localhost', 'root', ''); //connect to database named webassignment
//when form is submitted or save button is pressed
if (isset($_POST['save'])) {
    //insert all the details provided in the users table
    $stmt = $pdo->prepare('INSERT INTO tb_user_details
            ( user_type, name, surname, gender, email, username, password, mobile_number, address) 
            VALUES( :user_type, :name, :surname, :gender, :email, :username, :password, :mobile_number, :address)
            ');
    $criteria = [
        'user_type'=> $_POST['user_type'],
        'name'=> $_POST['name'],
        'surname'=> $_POST['surname'],
        'gender'=>$_POST['gender'],
        'email'=> $_POST['email'],
        'username'=> $_POST['username'],
        'password'=>  password_hash($_POST['password'], PASSWORD_DEFAULT), //password hashing(extra security)
        'mobile_number'=> $_POST['mobile_number'],
        'address'=> $_POST['address'],
    ];
    if($stmt->execute($criteria))
        $showResult ='Registered Sucessfully'; //display sucessfull message
}
?>
<!-- Form to register the new user -->
<table width="400" cellspacing="13">
<caption><h2>REGISTRATION FORM. .</h2></caption>
<form action="register.php" method="POST">
<tr>
    <td colspan="2"><?php echo @$showResult;?></td>
</tr>
<tr>
    <td>USER TYPE: </td>
    <td><select name="user_type" required>
        <option value="">Please Select User Tpye</option>
        <option value="user">user</option>
        <option value="admin">admin</option>
    </select></td>
</tr>
<tr>
    <td>First Name: </td>
    <td><input type="text" placeholder="Enter Your Name" name="name" required></td>
</tr>
<tr>
    <td>Last name: </td>
    <td><input type="text" placeholder="Enter Your Surname" name="surname" required></td>
</tr>
<tr>
    <td>Gender: </td>
    <td>
        <input type="radio" name="gender" value="Male"> Male<br>
        <input type="radio" name="gender" value="Female"> Female  
    </td>
</tr>
<tr>
    <td>Email Address: </td>
    <td><input type="email" placeholder="abc@gmail.com" name="email" required></td>
</tr>
    <tr>
    <td>Username: </td>
    <td><input type="username" placeholder="Enter Username" name="username" required></td>
</tr>
<tr>
    <td>Password: </td>
    <td><input type="password" placeholder="Enter Password" name="password" required></td>
</tr> 
<tr>
    <td>Mobile Number:</td>
    <td><input type="text" placeholder="Enter Mobile Number" name="mobile_number" required></td>
</tr>
<tr>
    <td>Address:</td>
    <td><textarea placeholder="Enter Address" name="address" required></textarea></td>
</tr>
<tr>
    <td colspan="2" align="center"><input type="submit" value="Save" name="save">
                                   <input type="reset" value="reset"></td>
</tr>
<tr>
<td> <div class="login">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p> <!-- Redirect to login page if already a user -->
</div></td>
</tr>
</form>
</table>
</body>
</html>

