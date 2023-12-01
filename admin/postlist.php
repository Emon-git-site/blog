<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						  $query = "select tbl_post.*, tbl_category.name from tbl_post inner join tbl_category on tbl_post.cat = tbl_category.id order by tbl_post.title DESC";
						  $post = $db->select($query);
						  if($post){
							$serial = 0;
							while($result = $post->fetch_assoc()){ 
								$serial++ ?>

					
						<tr class="odd gradeX">
							<td><?=$serial ?></td>
							<td><a href="editpost.php?editPostId=<?=$result['id'] ?>"><?=$result['title'] ?></a></td>
							<td><?=$fm->textShorten($result['body'], 60) ?></td>
							<td><?=$result['name'] ?></td>
							<td><img src="upload/<?=$result['image'] ?>" height="40px" width="60px"></td>
							<td><?=$result['author'] ?></td>
							<td><?=$result['tags'] ?></td>
							<td><?=$fm->formatDate($result['date']) ?></td>
							<td><a href="editpost.php?editPostId=<?=$result['id'] ?>">Edit</a> || <a href="deletePost.php?deletePostId=<?=$result['id'] ?>" onclick="return confirm('Are you sure want to delete?') ">Delete</a></td>
						</tr>
							
			<?php	}
						  }	?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>

	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
<?php
  require_once "inc/footer.php";
 ?>