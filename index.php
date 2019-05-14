<!doctype html>
<html>
<head>
<title>Ed's Electronics</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="electronics.css" />
</head>
<body>
<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file
	$pdo = new PDO('mysql:dbname=webassignment;host=localhost', 'root', ''); //connect to database named webassignment

	//get product details from products table
	$select_product = $pdo->prepare("SELECT product_code, product_name, product_details, product_manufacturer, product_price, product_image FROM tb_products ORDER BY product_code desc");
	$select_product->execute();
	$display_featured = $pdo->prepare("SELECT product_name, product_details FROM tb_products WHERE featured = 1");
	$display_featured->execute();
?>

<section></section>
<main>
<h1>Welcome to Ed's Electronics</h1>
<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
<hr />
<!-- Form to search products by typing some keywords -->
<form action="index.php" method="POST">
	<input type="text" name="key" placeholder="Search For Products " style="text-align: center;" /> 
	<input type="submit" name="submit" value="Search" />	
</form>
<hr />
<?php 
if (isset($_POST['submit'])) { //when form is submitted i.e. submit button is pressed
	$key = '%'.$_POST['key'].'%';
	$result = $pdo->prepare("SELECT * FROM tb_products WHERE  product_name LIKE :key");
	$criteria = [
		'key' => $key
	];
	$result->execute($criteria);
?>
	<ul class="products"><?php
	foreach ($result as $row) {?>
	<li>
		<!-- Displays products details like name, image, price, code -->
		<h2><?php echo  $row['product_name']; ?> </h2>  <!-- display products name -->
		<p><?php echo  $row['product_details']; ?></p> <!-- displays product details --> 
		<?php echo  "<img src='images/".$row['product_image']."' >"  ;  ?> <!-- displays products image -->
		<div style=" padding-left: 25%; font-family:Comic Sans MS; color:darkmagenta; font-weight: bold; font-size: 2em;"><?php echo  $row['product_manufacturer']; ?></div> <!-- displays products manufacturer -->
		<div class="price">£<?php echo  $row['product_price']; ?></div> <!-- displays products price -->
		<a href="addreview.php?product_code=<?php echo $row['product_code'];?>" style=" float: left; text-decoration: underline; font-weight: bold; color: #92B2BF;">More Details</a> <!-- when pressed go to more details page  -->
	</li>
	<?php } ?>
	</ul>
<?php }
else{ ?>
	<h2>Product list</h2>
	<ul class="products">
	<?php
	foreach ($select_product as $row) {?>
		<li>
			<!-- Displays products details like name, image, price, code -->
			<h2><?php echo  $row['product_name']; ?></h2> <!-- display products name -->
			<p><?php echo  $row['product_details']; ?></p> <!-- displays product details -->
			<?php echo  "<img src='images/".$row['product_image']."' >"  ;  ?> <!-- displays products image -->
			<div style=" padding-left: 25%; font-family:Comic Sans MS; color:darkmagenta; font-weight: bold; font-size: 2em;"><?php echo  $row['product_manufacturer']; ?></div> <!-- displays products manufacturer -->
			<div class="price">£<?php echo  $row['product_price']; ?></div> <!-- displays products price -->
			<a href="addreview.php?product_code=<?php echo $row['product_code'];?>" style=" float: left; text-decoration: underline; font-weight: bold; color: #92B2BF;">More Details</a> <!-- when pressed go to more details page  -->
		</li>
	<?php } ?>
	</ul>
	<hr />
<?php }?>
</main>
<aside>
<!-- For featured products -->
<h1><a href="#">Featured Product</a></h1>
<?php
foreach ($display_featured as $row) {?>
	<p><strong><?php echo  $row['product_name']; ?></strong></p> <!-- display product name -->
	<p> <?php echo  $row['product_details']; ?> </p> <!-- display product details -->	
<?php } ?>
</aside>
</body>
</html>
