<?php
require_once "lib/Database.php";
require_once "helpers/format.php";

$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	<?php

	 if(isset($_GET['pageId'])){
	$pageId = $_GET['pageId'];
	 $query = "select * from tbl_page where id='$pageId' ";
	 $pages = $db->select($query);
	 if($pages){
		 while($result =$pages->fetch_assoc()){ ?>
		 	<title><?= $result['name'];?>-<?= TITLE;?></title>
	<?php	  } }  } 
	
	elseif(isset($_GET['id'])){
	$postId = $_GET['id'];
	 $query = "select * from tbl_post where id='$postId' ";
	 $post = $db->select($query);
	 if($post){
		 while($result =$post->fetch_assoc()){ ?>
		 	<title><?= $result['title'];?>-<?= TITLE;?></title>
	<?php	  } }  } 

	else{ ?>
		<title><?=$fm->title();?>-<?= TITLE;?></title>
		<?php }  ?>
	<title><?= TITLE;?></title>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php
	  if(isset($_GET['id'])){
		$keywordId = $_GET['id'];
		$query = "select * from tbl_post where id='$keywordId' ";
		$keyword = $db->select($query);
		if($keyword){
			while($result = $keyword->fetch_assoc()){ ?>
			<meta name="keywords" content="<?=$result['tags'];?>">
	<?php  } }  else{ ?>
		<meta name="keywords" content="<?=KEYWORDS?>"> 
	<?php }  } ?>
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
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