<div class="slidersection templete clear">
        <div id="slider">
        <?php
        $query = "select  * from tbl_slider ";
        $slider = $db->select($query);
        if ($slider) {
            while ($result = $slider->fetch_assoc()) { ?>     
            <a href="#"><img src="admin/upload/slider/<?= $result['image'] ?>" alt="<?=$result['alt']?>" title="<?=$result['title']?>" width="960px" height="300px"/></a>
                <?php  } } ?>
        </div>
</div>  