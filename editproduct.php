
<!DOCTYPE html>
<html>
<head>
<title>Edit Products</title>
</head>
<body>

<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file
//get product_details by id
$stmt = $pdo->prepare("SELECT product_name, product_details, product_manufacturer, product_price, product_image, category_id FROM tb_products  WHERE product_code = :product_code");
$stmt ->execute($_GET);
$showResult= $stmt ->fetch();

//get category list
$category = $pdo->prepare("SELECT * FROM tb_categories");
$category->execute();

//when form submitted / update button is pressed
if (isset($_POST['update'])) {
	global $pdo; //make pdo as a global variable
	$file =  file_get_contents($_FILES['image']['name']); //get content of a file
	$stmt = $pdo ->prepare('UPDATE tb_products SET product_name = :product_name, product_details= :product_details, product_manufacturer= :product_manufacturer, product_price= :product_price, category_id= :category_id, product_image =:image WHERE product_code = :product_code');
	$stmt->bindParam(':product_image',$file);
	unset($_POST['update']);
	if ($stmt -> execute($_POST)) {
	header('Location:adminindex.php?showResult= Details Updated Sucessfully'); //when updated successfully, go to admin homepage and display success message
	}
}
?>

<!-- Form to edit the products -->
<form style="margin: 7%;" action="editproduct.php" method="POST">
<h2 style="text-align: center;">Edit Product</h2>
<input type="hidden" name="product_code" value="<?php echo $_GET['product_code'] ?>">
<label>Product Name</label><br>
<textarea name="product_name"> <?php echo $showResult['product_name'] ?> </textarea> <br><br>
<label>Product Details</label><br>
<textarea name="product_details"> <?php echo $showResult['product_details'] ?> </textarea> <br><br>
<label>Manufacturer</label><br>
<textarea name="product_manufacturer"> <?php echo $showResult['product_manufacturer'] ?> </textarea> <br><br>
<label>Price</label><br>
<textarea name="product_price"> <?php echo $showResult['product_price'] ?> </textarea> <br><br>
<label>Image:</label><input type="file" name="image"><br><br>
<label>Category</label>
<select name="category_id">
<?php
foreach ($category as $row) {?>
	<option value=" <?php echo $row['category_id'] ?>">
		<?php echo $row['category_name'] . ' '?>
	</option> 
<?php }
?>
</select><br><br>
<input type="submit" name="update" value="Update"><br><br>
</form>

</body>
</html>

