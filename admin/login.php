<?php
require_once "../lib/Session.php";
Session::checkLogin();
require_once "../lib/Database.php";
require_once "../helpers/format.php";

$db = new Database();
$fm = new Format();
?> 
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
		  if($_SERVER['REQUEST_METHOD'] == 'POST'){
			 $userName = $fm->validation($_POST['username']);
			 $password = $fm->validation($_POST['password']);

			 $userName = mysqli_real_escape_string($db->link, $userName);
			 $password = mysqli_real_escape_string($db->link, $password);

			 $query = "select * from tbl_user where username = '$userName' and password = '$password' ";
			 $result = $db->select($query);
			 if($result != false){
				$userData = mysqli_fetch_array($result);
					Session::set("login", true);
					Session::set("name", $userData['name']);
					Session::set("userId", $userData['id']);
					Session::set("userRole", $userData['role']);
					header('location:index.php');
			 }else{
				echo "<span style='color:red; font-size:18px;'>Username or Password not matched !! .</span>" ;
			 }
		  }

		?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>