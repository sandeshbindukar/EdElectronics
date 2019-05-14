
<!DOCTYPE html>
<html>
<head>
	<title>Edit Categories</title>
</head>
<body>

<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file

//get details from categories table
$category = $pdo->prepare("SELECT * FROM tb_categories");
$category->execute($_GET);
$showResult= $category ->fetch();

//when the update button is pressed/ form is submitted
if (isset($_POST['update'])) {
	$editCategory = $pdo ->prepare("UPDATE tb_categories SET category_name = :category_name WHERE  category_id= :category_id"); //updates categories table
	unset($_POST['update']);
	if ($editCategory -> execute($_POST)) {
		header('Location:adminindex.php?showResult= Details Updated Sucessfully'); //when updated sucessfully, go to the admin homepage
	}
}

?>

<!-- Form to edit the categories -->
<form style="margin: 7%;" action="editcategory.php" method="POST">
	<h2 style="text-align: center;">Edit Category</h2>
	<input type="hidden" name="category_id" value="<?php echo $_GET['category_id'] ?>">
	<label>Product Name</label><br>
	<textarea name="category_name"> <?php echo $showResult['category_name'] ?> </textarea> <br><br>
	<input type="submit" name="update" value="Update">
</form>
</body>
</html>

