<?php include("./includes/db.php")?>
<?php include("./includes/header.php")?>


  <!-- Navigation -->
   <?php include("./includes/navigation.php")?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->
            <?php
            if(isset($_GET["id"])){
                $id = $_GET["id"];
                $query="SELECT * FROM `posts` where category_id= $id and post_status='publish' ";
                $result=mysqli_query($connection,$query);
                $rows = mysqli_num_rows($result);
                if($rows <=0){
                    echo "<h1>No Posts Sorry</h1>";
                }
                else
                while($row = mysqli_fetch_assoc($result) ){
                    $postid=$row["post_id"];
                    $posttitle=$row["post_title"];
                    $postcontent=substr($row["post_content"],0,150);
                    $postauthor=$row["post_author"];
                    $postdate=$row["post_date"];
                    $postimage=$row["post_image"];
                ?>
                 <!-- First Blog Post -->
                 <h2>
                     <a href="./post.php?postid=<?php echo $postid ?>"><?php echo $posttitle?></a>
                 </h2>
                 <p class="lead">
                     by <a href="index.php"><?php echo $postauthor?></a>
                 </p>
                 <p><span class="glyphicon glyphicon-time"></span> Posted on   <?php echo $postdate?> </p>  <!-- 28, 2013 at 10:00 PM</p>-->
                 <hr>
                 <img class="img-responsive" src="./images/<?php echo $postimage?>" alt="">
                 <hr>
                 <p><?php echo $postcontent?></p>
                 <a class="btn btn-primary" href="./post.php?postid=<?php echo $postid;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                 <hr>
             <?php  }}
            ?>
            

               


                <!-- Second Blog Post -->
                <!-- <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat, asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

                <!-- Third Blog Post -->
                <!-- <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr> -->

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
           
                <!-- Blog Categories Well -->
                <?php include("./includes/sidebar.php")?>

        </div>
        <!-- /.row -->

        <hr>
<?php include("./includes/footer.php")?>
     