<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					  $query = "select * from tbl_category order by id desc ";
					  $category =  $db->select($query);
					  if($category){
						$serial = 0;
						while($result = $category->fetch_assoc()){
							$serial++;  ?>
						<tr class="odd gradeX">
							<td><?=$serial; ?></td>
							<td><?=$result['name']; ?></td>
							<td><a href="editCategory.php?categoryId=<?=$result['id']; ?>">Edit</a> || <a onclick="return confirm('Are you want to delete the category?')" href="deleteCategory.php?categoryId=<?=$result['id']; ?>">Delete</a></td>
							<?php  }  } ?>
						</tr>
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