<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
 <?php
 if(Session::get('userRole') != 0){
    echo '<script>window.location.href = "index.php";</script>';

 }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
     <?php
		  if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = $fm->validation($_POST['username']);
            $password = $fm->validation($_POST['password']);
            $email = $fm->validation($_POST['email']);
            $role = $fm->validation($_POST['role']);

			 $userName = mysqli_real_escape_string($db->link, $userName);
			 $password = mysqli_real_escape_string($db->link, $password);
			 $email = mysqli_real_escape_string($db->link, $email);
			 $role = mysqli_real_escape_string($db->link, $role);

             if(empty($userName) || empty($password) || empty($role) || empty($email) ){
                echo "<span class='error'>Field must not be empty.</span>";
             }else{

                 $emailQuery = "select * from tbl_user where email = '$email' limit 1 ";
                 $ceheckEmail =  $db->select($emailQuery);
                 if($ceheckEmail == true){
                    echo "<span class='error'>Your provided email already exit.</span>";
                 }else{

                    $query = "insert into tbl_user(username, password, role, email) values ('$userName', '$password', '$role', '$email')";
                    $addUser = $db->insert($query);
                    if($addUser){
                        echo "<span class='success'>New User Create Successfully.</span>";
                    }else{
                        echo "<span class='error'>New User Create Fialed.</span>";
                    }
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
                                <label for="">Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" placeholder="Enter valid Email..." class="medium" />
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