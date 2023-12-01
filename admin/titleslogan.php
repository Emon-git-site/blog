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
            $query = "select  * from tbl_slogan where id = '1' ";
            $blogTitle = $db->select($query);
            if ($blogTitle) {
                while ($result = $blogTitle->fetch_assoc()) { ?>
                    <div class="leftsite">
                        <form>
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
                                    <td>
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" Value="Update" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="rightside">
                        <img src="upload/<?= $result['logo'] ?>" . alt="logo">
                    </div>
        </div>
<?php    }   }    ?>
    </div>
</div>
<?php
require_once "inc/footer.php";
?>