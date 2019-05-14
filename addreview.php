<!DOCTYPE html>
<html>
<head>
	<title>More Details Page</title>
</head>
<body>
<?php 
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file;

if (!isset($_SESSION['sessUserId']))  //if user is not logged in
	header('Location:login.php'); //go to login page
	
//when Submit Review button is pressed/ form is submitted
if (isset($_POST['submit-review'])) {
	$pid = $_POST['product_code'];
	$author=$_POST['author'];
	$content=$_POST['content'];	

	//insert into reviews table
	$sql = "INSERT INTO tb_reviews
	(product_code, author, content) 
    VALUES('$pid', '$author', '$content')";
	if($stmt = $pdo->query($sql))
		header("Location:index.php?product_code=$pid&display_review= Details Updated Sucessfully");	//go to index page when review is added sucessfully
}
if(isset($_GET)){
	//get from reviews table
	$review = $pdo->prepare("SELECT author, content, date FROM tb_reviews WHERE product_code=:product_code");
	$review->execute($_GET);

	//get from products table
	$select_product = $pdo->prepare("SELECT product_code, product_name, product_details, product_manufacturer, product_price, product_image FROM tb_products WHERE product_code=:product_code");
	$select_product->execute($_GET);
	$product=$select_product->fetch();
}

?>
<sidebar></sidebar>
<main>
<!-- Display product details -->
<h1>Product Page</h1>
<ul class="products">
	<li style="list-style: none;">
		<h2><?php echo  $product['product_name']; ?> </h2>
		<p><?php echo  $product['product_details']; ?></p>
		<?php echo  "<img src='images/".$product['product_image']."' >"  ;  ?>
		<div style=" padding-left: 1%; font-family:Comic Sans MS; color:darkmagenta; font-weight: bold; font-size: 2em;">Manufacturer:<?php echo  $product['product_manufacturer']; ?></div>
		<div style=" padding-left: 1%; font-family:Comic Sans MS; color:green; font-weight: bold; font-size: 2em;">Price: £<?php echo  $product['product_price']; ?></div>
	</li>
</ul><br><br>
<!-- Display product reviews -->
<h2>Product reviews</h2>
<ul class="reviews">
<?php
foreach ($review as $row) {?>
<li>
	<p><?php echo  $row['content']; ?></p>
	<div class="details">
		<strong style="color: green;"><?php echo  $row['author']; ?></strong>
		<em><?php echo  $row['date']; ?></em>
	</div>
</li>
<?php } ?>
</ul><br><br>
<!-- Form for adding reviews to the product -->
<h2>Review Form</h2>
<form action='addreview.php' method='POST'>
	<input type="hidden" name="product_code" value="<?php echo $_GET['product_code'] ?>">
	<label>Name</label><br>
	<input type='text' name='author' ><br>
	<label>Review</label><br>
	<textarea rows='6' cols='50' type='text' placeholder='Enter Your Reviews' name='content'></textarea><br>
	<input type='submit' name='submit-review' value='Submit Review'>
	</form><br><br>
</main>
</body>
</html>