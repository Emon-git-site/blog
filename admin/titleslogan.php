<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";
?>

<style>
    .leftside {
        float: left;
        width: 70%;
    }

    .rightside {
        float: right;
        width: 20%;
    }

    .rightside img {
        height: 160px;
        width: 170px;
    }
</style>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">


        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $fm->validation($_POST['title']);
    $slogan = $fm->validation($_POST['slogan']);

    $title = mysqli_real_escape_string($db->link, $title);
    $slogan = mysqli_real_escape_string($db->link, $slogan);

    $permited = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $sameLogo = 'log' . '.' . $file_ext;

    if ($title == '' ||  $slogan == '') {
        echo "<span class='error'>Field must not be empty.</span>";
    } else {
        if (!empty($file_name)) {
            if ($file_size > 1048567) {
                echo "<span class='error'>Logo Size should be less than 1MB!</span>";
            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
            } else {
                move_uploaded_file($file_temp, "upload/".$sameLogo);
                $query = "update tbl_slogan set title = '$title', logo = '$sameLogo', slogan = '$slogan' where id ='1' ";
                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Slogan&Title Updated Successfully. </span>";
                } else {
                    echo "<span class='error'>Slogan&Title Not Updated !</span>";
                }
            }
        } else {
            move_uploaded_file($file_temp, "upload/".$sameLogo);
            $query = "update tbl_slogan set title = '$title', logo = '$sameLogo', slogan = '$slogan' where id ='1' ";
            $updated_rows = $db->update($query);
            if ($updated_rows) {
                echo "<span class='success'>Slogan&Title Updated Successfully. </span>";
            } else {
                echo "<span class='error'>Slogan&Title Not Updated !</span>";
            }
        }
    }
}
?>
            <?php
            $query = "select * from tbl_slogan where id = '1' ";
            $blogTitle = $db->select($query);
            if ($blogTitle && $result = $blogTitle->fetch_assoc()) { ?>
                <div class="leftsite">
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?= $result['title'] ?>" name="title" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?= $result['slogan'] ?>" name="slogan" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Logo</label>
                                </td>
                                <td>
                                    <input type="file" name="logo" />
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
                <div class="rightside">
                    <?php
                    // Check if 'logo' key exists in $result before accessing it
                    if (isset($result['logo'])) {
                        echo "<img src='upload/{$result['logo']}' alt='logo'>";
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "<span class='error'>No data found!</span>";
            }
            ?>
        </div>
    </div>
</div>

<?php
require_once "inc/footer.php";
?>
