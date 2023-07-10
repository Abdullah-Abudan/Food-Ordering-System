<?php # هكذا عملت حماية لصفحات الموقع بحيث لن يتم الدخول لهم الا اذا كان هنالك قيمة للسيشن أي كنت عامل لوغ ان
if(isset($_SESSION['login'])){
    
}else{
    $_SESSION['login_faild']= "<script>alert('Please Login First')</script>";
    header('location:login.php');
}
?>