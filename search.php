<?php include("./includes/db.php") ?>
<?php include("./includes/header.php") ?>


<!-- Navigation -->
<?php include("./includes/navigation.php") ?>

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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $search = mysqli_real_escape_string($connection,$_POST["search"]);
                $query = "SELECT * FROM posts where post_title like '%${search}%'";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("FAIL: " . mysqli_error($connection));
                }
                $count = mysqli_num_rows($result);
                if ($count == 0) {
                    echo "<h1>NO RESULT</h1>";
                } else { ?>
                    <?php
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $posttitle = $row["post_title"];
                        $postcontent = $row["post_content"];
                        $postauthor = $row["post_author"];
                        $postdate = $row["post_date"];
                        $postimage = $row["post_image"];

                    ?>
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $posttitle ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $postauthor ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postdate ?> </p> <!-- 28, 2013 at 10:00 PM</p>-->
                        <hr>
                        <img class="img-responsive" src="./images/<?php echo $postimage ?>" alt="">
                        <hr>
                        <p><?php echo $postcontent ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
                    <?php  }
                    ?>
            <?php }
            }
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
        <?php include("./includes/sidebar.php") ?>

    </div>
    <!-- /.row -->

    <hr>
    <?php include("./includes/footer.php") ?>