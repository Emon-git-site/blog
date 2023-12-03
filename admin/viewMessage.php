<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
      <?php
       if(isset($_GET['messageId'])){
        $messageId = $_GET['messageId'];
       }else{
        header('location:inbox.php');
       }
     ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<script>window.location = 'inbox.php';</script>";
        }   ?>
<?php
$query = "select * from tbl_contact where id ='$messageId' ";
$message =  $db->select($query);
if($message){
$result = $message->fetch_assoc() ?>

                  <form action="" method="POST" >
                     <table class="form">         
                         <tr>
                             <td>
                                 <label>First Name</label>
                             </td>
                             <td>
                                 <input type="text" value="<?=$result['firstname']?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Last Name</label>
                             </td>
                             <td>
                                 <input type="text" value="<?=$result['lastname']?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Email</label>
                             </td>
                             <td>
                                 <input type="email" value="<?=$result['email']?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Date</label>
                             </td>
                             <td>
                                 <input type="text" value="<?=$fm->formatDate($result['date']) ?>" class="medium" />
                             </td>
                         </tr>

                         <tr>
                             <td>
                                 <label>Message</label>
                             </td>
                             <td>
                                 <textarea class="tinymce" ><?=$result['body']?></textarea>
                             </td>
                         </tr>

                         <tr>
                             <td></td>
                             <td>
                                 <input type="submit" name="submit" Value="OK" />
                             </td>
                         </tr>
                     </table>
                     </form>
                     <?php  }  ?>
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
  