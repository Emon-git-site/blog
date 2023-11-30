<?php
require_once "inc/header.php";
require_once "inc/slider.php";
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<!-- pagination -->
		<?php
		$perPage = 3;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$startForm = ($page - 1) * $perPage;
		?>
		<!-- pagination -->
		<?php
		$query =  "select * from tbl_post limit $startForm, $perPage";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc()) { ?>
				<div class="samepost clear">
					<h2>
						<a href="post.php?id=<?= $result['id'] ?>"><?= $result['title'] ?></a>
					</h2>
					<h4>
						<?= $fm->formatDate($result['date']); ?>, By <a href="#"><?= $result['author'] ?></a>
					</h4>
					<a href="#">
						<img src="admin/upload/<?= $result['image'] ?>" alt="post image" height="150px">
					</a>
			
					<?= $fm->textShorten($result['body'], 200); ?>
					<div class="readmore clear">
						<a href="post.php?id=<?= $result['id'] ?>">Read More</a>
					</div>
				</div>
			<?php } ?> <!-- end while loop -->
			<!-- pagination start -->
			<?php
			$query = "select * from tbl_post";
			$result = $db->select($query);
			$totalRows = mysqli_num_rows($result);
			$totalPages = ceil($totalRows / $perPage);
			echo '<span class="pagination"><a href="index.php?page=1">' . 'First Page, ' . '</a>';
			for ($i = 2; $i < $totalPages; $i++) {
				echo "<a href='index.php?page=" . $i . " '>" . $i . ",</a>";
			}
			echo "<a href='index.php?page=" . $totalPages . " '>" . ' Last Page' . "</a></span>" ?>
			<!-- pagination  end -->
		<?php 	} else {
			header("location: 404.php");
		} ?>

	</div>

<?php
require_once "inc/sidebar.php";
require_once "inc/footer.php";
?>