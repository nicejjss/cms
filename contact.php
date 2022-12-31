<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    

    <?php 
         if(isset($_POST["submit"])){
           $email = $_POST["email"];
           $subject = $_POST['subject'];
           $message = $_POST["content"];
           if(empty($email) or empty($subject) or empty($message)){
            echo '<script>alert('.'Must Fill Fields'.')</script>';
           }
           else{
            $header = array(
                "From" =>$email
            );
              mail("locdaoduc2002@gmail.com",$subject,$message,$header);
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
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form">
                        <div class="form-group">
                            <label for="username" class="sr-only">Your Email</label>
                            <input type="email" name="email" id="username" class="form-control" placeholder="Your Email">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="email" class="form-control" placeholder="Subject">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Content</label>
                          <textarea style="padding: 10px;" placeholder="Your Content" name="content" id="" cols="75" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
