<?php
require_once "../lib/Session.php";
Session::checkSession();
require_once "../lib/Database.php";
require_once "../helpers/format.php";
$db = new Database();
$fm = new Format();
?>

<?php
 if(!isset($_GET['deletePostId'])){
     header('location:postlist.php');
 }else{
     $postId = $_GET['deletePostId'];

     $query = "select * from tbl_post where id = '$postId' ";
     $getData = $db->select($query);
     if($getData){
        while($postData = $getData->fetch_assoc()){
            $imageLink = 'upload/'.$postData['image'];
            unlink($imageLink);
        }
     }
     $deleteQuery = "delete from tbl_post where id = '$postId' ";
     $deleteData = $db->delete($deleteQuery);
     if($deleteData){
        echo  "<script>alert('Data Deleted Successfully.')</script>";
         header('location:postlist.php');
     }else{
        echo  "<script>alert('Data not Deleted.')</script>";
        header('location:postlist.php');
     }
 }
?>
