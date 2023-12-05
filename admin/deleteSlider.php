<?php
require_once "../lib/Session.php";
Session::checkSession();
require_once "../lib/Database.php";
require_once "../helpers/format.php";
$db = new Database();
$fm = new Format();
?>

<?php
 if(!isset($_GET['deleteSliderId'])){
     header('location:sliderList.php');
 }else{
     $slierId = $_GET['deleteSliderId'];

     $query = "select * from tbl_slider where id = '$slierId' ";
     $sliderData = $db->select($query);
     if($sliderData){
        while($postData = $sliderData->fetch_assoc()){
            $imageLink = 'upload/slider/'.$postData['image'];
            unlink($imageLink);
        }
     }
     $deleteQuery = "delete from tbl_slider where id = '$slierId' ";
     $deleteData = $db->delete($deleteQuery);
     if($deleteData){
        echo  "<script>alert('Data Deleted Successfully.')</script>";
         header('location:sliderList.php');
     }else{
        echo  "<script>alert('Data not Deleted.')</script>";
        header('location:sliderList.php');
     }
 }
?>
