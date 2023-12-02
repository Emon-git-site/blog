<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
  <?php
    if(!isset($_GET['pageId'])){
        header('location:index.php');
    }else{
        $pageId = $_GET['pageId'];
    }
 ?>
 <style>
    .actionDelete{
    border: 1px solid #ddd;
    color: #444;
    cursor: pointer;
    font-size: 20px;
    padding: 2px 10px;   
    font-weight: normal;
    }
 </style>
        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Edit Page</h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);
                if($body == '' ||  $name == ''){
                    echo "<span class='error'>Field must not be empty.</span>";
                }
                  else{
                    $query = "update tbl_page  set name = '$name', body = '$body' where id = '$pageId' ";
                    $pageUpdate = $db->update($query);
                    if($pageUpdate){
                        echo "<span class='success'>Page updated Successfully.</span>";
                    }else{
                        echo "<span class='error'>Page Not updated.</span>";
                    }
            }
        }
            ?>
         <?php
            $query = "select * from tbl_page where id='$pageId' ";
            $pages = $db->select($query);
            if($pages){
                while($page =$pages->fetch_assoc()){ ?>
                  <form action="" method="POST" >
                     <table class="form">         
                         <tr>
                             <td>
                                 <label>Name</label>
                             </td>
                             <td>
                                 <input type="text" name="name" value="<?=$page['name']?>" class="medium" />
                             </td>
                         </tr>

                         <tr>
                             <td style="vertical-align: top; padding-top: 9px;">
                                 <label>Content</label>
                             </td>
                             <td>
                                 <textarea class="tinymce" name="body"><?=$page['body']?></textarea>
                             </td>
                         </tr>

                         <tr>
                             <td></td>
                             <td>
                                 <input type="submit" name="submit" Value="Update" />
                                 <span class="actionDelete"><a href="deletePage.php?actionPageId=<?=$page['id']?>" onclick="return confirm('Are you sure to Delete')">Delete</a></span>
                             </td>
                         </tr>
                     </table>
                     </form>
                     <?php  } } ?>
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
