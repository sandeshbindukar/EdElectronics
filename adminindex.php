
<!DOCTYPE html>
<html>
<head>
<title>Admin Homepage</title>
</head>
<body>

<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file
if($_SESSION['sessUserType'] != "admin"){
	header('Location:login.php'); //if the user is not admin go to index page
}
else{
	//select details from product table if the user is admin
	$select_product = $pdo->prepare("SELECT product_code, product_name, product_details, product_manufacturer, product_price, product_image FROM tb_products");
	$select_product->execute();

	//display message
	if(isset($_GET['showResult'])) $showResult = '<h4>' . $_GET['showResult'] . '</h4>';
}
?>

<!-- Table to display the products with details and admin can add, delete, set featured products in this page -->
<h2 style=" margin-left :7%; text-align: center;">PRODUCTS TABLE</h2><br>
<a href="addproduct.php" style="text-decoration: none;"><h3>Add Product</h3></a> <!-- link to addProduct page -->
<table style="margin: 7%; padding-top:1% ;" width="1400" border="2" cellspacing="2">
<td style="border:0; text-align:center; "> <?php echo @$showResult; ?></td> 
<tr>
	<th>PRODUCT CODE</th>
	<th>PRODUCT NAME</th>
	<th>PRODUCT DETAILS</th>
	<th>MANUFACTURER</th>
	<th>PRICE</th>
	<th>IMAGE</th>
</tr>
<?php
foreach ($select_product as $row) {?> 
	<tr style="text-align: center;">
		<td> <?php echo $row['product_code']; ?></td> <!-- displays product code -->
		<td> <?php echo $row['product_name']; ?></td> <!-- displays product name -->
		<td> <?php echo $row['product_details']; ?></td> <!-- displays product details -->
		<td> <?php echo $row['product_manufacturer']; ?> </td> <!-- displays product manufacturer -->
		<td> <?php echo $row['product_price']; ?> </td> <!-- displays product price -->
		<td><?php
		 	echo  "<img src='images/".$row['product_image']."' >"  ; 
		 ?></td> <!-- displays product image -->
		<td width="50">
			<a href="editproduct.php?product_code=<?php echo $row['product_code'];?>" style="text-decoration: none; color: green;">Edit
			</a> <!-- go to the edit product page when the Edit button is pressed -->
		</td>
		<td width="65">
			<a href="deleteproduct.php?product_code=<?php echo $row['product_code'];?>" style="text-decoration: none; color: red;">Delete
			</a><!-- The product is deleted from products table when the Delete button is clicked -->
		</td>
		<td width="70">
			<a href="addfeatured.php?product_code=<?php echo $row['product_code'];?>" style="text-decoration: none; color: #92B2BF;">Add Featured</a><!-- The product is added as featured when the Add Featured button is clicked -->
		</td>
	</tr>
<?php
}
?>
</table>
</body>
</html>






