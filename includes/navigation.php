<?php 
  global $connection;
  session_start();

  
?>

<!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php 
                $query ="SELECT * from categories";
                 $result=mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($result) ){
                    $cattitle=$row["cat_title"];
                    $catid = $row["cat_id"];
                    echo "<li>
                    <a href='./category.php?id=${catid}'>${cattitle}</a>
                </li>";
                }

                ?>
                <?php
                  
                if(isset($_SESSION["role"]) and $_SESSION["role"] =="admin"){
                    echo   "  <li>
                    <a href='admin'>Admin</a>
                </li>";
                }
                else{
                    echo   "  <li>
                    <a href='./registration.php'>Log Up</a>
                </li>";
                }
                    ?>
              
                    <!-- <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                    <li>
                    <a href='./contact.php'>Contact</a>
                </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
