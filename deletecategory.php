<?php
session_start(); //starts the session
include('header_p.php'); //includes the header_p.php file

//deletes from the categories table
$deleteCategory = $pdo->prepare('DELETE FROM tb_categories WHERE category_id = :category_id');
$criteria = [
	'category_id' => $_GET['category_id'] //get category id from categories table
];
if($deleteCategory->execute($criteria))
	echo "<script>alert('A category has been deleted!')</script>"; //when executed display the sucess message
	echo "<script>window.open('adminindex.php?view_categories','_self')</script>"; //go to admin index page
?>