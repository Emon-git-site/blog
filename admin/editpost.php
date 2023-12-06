<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
 <?php
   $postId = mysqli_real_escape_string($db->link, $_GET['editPostId']);
    if(!isset($postId)){
        header('location:postlist.php');
    }
 ?>

        <div class="grid_10">
		
            <div class="box round first grid">
            <h2>Update Slider <span style="float: right;"><a href="postlist.php" style="border: 1px solid green;" >back</a></span></h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $title = mysqli_real_escape_string($db->link, $_POST['title']);
                $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);
                $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);
                $userId = $_POST['userId'];

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
            
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $uploaded_image = substr(md5(time()), 0, 10).'.'.$file_ext;

                if($title == '' ||  $cat == '' ||  $body == '' ||  $tags == '' ||  $author == '' ){
                    echo "<span class='error'>Field must not be empty.</span>";
                }else{
                if(!empty($file_name)){
                    if ($file_size >1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!</span>";
                    } 
                    elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-" .implode(', ', $permited)."</span>";
                    }
                        else{

                            move_uploaded_file($file_temp, "upload/".$uploaded_image);
                            $query = "update tbl_post set cat = '$cat', title = '$title', body = '$body', image = '$uploaded_image', author = '$author', tags = '$tags', user_id = '$userId' where id ='$postId ' ";
                            $updated_rows = $db->update($query);
                            if ($updated_rows) {
                                echo "<span class='success'>Post Updated Successfully. </span>";
                            }
                            else {
                                echo "<span class='error'>Post Not Updated !</span>";
                            }
                    }
             }else{
                $query = "update tbl_post set cat = '$cat', title = '$title', body = '$body', author = '$author', tags = '$tags', user_id = '$userId' where id ='$postId ' ";
                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Post Updated Successfully. </span>";
                }
                else {
                    echo "<span class='error'>Post Not Updated !</span>";
                }
             }
            }
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
                                 <input type="file" name="image"/>
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top; padding-top: 9px;">
                                 <label>Content</label>
                             </td>
                             <td>
                                 <textarea class="tinymce" name="body"><?=$result['body'] ?></textarea>
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Tags</label>
                             </td>
                             <td>
                                 <input type="text" name="tags" value="<?=$result['tags'] ?>" class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>Author</label>
                             </td>
                             <td>
                                 <input type="text" name="author" value="<?=$result['author'] ?>" class="medium" />
                                 <input type="hidden" name="userId" value="<?=Session::get('userId') ?>" class="medium" />
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
