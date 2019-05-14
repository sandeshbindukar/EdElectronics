
<!DOCTYPE html>
<html>
<head>
<title>Inserting Categories</title>
</head>
<body>

<?php 
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file
if (!isset($_SESSION['sessUserId']))  //if user is not logged in
	header('Location:login.php'); //go to login page
$pdo = new PDO('mysql:dbname=webassignment;host=localhost', 'root', ''); //connect to database named webssignment

//get category list from database
$category = $pdo->prepare("SELECT * FROM tb_categories");
$category->execute();

//when add button is clicked/ form is submitted
if (isset($_POST['add'])) {
	//insert in the categories table 
	$addcategory = $pdo->prepare('INSERT INTO tb_categories( category_id, category_name )
	VALUES(:category_id, :category_name)');
	$criteria = [
	'category_id' => $_POST['category_id'],
	'category_name' => $_POST['category_name']
	];
	if($addcategory->execute($criteria)) 
		$showResult= 'Inserted Sucessfully'; //display 'Inserted Sucessfully' if inserted in categories table
	else
		$showResult= 'Inserting UnSucessful'; //display 'Inserting Unucessfull' if inserting in categories table is unsucessful
}
?>

<!-- Form for adding the category table -->
<table width="400" cellspacing="13">
<caption><h2>CATEGORIES</h2></caption>
<form action="addcategory.php" method="POST" enctype="multipart/form-data">
<tr>
<td colspan="2"><?php echo @$showResult;?></td>
</tr>
<tr>
<td>Category Id: </td>
<td><input type="text" placeholder="Enter Category's Id" name="category_id" required></td>
</tr>
<tr>
<td>Category Name: </td>
<td><input type="text" placeholder="Enter Category's Name" name="category_name" required></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Add" name="add">
                   <input type="reset" value="Reset"></td>
</tr>
</form>
</table>
</body>
</html>