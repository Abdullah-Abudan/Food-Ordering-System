<?php
include "../config/constants.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="select * from foods where id = $id";
    $res = mysqli_query($conn,$q);
    if($res && $res->num_rows==1){
        $q= "delete from foods where id = $id";
        $res= mysqli_query($conn,$q);
        if($res){
            header("location:manage-food.php");
        }else{
        header("location:manage-food.php");
    }
    }
}
?>
