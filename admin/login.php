<?php include "../config/constants.php"?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>


            <br><br>
            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends HEre -->
            <?php
            if(isset($_SESSION['login_faild'])){
                echo $_SESSION['login_faild'];
                unset($_SESSION['login_faild']);
            }
            ?>
        </div>

    <div class="footer">
        <div class="wrapper">
            <p class="text-center">2021 All rights reserved, Food House</p>
        </div>
    </div>
    <!-- Footer Section Ends -->

    </body>
</html>

<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $q = "select * from admins where username = '$username' and password ='$password'";
    $res = mysqli_query($conn, $q);
    if($res->num_rows>0){
        $_SESSION['login']=$username;
        header("location:index.php");
    }else{
        $msg="<script>alert('Invalid Username or Password')</script>";
        echo $msg;
        unset($msg);
    }
}
?>