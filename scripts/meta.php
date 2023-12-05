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