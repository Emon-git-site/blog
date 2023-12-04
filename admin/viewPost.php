<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
    <?php
       if(isset($_GET['viewPostId'])){
        $postId = $_GET['viewPostId'];
       }else{
        header('location:postlist.php');
       }
     ?>
        <div class="grid_10">	
            <div class="box round first grid">
                <h2>User Data</h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo '<script>window.location.href = "postlist.php";</script>';
            }
            ?>
            <?php
                // post data show
                $query = "select * from tbl_post where id = '$postId' ";
                $post = $db->select($query);
                if($post){
                    while($result = $post->fetch_assoc()){  ?>
                  <form action="" method="POST" enctype="multipart/form-data">
                     <table class="form">         
                         <tr>
                             <td>
                                 <label>Title</label>
                             </td>
                             <td>
                                 <input type="text" name="title" value="<?=$result['title'] ?>" class="medium" />
                             </td>
                         </tr>
                      
                         <tr>
                             <td>
                                 <label>Category</label>
                             </td>
                             <td>
                                 <select id="select" name="cat">
                                     <option value="">Select Category</option>
                                 <?php
                                     $query = "select * from tbl_category";
                                     $category = $db->select($query);
                                     if($category){
                                         while($resultCategory = $category->fetch_assoc()){ ?>
                                          <option 
                                          <?php
                                           if($result['cat'] == $resultCategory['id'] ) { ?>
                                             selected  <?php  }  ?>
                                          value="<?=$resultCategory['id'] ?>"><?=$resultCategory['name'] ?></option>
                               <?php          }
                                     }
                                 ?>
 
                                 </select>
                             </td>
                         </tr>
 
                         <tr>
                             <td>
                                 <label>Upload Image</label>
                             </td>
                             <td>
                             <img src="upload/<?=$result['image']?>" height="40px" width="60px">
                                 <input type="file" />
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top; padding-top: 9px;">
                                 <label>Content</label>
                             </td>
                             <td>
                                 <textarea class="tinymce" ><?=$result['body'] ?></textarea>
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Tags</label>
                             </td>
                             <td>
                                 <input type="text"  value="<?=$result['tags'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Author</label>
                             </td>
                             <td>
                                 <input type="text"  value="<?=$result['author'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td></td>
                             <td>
                                 <input type="submit" name="submit" Value="Ok" />
                             </td>
                         </tr>
                     </table>
                     </form>
                     <?php    }    }   ?>
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
