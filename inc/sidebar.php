 <div class="sidebar clear">
 	<div class="samesidebar clear">
 		<h2>Categories</h2>
 		<ul>
 			<?php
				$query = "select * from tbl_category ";
				$category = $db->select($query);
				if ($category) {
					while ($result = $category->fetch_assoc()) { ?>
 					<li><a href="posts.php?category=<?= $result['id'] ?>"><?= $result['name'] ?></a></li>
 				<?php }
				} else { ?>
 				<li>NO Created </li>
 			<?php	}  ?>
 		</ul>
 	</div>

 	<div class="samesidebar clear">
 		<h2>Latest articles</h2>
		 <?php
				 $query = "select * from tbl_post limit 4 ";
				 $post = $db->select($query);
				 if($post){
					 while ($result = $post->fetch_assoc()){ ?> 
 		<div class="popular clear">
 			<h3><a href="post.php?id=<?=$result['id'] ?>"><?=$result['title'] ?></a></h3>
 			<a href="post.php?id=<?=$result['id'] ?>"><img src="admin/upload/<?=$result['image'] ?>" alt="post image" /></a>
			 <?=$fm->textShorten($result['body'], 120 ); ?>
 		</div>
		 <?php }
        } else {
            header("location: 404.php");
        } ?>

 	</div>

 </div>