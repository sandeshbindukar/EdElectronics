
<!DOCTYPE html>
<html>
<head>
<title>Inserting Products</title>
</head>
<body>

<?php 
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file;

if (!isset($_SESSION['sessUserId']))  //if user is not logged in
	header('Location:login.php'); //go to login page

$pdo = new PDO('mysql:dbname=webassignment;host=localhost', 'root', ''); //connect to database named webssignment

//get category list from database
$category = $pdo->prepare("SELECT * FROM tb_categories");
$category->execute();

//when add button is clicked/ form is submitted
if (isset($_POST['add'])) {
	// $product_code= $_POST['product_code'];
	$product_name= $_POST['product_name'];
	$product_details= $_POST['product_details'];
	$product_manufacturer= $_POST['product_manufacturer'];
	$product_price= $_POST['product_price'];
	$category_id= $_POST['category_id'];
	$product_image = $_FILES['product_image']['name']; 
		$filepath ="images/".basename($product_image);
	$temp_file = $_FILES['product_image']['tmp_name'];
		move_uploaded_file($temp_file,$filepath);
//insert in the products table
	$addProducts = "INSERT INTO tb_products
	(  product_name, product_details, product_manufacturer, product_price, product_image, category_id) 
	    VALUES( '$product_name', '$product_details', '$product_manufacturer', '$product_price', '$product_image', '$category_id')";
		if($stmt = $pdo->query($addProducts))
			$showResult= 'Inserted Sucessfully'; //display 'Inserted Sucessfully' if inserted in products table
		else
			$showResult= 'Inserting UnSucessful'; //display 'Inserting Unucessfull' if inserting in products table is unsucessful
	}
?>

<!-- Form for adding the products table -->
<table width="400" cellspacing="13">
<caption><h2>PRODUCTS</h2></caption>
<form action="addproduct.php" method="POST" enctype="multipart/form-data">
<tr>
<td colspan="2"><?php echo @$showResult;?></td>
</tr>
<tr>
<td>Product Name: </td>
<td><input type="text" placeholder="Enter Product's Name" name="product_name" required></td>
</tr>
<tr>
<td>Product Details: </td>
<td><textarea type="text" placeholder="Enter Product's Details" name="product_details" required></textarea>
</tr>
<tr>
<td>Manufacturer: </td>
<td><textarea type="text" placeholder="Enter Manufacturer's" name="product_manufacturer" required></textarea></td>
</tr>
<tr>
<td>Product Price: </td>
<td><input type="text" placeholder="Enter Product's Price" name="product_price" required></td>
</tr>
<tr>
<td>Upload Product's Image</td>
<td><input type="file" value="" name="product_image"/></td>
</tr>
<tr>
<td>Category: </td>
<td>
	<select name="category_id">
		<?php
		foreach ($category as $row) {?>
			<option value=" <?php echo $row['category_id'] ?>">
					<?php echo $row['category_name'] . ' '?>
			</option> 
			<?php }
		?>
	</select>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
	<input type="submit" value="Add" name="add">
    <input type="reset" value="Reset"></td>
</tr>
</form>
</table>
</body>
</html>

