<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

 <!-- Pusher -->
 <?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'b740574d913375f27467',
    '4938b5849bdf28005636',
    '1532851',
    $options
  );


?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    

    <?php 
         if(isset($_POST["submit"])){
            $username = mysqli_real_escape_string($connection,$_POST["username"]);
            $email =  mysqli_real_escape_string($connection,$_POST["email"]);
            $password =  mysqli_real_escape_string($connection,$_POST["password"]);
            $query ="Select * from user where name ='$username' or email='$email'";
            $result = mysqli_query($connection,$query);
            $rows = mysqli_fetch_row($result);
            switch(true){
                case($username==''):  echo "<script>alert('You must have User Name')</script>";break;
                case($email == ''):  echo "<script>alert('You must have Email')</script>";break;
                case($password == ''):  echo "<script>alert('You must have Password')</script>";break;
                case($email == ''):  echo "<script>alert('You must have Email')</script>";break;
                case($rows > 0 ):echo "<script>alert('This Email or Username have been used')</script>";break;
                default:  $query ="INSERT INTO `user`( `name`, `email`, `password`, `image`, `role`) VALUES ('$username',' $email','$password','','user')";
                $result = mysqli_query($connection,$query);  
                 

                $data['message'] = $username;
                $pusher->trigger('notification','new_user',$data);

                if(!$result){
                  die("Fails: ".mysqli_error($connection));
                }
                else{
                    $_SESSION["name"] = $username;
                    $_SESSION["role"] = 'user';
                    header("location: ".'./admin/index.php');
                }
                ;break;
            }
         }
      
    ?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="User Name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
