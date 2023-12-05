<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
    <?php
       if(isset($_GET['userId'])){
        $userId = $_GET['userId'];
       }else{
        header('location:userlist.php');
       }
     ?>
        <div class="grid_10">	
            <div class="box round first grid">
                <h2>User Data</h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo '<script>window.location.href = "userlist.php";</script>';
            }
            ?>
            <?php
                // post data show
                $query = "select * from tbl_user where id = '$userId'  ";
                $userDetails = $db->select($query);
                if($userDetails){
                    $result = $userDetails->fetch_assoc() ?>
                  <form action="" method="POST">
                     <table class="form">         
                         <tr>
                             <td>
                                 <label>Name</label>
                             </td>
                             <td>
                                 <input type="text" value="<?=$result['name'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>User Name</label>
                             </td>
                             <td>
                                 <input type="text" readonly value="<?=$result['username'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Email</label>
                             </td>
                             <td>
                                 <input type="text" readonly value="<?=$result['email'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Details</label>
                             </td>
                             <td>
                             <textarea class="tinymce"  type="text" readonly><?=$result['details'] ?></textarea>
                             </td>
                         </tr>
                         <tr>
                             <td></td>
                             <td>
                                 <input type="submit" name="submit" Value="ok" />
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
