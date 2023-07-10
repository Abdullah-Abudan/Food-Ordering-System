<html>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php
$page_title = "ManageAdmin"; #عنوان للصفحة
include "../layouts/menu.php";
?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br/>
        <?php
        if(isset($_SESSION['admin'])){
            echo $_SESSION['admin'];
            unset($_SESSION['admin']); #destroys the variable
        }
        ?>
        <br><br><br>

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
           <?php
            $q="select * from admins";
            $res = mysqli_query($conn,$q);
            if($res && $res->num_rows>0){
                while($admin = $res->fetch_assoc() ){ 
                    $username=$admin['username'];
                    $fullname=$admin['fullname'];
                    $id=$admin['id'];
                    echo  '<tr>
                    <td>'.$id.'</td>
                    <td>'.$username.'</td>
                    <td>'.$fullname.'</td>
                    <td>
                        <a href="update-admin.php?id='.$id.'" class="btn-secondary"> update </a> &nbsp
                        <a href="delete-admin.php?id='.$id.'" class="btn-danger"> delete </a>&nbsp
                        <a href="update-password.php?id='.$id.'" class="btn-primary"> change password </a>&nbsp
                    </td>
                </tr>';
                }
            }
            else{
                echo"<tr>
                <td>
                    <p> no admin yet ! </p></td>
            </tr>";
            }

           ?>





        </table>

    </div>
</div>
<!-- Main Content Setion Ends -->

<?php include "../layouts/footer.php"?>

<!-- Footer Section Ends -->

</body>
</html>