<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
 <?php
$userId = Session::get('userId');
$userRole = Session::get('userRole');
 ?>
        <div class="grid_10">	
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $username = mysqli_real_escape_string($db->link, $_POST['username']);
                $email = mysqli_real_escape_string($db->link, $_POST['email']);
                $details = mysqli_real_escape_string($db->link, $_POST['details']);

                $query = "update tbl_user set name = '$name', username = '$username', email = '$email', details = '$details' where id ='$userId ' ";
                $userDataUpdate = $db->update($query);
                if ($userDataUpdate) {
                    echo "<span class='success'>User Data  Updated Successfully. </span>";
                }
                else {
                    echo "<span class='error'>User Data Not Updated !</span>";
                }
             }
            ?>
            <?php
                // post data show
                $query = "select * from tbl_user where id = '$userId' and role = '$userRole' ";
                $userData = $db->select($query);
                if($userData){
                    $result = $userData->fetch_assoc() ?>
                  <form action="" method="POST">
                     <table class="form">         
                         <tr>
                             <td>
                                 <label>Name</label>
                             </td>
                             <td>
                                 <input type="text" name="name" value="<?=$result['name'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>User Name</label>
                             </td>
                             <td>
                                 <input type="text" name="username" value="<?=$result['username'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Email</label>
                             </td>
                             <td>
                                 <input type="text" name="email" value="<?=$result['email'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Details</label>
                             </td>
                             <td>
                             <textarea class="tinymce"  type="text" name="details"><?=$result['details'] ?></textarea>
                             </td>
                         </tr>
                         <tr>
                             <td></td>
                             <td>
                                 <input type="submit" name="submit" Value="Update" />
                             </td>
                         </tr>
                     </table>
                     </form>
                     <?php        }   ?>
                </div>
            </div>
        </div>
        
            <!-- Load TinyMCE -->
            <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    setupTinyMCE();
                    setDatePicker('date-picker');
                    $('input[type="checkbox"]').fancybutton();
                    $('input[type="radio"]').fancybutton();
                });
            </script>
                <!-- Load TinyMCE -->
 <?php
  require_once "inc/footer.php";
 ?>
