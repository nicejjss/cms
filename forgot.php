<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<?php
$check = '';
if (isset($_POST["submit"])) {
    $email =  mysqli_real_escape_string($connection, $_POST["email"]);
    $query = "Select * from user where email=?";

    switch (true) {

        case ($email == ''):
            echo "<script>alert('You must have Email')</script>";
            break;
        default:
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result != false) {
                $check = mysqli_fetch_assoc($result)['password'];
            };
            break;
    }
}
if ($check != '') {
    $to = $_POST["email"];
    $subject = "Get PassWord";
    $message= "Your PassWord is: ".$check;
    $header =[
        'From' => 'locdaoduc2002@gmail.com'
    ];
     $re=mail($to,$subject,$message,$header);
}
?>
<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Forgot Password</h1>
                        <form role="form" action="" method="post" id="login-form">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
                            </div>
                            <?php if (isset($_POST["submit"])) {
                                if ($check !='') {
                                    echo "<p>Please Check Your Email!!!</p>";
                                } else {
                                    echo "<p>Cannot Find Your Email, Please Try Again</p>";
                                }
                            }

                            ?>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Get Password">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>