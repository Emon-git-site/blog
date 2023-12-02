<?php
require_once "inc/header.php";
?>
  <?php
    if(!isset($_GET['pageId'])){
        header('location:404.php');
    }else{
        $pageId = $_GET['pageId'];
    }
 ?>
<?php
$query = "select * from tbl_page where id='$pageId' ";
$pages = $db->select($query);
if($pages){
	while($page =$pages->fetch_assoc()){ ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?=$page['name']?></h2>
				<?=$page['body']?>
	        </div>

		</div>
		<?php  } }else{header('location:404.php'); } ?>
<?php
 require_once "inc/sidebar.php";
 require_once "inc/footer.php";
?>