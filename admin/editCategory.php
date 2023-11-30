<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
 <?php
    if(!isset($_GET['categoryId'])){
        header('location:catlist.php');
    }else{
        $categoryId = $_GET['categoryId'];
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
               <?php
		  if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
			 $name = mysqli_real_escape_string($db->link, $name);

             if(empty($name)){
                echo "<span class='error'>Field must not be empty.</span>";
             }else{
                $query = "update tbl_category  set name = '$name' where id = '$categoryId' ";
                $categoryUpdate = $db->update($query);
                if($categoryUpdate){
                    echo "<span class='success'>Category updated Successfully.</span>";
                }else{
                    echo "<span class='error'>Category Not updated.</span>";
                }
             }
          }  
          ?>
          <?php
            $query = "select * from tbl_category where id = '$categoryId' order by id desc ";
            $category = $db->select($query);
            while($result = $category->fetch_assoc()){   ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?=$result['name'] ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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