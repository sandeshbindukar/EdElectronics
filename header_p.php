<?php
 $pdo = new PDO('mysql:dbname=webassignment;host=localhost', 'root', '');  //connect to database named webssignment

//get details from categories table
 $select_category = $pdo->prepare("SELECT * FROM tb_categories");
 $select_category->execute();
?>

<!-- header of the website -->
<header>
<h1>Ed's Electronics</h1> <!-- title of the website -->
<ul>
	<li><a href="index.php">Home</a></li> <!-- link to index page -->
	<li><a href="adminindex.php">Products</a> <!-- link to admin index page -->
		
	</li>
	<li><a href="displaycategory.php">Category</a>
		<ul>
		<?php
		foreach ($select_category as $row) {?>
			<li><a href="selectcategory.php?catId=<?php echo $row['category_id'] ?> ">
				<?php echo $row['category_name'];} ?> </a></li> <!-- displays the list of items in the categories table -->
		</ul>
	</li> <!-- link to display category page -->
</ul>
<address>
<p>We are open 9-5, 7 days a week. Call us on
	<strong>01604 11111</strong>
</p>
<?php 
	if (isset($_SESSION['sessUserType'])) {
		//get user details from users table by id and type
		$stmt = $pdo-> prepare("SELECT * FROM tb_user_details WHERE user_id = :user_id AND user_type = :user_type");
		$criteria = [
		'user_id' => $_SESSION['sessUserId'],
		'user_type' => $_SESSION['sessUserType']
		];
		$stmt->execute($criteria);
		$user = $stmt->fetch();

		echo 'Hello, '. $user['username'];  ?> <!-- displays Hello message to a user -->
		<h3><a href = "logout.php">Logout</a><h3> <!-- gets logged out when pressed -->
		<?php  
	} else { 
	?>
		<h3><a href="register.php">Register</a></h3> <!-- link to registration page -->
		<h3><a href="login.php">Login</a></h3>	<!-- link to login page -->
	<?php } ?>
</address>
</header>

<!--footer of the website -->
<footer>
&copy; Ed's Electronics 2018
</footer>

<!-- CSS codes -->
<style type="text/css">
@import url('https://stockfont.org/?61d8d93e96daea17784e70dab543e8db3a80e91561d70ef7787a11085c0aa46d');
* {margin: 0; padding: 0;}
body {background-color: #DEDEDE;
 font-family: 'Oxygen-Regular';
display: grid;
	grid-template-columns: 10% 70% 20%;
 grid-template-rows: auto;
grid-template-areas: "header header header"
"img img aside"
". main aside"
"footer footer footer";
}
h1 { font-family: 'Audiowide', cursive; margin: 0.4em; font-weight: bold; margin-bottom: 1em;}
header {background-color: #1C2524; grid-area: header;
display: grid;  grid-template-columns: 10% 80% 10%;}
header h1:before {content: "\1F5B3"; font-family: 'hack'; padding-right: 0.4em;}
header h1 {color: #92B2BF; text-shadow: 2px 2px 2px darkgreen;}
header a { color: white; text-decoration: none; }
header address {float: right; color: white; font-style: normal; padding: 1em;}
header address a{color: #92B2BF;}
header address a:hover{color:lightgreen;}
header ul {align-self: center; display: grid; grid-template-columns: auto auto auto; grid-template-rows: auto; color: white; list-style-type: none;}
header > ul > li {font-size: 2em; cursor: pointer; text-align: center;}
header ul li ul { margin-left: 10vw; text-align: left; display: none; position: absolute; background-color: #333; padding: 20px;}
header ul li ul li {padding: 1vw;}
header ul li:hover ul {display: block;}
p {margin-top: 0.5em; margin-bottom: 0.5em;}
footer {color: white; padding: 1em; background-color: black; font-size: 0.7em; grid-area: footer;}
input[type=submit]{width:120px;height:30px}
input[type=reset]{width:100px;height:30px}
input[type=submit]:hover{background:lightgreen}
input[type=reset]:hover{background:pink}

</style>



