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
			 $email = $fm->validation($_POST['email']);
			 $email = mysqli_real_escape_string($db->link, $email);
             if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                echo "Email is not  valid .";
            }else{
                $query = "select * from tbl_user where email = '$email' ";
                $checkEmail = $db->select($query);
                if($checkEmail){
                   $result = $checkEmail->fetch_assoc();
                   $userid = $result['id'];
                   $userName = $result['username'];
                    $text = substr($email, 0, 3);
                    $rand = rand(10000, 99999);
                    $newPassword = "$text$rand";
                    $password = md5($newPassword);
                    $updateQuery = "update tbl_user  set password = '$password' where id = '$userid' ";
                    $updatePassword = $db->update($updateQuery);
                    $to = $email;
                    $from = "emucsejust@gmail.com";
                    $headers ="From: $from\n";
                    $headers .= 'MIME-Version: 1.0';
                    $headers .= 'Content-type: text/html; charset=iso-8859-1';
                    $subject = "Your password";
                    $message = "Your Username is ".$userName." and password is ".$newPassword." Please visit our Website to login. ";
                    $sendMail = mail($to, $subject, $message, $headers);
                    if($sendMail){
                        echo "<span style='color:green; font-size:18px;'>Please send Email  for new password .</span>" ;
                    }else{
                        echo "<span style='color:red; font-size:18px;'>Email send fail for new password !! .</span>" ; 
                    }
    
                }
                .else{
                   echo "<span style='color:red; font-size:18px;'>Email Address not Found !! .</span>" ;
                }
            }

		  }
		?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Enter Email Address ..." required="" name="email"/>
			</div>

			<div>
				<input type="submit" value="Send Email" />
			</div>
		</form><!-- form -->
		<div class="button" style="color:green">
			<a href="login.php">Login </a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->	
	</section><!-- content -->
</div><!-- container -->
</body>
</html>