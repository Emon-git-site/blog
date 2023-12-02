<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $copyright = $fm->validation($_POST['copyright']);                    
                        $copyright = mysqli_real_escape_string($db->link, $copyright);
                        if ($copyright == '') {
                            echo "<span class='error'>Field must not be empty.</span>";
                        } else {
                            $query = "update tbl_copyright set note = '$copyright' where id ='1' ";
                            $updated_rows = $db->update($query);
                            if ($updated_rows) {
                                echo "<span class='success'>Copyright Updated Successfully. </span>";
                            } else {
                                echo "<span class='error'>Copyright Content Not Updated !</span>";
                            }
                    }
                }
                 ?>         
                 <?php
                    $query = "select * from tbl_copyright where id = '1' ";
                    $copyrightLink = $db->select($query);
                    $copyright = $copyrightLink->fetch_assoc()  ?>      
                <div class="block copyblock">    
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?=$copyright['note']?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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
