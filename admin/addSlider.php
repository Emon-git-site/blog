<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Slider</h2>
                <div class="block">   
             <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $title = mysqli_real_escape_string($db->link, $_POST['title']);
                $alt = mysqli_real_escape_string($db->link, $_POST['alt']);


                $permited  = array('jpg');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
            
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $uploaded_image = substr(md5(time()), 0, 10).'.'.$file_ext;

                if($title == '' || $file_name == '' ){
                    echo "<span class='error'>Field must not be empty.</span>";
                }
                elseif ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                   } 
                   elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-" .implode(', ', $permited)."</span>";
                   }
                    else{
                        move_uploaded_file($file_temp, "upload/slider/".$uploaded_image);
                        $query = "INSERT INTO tbl_slider(title, image, alt)  VALUES('$title', '$uploaded_image', '$alt')";
                        $inserted_rows = $db->insert($query);
                        if ($inserted_rows) {
                            echo "<span class='success'>Slider  Inserted Successfully. </span>";
                        }
                        else {
                            echo "<span class='error'>Slider Not Inserted !</span>";
                        }
            }
        }
            ?>
                  <form action="" method="POST" enctype="multipart/form-data">
                     <table class="form">         
                         <tr>
                             <td>
                                 <label>Title</label>
                             </td>
                             <td>
                                 <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <label>ALT</label>
                             </td>
                             <td>
                                 <input type="text" name="alt" placeholder="Enter imgage alt tag name..." class="medium" />
                             </td>
                         </tr>
 
                         <tr>
                             <td>
                                 <label>Slider Image</label>
                             </td>
                             <td>
                                 <input type="file" name="image"/>
                             </td>
                         </tr>
                         <tr>
                             <td></td>
                             <td>
                                 <input type="submit" name="submit" Value="Save" />
                             </td>
                         </tr>
                     </table>
                     </form>
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
