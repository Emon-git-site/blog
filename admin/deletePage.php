<?php
  require_once "../lib/Database.php";
 $db = new Database();
  if(!isset($_GET['actionPageId'])){
    header('location:index.php');
}else{
    $pageId = $_GET['actionPageId'];
}
    $deleteQuery = "delete from tbl_page where id = '$pageId'";
    $deleteData = $db->delete($deleteQuery);
    if($deleteData){
        echo "<span class='success'>Page Deleted Successfully.</span>";
    }else{
        echo "<span class='error'>Page Fail to  Delete.</span>";
    }   
    header('location:index.php');
?>