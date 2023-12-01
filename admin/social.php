<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <?php
                    $query = "select * from tbl_social where id = '1' ";
                    $socialLink = $db->select($query);
                    $social = $socialLink->fetch_assoc()  ?>
                <div class="block">      
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $fb = $fm->validation($_POST['fb']);
                        $tw = $fm->validation($_POST['tw']);  
                        $ln = $fm->validation($_POST['ln']);  
                        $gp = $fm->validation($_POST['gp']);  
                                               
                        $fb = mysqli_real_escape_string($db->link, $fb);
                        $tw = mysqli_real_escape_string($db->link, $tw);
                        $ln = mysqli_real_escape_string($db->link, $ln);
                        $gp = mysqli_real_escape_string($db->link, $gp);

                        if ($fb == '' ||  $tw == ''||  $tw == ''||  $tw == '') {
                            echo "<span class='error'>Field must not be empty.</span>";
                        } else {
                            $query = "update tbl_social set fb = '$fb', tw = '$tw', ln = '$ln', gp = '$gp' where id ='1' ";
                            $updated_rows = $db->update($query);
                            if ($updated_rows) {
                                echo "<span class='success'>Social Address Updated Successfully. </span>";
                            } else {
                                echo "<span class='error'>Social Address Not Updated !</span>";
                            }
                    }
                }
                  ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?=$social['fb'] ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?=$social['tw'] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?=$social['ln'] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?=$social['gp'] ?>"" class="medium" />
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
                    
                </div>
            </div>
        </div>
<?php
  require_once "inc/footer.php";
 ?>
