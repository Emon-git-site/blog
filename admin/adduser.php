<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
               <?php
		  if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = $fm->validation($_POST['username']);
            $password = $fm->validation($_POST['password']);
            $role = $fm->validation($_POST['role']);

			 $userName = mysqli_real_escape_string($db->link, $userName);
			 $password = mysqli_real_escape_string($db->link, $password);
			 $role = mysqli_real_escape_string($db->link, $role);

             if(empty($userName) || empty($password) || empty($role)){
                echo "<span class='error'>Field must not be empty.</span>";
             }else{
                $query = "insert into tbl_user(username, password, role) values ('$userName', '$password', '$role')";
                $addUser = $db->insert($query);
                if($addUser){
                    echo "<span class='success'>New User Create Successfully.</span>";
                }else{
                    echo "<span class='error'>New User Create Fialed.</span>";
                }
             }
          }  
          ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label for="">Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Password</label>
                            </td>
                            <td>
                                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">User Role</label>
                            </td>
                            <td>
                               <select name="role" id="select">
                                <option value="">Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                               </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php
  require_once "inc/footer.php";
 ?>