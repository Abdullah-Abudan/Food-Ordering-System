<?php
include "../config/constants.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="select * from categories where id = $id";
    $res = mysqli_query($conn,$q);
    if($res && $res->num_rows==1){
        $q= "delete from categories where id = $id";
        $res= mysqli_query($conn,$q);
        if($res){
            header("location:manage-category.php");
        }else{
        header("location:manage-category.php");
    }
    }
}
?>
