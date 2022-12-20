<?php include("./includes/admin_header.php")?>
<?php 
   if(isset($_POST["submit"])){
    $name =$_POST["name"];
    $mail = $_POST["mail"];
          $query ="UPDATE `user` SET email='$mail' WHERE name = '$name'";
          $result= mysqli_query($connection,$query);
          header("location: "."profile.php");
   }
?>




<?php
if(isset($_SESSION["name"])){
    $username=$_SESSION["name"];
    $query="Select * from user where name = '$username'";
     
     $result=mysqli_query($connection,$query);
     $row=mysqli_fetch_assoc($result);
           $name=$row["name"];
           $password=$row["password"];
           $mail= $row["email"];
           $role=$row["role"];
           $avatar=$row["image"];
     ?>
    <div id="wrapper">

        <!-- Navigation -->
    <?php include("./includes/admin_navigation.php")?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin Pages
                            <small><?php echo $_SESSION["name"]?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i>Profile
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.container-fluid -->
            <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">User Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $name?>">
    </div>

    <div class="form-group">
        <label for="post_author">Password</label>
        <input type="text" class="form-control" name="author" value="<?php echo $password?>">
    </div>
    <div class="form-group">
        <label for="post_status">Email</label>
        <input type="text" class="form-control" name="mail" value="<?php echo $mail?>">
    </div>
    <div class="form-group">
        <label for="post_status">Role: </label>
         <span><?php echo $role;?></span>
    </div>
    <div class="form-group" id="postimg">
        <label for="post_image">Avatar</label>
        <input type="file" name="image">
        <img style="margin-top: 10px;" width="150px" src="../images/avatar/<?php echo $avatar?>" alt="" >
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Upadate User">
    </div>
</form>
        </div>
        <!-- /#page-wrapper -->
        <?php } else{
            header("Location: "."../index.php");
        } ?>
<?php include("./includes/admin_footer.php")?>
