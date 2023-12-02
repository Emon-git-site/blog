<?php
require_once "lib/Database.php";
require_once "helpers/format.php";

$db = new Database();
$fm = new Format();
?>
<?php
  $query = "select * from tbl_copyright where id = '1' ";
  $copyrightLink = $db->select($query);
  $copyright = $copyrightLink->fetch_assoc()  ?> 
</div>
<div class="footersection templete clear">
  <div class="footermenu clear">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Privacy</a></li>
    </ul>
  </div>
  <p>&copy;<?=$copyright['note']?> </p>
</div>
<div class="fixedicon clear">
<?php
  $query = "select * from tbl_social where id = '1' ";
  $socialLink = $db->select($query);
  $social = $socialLink->fetch_assoc()  ?>
    <a href="<?=$social['fb']?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
    <a href="<?=$social['tw']?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
    <a href="<?=$social['ln']?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
    <a href="<?=$social['gp']?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>