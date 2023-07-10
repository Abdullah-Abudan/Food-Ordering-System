<?php
include "../config/constants.php"; #تم ربط ملفات التي ترث المنيو بقاعدة البيانات 
include "../config/check_login.php"; 
?>
<html>
<head>
    <title>Food Order Website - <?php echo $page_title ;?> </title> <!-- اسم لكل الصفحات -->

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
</body>
</html>

