<!DOCTYPE html>
<html>
<head>
	<title>Adding Products To Featured </title>
</head>
<body>
<?php
	$pdo = new PDO('mysql:dbname=webassignment;host=localhost', 'root', ''); //connect to database named webssignment

	//set featured to 0 in the products table
	$updateProducts = $pdo ->prepare('UPDATE tb_products SET featured = 0 WHERE featured = 1'); 
	$updateProducts -> execute();

	//set featured to 1 when Add featured is clicked in the products table
	$setFeatured = $pdo->prepare('UPDATE tb_products SET featured = 1 WHERE product_code = :product_code');
	$criteria = [
		'product_code'=>$_GET['product_code']
	];
	//when executed fo to admin home page and display sucessfull message 
	if($setFeatured -> execute($criteria))
		header('Location:adminindex.php?showResult= Details Updated Sucessfully');

?>
</body>
</html>