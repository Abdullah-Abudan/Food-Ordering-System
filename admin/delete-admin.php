<?php
include "../config/constants.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="select * from admins where id = $id";
    $res = mysqli_query($conn,$q);
    if($res && $res->num_rows==1){
        $q= "delete from admins where id = $id";
        $res= mysqli_query($conn,$q);
        if($res){
            header("location:manage-admin.php");
        }else{
        header("location:manage-admin.php");
    }
    }
}
?>
