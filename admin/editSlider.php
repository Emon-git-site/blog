<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
 <?php
    if(!isset($_GET['editSliderId'])){
        header('location:sliderList.php');
    }else{
        $sliderId = $_GET['editSliderId'];
    }
 ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Slider <span style="float: right;"><a href="sliderList.php" style="border: 1px solid green;" >back</a></span></h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $title = mysqli_real_escape_string($db->link, $_POST['title']);
                $alt = mysqli_real_escape_string($db->link, $_POST['alt']);

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
            
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $uploaded_image = substr(md5(time()), 0, 10).'.'.$file_ext;

                if($title == ''){
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

                            move_uploaded_file($file_temp, "upload/slider/".$uploaded_image);
                            $query = "update tbl_slider set  title = '$title', image = '$uploaded_image', alt = '$alt' where id ='$sliderId ' ";
                            $updated_rows = $db->update($query);
                            if ($updated_rows) {
                                echo "<span class='success'>Slider Updated Successfully. </span>";
                            }
                            else {
                                echo "<span class='error'>Slider Not Updated !</span>";
                            }
                    }
             }else{
                $query = "update tbl_slider set  title = '$title', alt = '$alt' where id ='$sliderId ' ";
                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Slider Updated Successfully. </span>";
                }
                else {
                    echo "<span class='error'>Slider Not Updated !</span>";
                }
             }
            }
        }
            ?>
            <?php
                // post data show
                $query = "select * from tbl_slider where id = '$sliderId' ";
                $slider = $db->select($query);
                if($slider){
                    while($result = $slider->fetch_assoc()){  ?>
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
                                 <label>Alt</label>
                             </td>
                             <td>
                                 <input type="text" name="alt" value="<?=$result['alt'] ?>" class="medium" />
                             </td>
                         </tr>
 
                         <tr>
                             <td>
                                 <label>Upload Image</label>
                             </td>
                             <td>
                             <img src="upload/slider/<?=$result['image']?>" height="40px" width="60px">
                                 <input type="file" name="image"/>
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
