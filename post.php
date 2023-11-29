<?php
require_once "inc/header.php";
?>
<?php
if(!isset($_GET['id'])){
	header('location: 404.php');
}else{
	$id = $_GET['id'];
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
				 $query = "select * from tbl_post where id = $id";
				 $post = $db->select($query);
				 if($post){
					 while ($result = $post->fetch_assoc()){ ?> 
				
				<h2><?=$result['title'] ?></h2>
				<h4><?=$fm->formatDate($result['date'] ); ?>, By <a href="#"><?=$result['author'] ?></a></h4>			
					<img src="admin/upload/<?=$result['image'] ?>" alt="post image"/>		
					<?=$result['body'] ?>		
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
					 $categoryId = $result['cat'];
					//  var_dump($categoryId);
					//  exit();
					 $query = "select * from tbl_post where cat = '$categoryId' order by rand() limit 6";
					 $relatedPost = $db->select($query);
					 if($relatedPost){
						 while ($relatedResult = $relatedPost->fetch_assoc()){ 	?>
					<a href="post.php?id=<?=$relatedResult['id'] ?>">
					  <img src="admin/upload/<?=$relatedResult['image'] ?>" alt="post image"/>
				    </a>
					 <?php } }else{  echo "No Related Post Available" ;} ?>
				</div>
				<?php }	} else { header("location: 404.php");} ?>

	</div>

		</div>
<?php
 require_once "inc/sidebar.php";
 require_once "inc/footer.php";
?>