<?php
require_once "inc/header.php";
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$firstName = $fm->validation($_POST['firstname']);
	$lastName = $fm->validation($_POST['lastname']);
	$email = $fm->validation($_POST['email']);
	$body = $fm->validation($_POST['body']);

	$firstName = mysqli_real_escape_string($db->link, $firstName);
	$lastName = mysqli_real_escape_string($db->link, $lastName);
	$email = mysqli_real_escape_string($db->link, $email);
	$body = mysqli_real_escape_string($db->link, $body);

	if(empty($firstName)){
		$error = "First name must not be empty";
	}elseif(empty($lastName)){
		$error = "last name must not be  empty";
	}elseif(empty($email)){
		$error = "email must not be  empty";
	}elseif(empty($body)){
		$error = "Message must not be  empty";
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
	    $error = "Email is not  valid .";
	}else{
		$message = 'ok';
	}
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
	<?php
	  if(isset($error)){
		echo "<span style='color:red'>$error</span>";
	  }elseif(isset($message)){
		echo "<span style='color:green'>$message</span>";
	  }
	?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name"  />
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address"  />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="send" value="Submit" />
						</td>
					</tr>
				</table>
				<form>
		</div>

	</div>
	<?php
	require_once "inc/sidebar.php";
	require_once "inc/footer.php";
	?>