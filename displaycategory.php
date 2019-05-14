
<!DOCTYPE html>
<html>
<head>
	<title>Category Homepage</title>
</head>
<body>

<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file
if($_SESSION['sessUserType'] != "admin"){
	header('Location:index.php'); //if the user is not admin go to index page
}
else{
	//get details from categories table if the user is admin
	$select_category = $pdo->prepare("SELECT * FROM tb_categories");
	$select_category->execute();

	//display message
	if(isset($_GET['showResult'])) $showResult = '<h4>' . $_GET['showResult'] . '</h4>';

}
?>

<!-- Table to display the categories with details(name,id) -->
<h2 style=" margin-left :7%; text-align: center;">CATEGORIES TABLE</h2><br>
<a href="addcategory.php" style="text-decoration: none;"><h3>Add Category</h3></a>
<table style="margin: 7%; padding-top:1% ;" width="800" border="2" cellspacing="2">
<td style="border:0; text-align:center; "> <?php echo @$showResult; ?></td>
<tr>
	<th>CATEGORY ID</th>
	<th>CATEGORY NAME</th>
</tr>
<?php
foreach ($select_category as $row) {?>
<tr>
	<td> <?php echo $row['category_id']; ?></td> <!-- displays category id -->
	<td> <?php echo $row['category_name']; ?></td> <!-- displays category name -->
	<td> 
		<a href="editcategory.php?category_id=<?php echo $row['category_id'];?>" style="text-decoration: none; color: green;">Edit
		</a> <!-- go to the edit category page when the Edit button is pressed -->
	</td>
	<td>
		<a href="deletecategory.php?category_id=<?php echo $row['category_id'];?>" style="text-decoration: none; color: red;">Delete
		</a><!-- The category is deleted from categories table when the Delete button is clicked -->
	</td>
</tr>
<?php
}
?>
</table>		
</body>
</html>