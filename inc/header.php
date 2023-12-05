<?php
require_once "lib/Database.php";
require_once "helpers/format.php";

$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	 <?php require_once "scripts/meta.php"; ?>
	 <?php require_once "scripts/css.php"; ?>
	 <?php require_once "scripts/js.php"; ?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
				<?php
				  $query = "select * from tbl_slogan where id = '1'";
				  $getLogo = $db->select($query);
				  if($getLogo){
					$findLogo = $getLogo->fetch_assoc();
				  }
				?>
				<img src="admin/upload/<?=$findLogo['logo']?>" alt="Logo" width="40px" height="60px"/>
				<h2><?=$findLogo['title']?></h2>
				<p><?=$findLogo['slogan']?></p>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
			      <?php
                    $query = "select * from tbl_social where id = '1' ";
                    $socialLink = $db->select($query);
                    $social = $socialLink->fetch_assoc()  ?>
				<a href="<?=$social['fb']?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?=$social['tw']?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?=$social['ln']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?=$social['gp']?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<div class="searchbtn clear">
			<form action="" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
<?php
	$path = $_SERVER['SCRIPT_FILENAME'];
	$currentPageName = basename($path, '.php');
?>
	<ul>
		<li><a	
		<?php
		  if($currentPageName == 'index'){
			echo 'id = "active" ';  } ?>
		href="index.php">Home</a></li>
		<?php   
            $query = "select * from tbl_page ";
            $pages = $db->select($query);
            if($pages){
                while($result =$pages->fetch_assoc()){ ?>
                    <li><a 
					<?php
						if(isset($_GET['pageId']) && $_GET['pageId']  == $result['id']){
							echo 'id = "active" ';
						}?>
					href="page.php?pageId=<?=$result['id']?>"><?=$result['name']?></a> </li>
         <?php    }   }  ?>
		<li><a
		<?php
		  if($currentPageName == 'contact'){
			echo 'id = "active" '; } ?>
		href="contact.php">Contact</a></li>
	</ul>
</div>