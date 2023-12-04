<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <div class="block">   
				<?php
				if(isset($_GET['deleteUserId'])){
					$deleteUserId = $_GET['deleteUserId'];
					$deleteQuery = "delete from tbl_user where id = '$deleteUserId'";
					$deleteData = $db->delete($deleteQuery);
					if($deleteData){
						echo "<span class='success'>User Data Deleted Successfully.</span>";
					}else{
						echo "<span class='error'>User Data Fail to  Delete.</span>";
					}
				}
				?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					  $query = "select * from tbl_user order by id desc ";
					  $allUser =  $db->select($query);
					  if($allUser){
						$serial = 0;
						while($result = $allUser->fetch_assoc()){
							$serial++;  ?>
						<tr class="odd gradeX">
							<td><?=$serial; ?></td>
							<td><?=$result['name']; ?></td>
							<td><?=$result['username']; ?></td>
							<td><?=$result['email']; ?></td>
							<td><?=$fm->textShorten($result['details'], 30);?></td>
							<td><?php
                             $userRole = $result['role']; 
                             switch($userRole){
                                case '0':
                                    echo "Admin";
                                    break;
                                case '1':
                                    echo "Author";
                                    break;
                                case '2':
                                    echo 'Editor';
                                    break;
                             }
                            ?>
                            </td>
							<td><a href="viewUser.php?userId=<?=$result['id']; ?>">View</a>
                            <?php
                                $userRole = Session::get('userRole');
                                if($userRole == 0){ ?>
                             || <a onclick="return confirm('Are you want to delete the user?')" href="?deleteUserId=<?=$result['id']; ?>">Delete</a></td>
							<?php } }  } ?>
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