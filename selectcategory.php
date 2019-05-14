<!DOCTYPE html>
<html>
<head>
	<title>Display From Categories</title>
</head>
<body>

<?php
session_start(); //starts the session
include('header_p.php'); //includes header.php file

// if the user is a normal user and logged in
if(!isset($_SESSION['sessUserType'] )){
$pdo = new PDO('mysql:dbname=webassignment;host=localhost', 'root', ''); //connect to database named webassignment

//get id and details from table 
$displayCatP = $pdo->prepare("SELECT * FROM tb_products WHERE category_id = :category_id "); 
$criteria = [
	"category_id"=>$_GET['catId']
];
$displayCatP->execute($criteria);

foreach ($displayCatP as $row) { ?>
<ul>
	<li>
		<!-- Displays products details like name, image, price, code -->
		<h2><?php echo  $row['product_name']; ?> </h2>  <!-- display products name -->
		<p><?php echo  $row['product_details']; ?></p> <!-- displays product details --> 
		<?php echo  "<img src='images/".$row['product_image']."' >"  ;  ?> <!-- displays products image -->
		<div style=" padding-left: 25%; font-family:Comic Sans MS; color:darkmagenta; font-weight: bold; font-size: 2em;"><?php echo  $row['product_manufacturer']; ?></div> <!-- displays products manufacturer -->
		<div style="color: green; font-weight: bold;">£<?php echo  $row['product_price']; ?></div> <!-- displays products price -->
	</li>
	<?php } ?>
</ul>
<?php 
}
else{
	header('Location:login.php'); //go to login page if not logged in
}
?>

</body>
</html>