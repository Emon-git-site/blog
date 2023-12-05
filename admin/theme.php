<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Theme</h2>
               <div class="block copyblock"> 
               <?php
		  if($_SERVER['REQUEST_METHOD'] == 'POST'){
			 $theme = mysqli_real_escape_string($db->link, $_POST['theme']);


                $query = "update tbl_theme  set theme = '$theme' where id = '1' ";
                $themeUpdate = $db->update($query);
                if($themeUpdate){
                    echo "<span class='success'>Theme updated Successfully.</span>";
                }else{
                    echo "<span class='error'>Theme Not updated.</span>";
                }
             } 
          ?> 
          <?php
            $query = "select * from tbl_theme where id = '1'";
            $theme = $db->select($query);
            while($result = $theme->fetch_assoc()){  
         ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if($result['theme'] == 'default'){echo "checked";} ?> type="radio" name="theme" value="default">Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if($result['theme'] == 'green'){echo "checked";} ?> type="radio" name="theme" value="green">Green
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php
  require_once "inc/footer.php";
 ?> 