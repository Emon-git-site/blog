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
                <h2>Reply Message</h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $to = $fm->validation($_POST['toEmail']);
                $from = $fm->validation($_POST['fromEmail']);
                $subject = $fm->validation($_POST['subject']);
                $message = $fm->validation($_POST['message']);

                $sendMail = mail($to, $subject, $message, $from);
                if($sendMail){
                    echo "<span class='success'>Message Sent Successfully.</span>";
                }else{
                    echo "<span class='error'>Something went Wrong.</span>";
                }
        }   ?>
<?php
$query = "select * from tbl_contact where id ='$messageId' ";
$message =  $db->select($query);
if($message){
$result = $message->fetch_assoc() ?>

                  <form action="" method="POST">
                     <table class="form">         
                         <tr>
                             <td>
                                 <label>TO</label>
                             </td>
                             <td>
                                 <input type="email" name="toEmail" value="<?=$result['email']?>" class="medium" readonly/>
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>From</label>
                             </td>
                             <td>
                                 <input type="email" name="fromEmail" placeholder="Please Enter your Email Address" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Subject</label>
                             </td>
                             <td>
                                 <input type="text" name="subject" placeholder="Please Enter your subject " class="medium" />
                             </td>
                         </tr>

                         <tr>
                             <td>
                                 <label>Message</label>
                             </td>
                             <td>
                                 <textarea class="tinymce" name="message"><?=$result['body']?></textarea>
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
  