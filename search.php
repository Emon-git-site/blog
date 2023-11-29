<?php
require_once "inc/header.php";
?>
<?php
if(!isset($_GET['search'])){
	header('location: 404.php');
}else{
	$search = $_GET['search'];
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
				<?php
				 $query = "select * from tbl_post where title like '%$search%' or body like '%$search%' ";
				 $post = $db->select($query);
				 if($post){
					 while ($result = $post->fetch_assoc()){ ?> 
				
                <div class="samepost clear">
                    <h2><a href="post.php?id=<?= $result['id'] ?>"><?= $result['title'] ?></a></h2>
                    <h4><?= $fm->formatDate($result['date']); ?>, By <a href="#"><?= $result['author'] ?></a></h4>
                    <a href="#"><img src="admin/upload/<?= $result['image'] ?>" alt="post image" /></a>
                    <?= $fm->textShorten($result['body'], 200); ?>
                    <div class="readmore clear">
                        <a href="post.php?id=<?= $result['id'] ?>">Read More</a>
                    </div>
                </div>

				<?php }	} else {  ?>
                    <p>Your Search Query Not Found  !! </p>
                    <?php } ?>

	  </div>
	</div>
<?php
 require_once "inc/sidebar.php";
 require_once "inc/footer.php";
?>