<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file

//deletes from the products table
$deleteProduct = $pdo->prepare('DELETE FROM tb_products WHERE product_code = :product_code');
$criteria = [
	'product_code' => $_GET['product_code'] //get product code from products table
];
if($deleteProduct->execute($criteria))
	echo "<script>alert('A product has been deleted!')</script>"; //when executed display the sucess message
	echo "<script>window.open('adminindex.php?view_products','_self')</script>"; //go to admin index page
?>
?>