<?php include("./includes/db.php") ?>
<?php include("./includes/header.php");

$id = $_GET["postid"];
if ($id != null) {
    $query = "SELECT * FROM `posts` WHERE post_id =" . $id;
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $title = $row["post_title"];
    $date = $row["post_date"];
    $date = new DateTime($date);
    $author = $row["post_author"];
    $img = $row["post_image"];
    $content = $row["post_content"];
}

?>
 <?php
    if (isset($_POST["submit"])) {
        $comauthor = $_POST["author"];
        $comcontent = $_POST["content"];
        if($comcontent && $_POST["content"]!=""){
        $query = "INSERT INTO `comment`(`post_id`, `comment_author`, `comment_date`, `comment_content`) VALUES (${id},'${comauthor}',NOW(),'${comcontent}')";
        $result = mysqli_query($connection,$query);
        if(!$result)
            die("Fail: ".mysqli_error($connection));
         
    }
    }
    ?>
<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>
<!-- Navigation -->
<?php include("./includes/navigation.php") ?>
<!-- Page Content -->
<div class="container">
   
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $title ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#"><?php echo $author ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span><?php echo date_format($date, "d/m/Y") ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="./images/<?php echo $img ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?php echo $content ?></p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="POST" action=""  target="_blank">
                    <div class="form-group">
                        <input type="text" name="author" placeholder="Name" class="form-control">
                    </div>
                    <label for="">Your Comment</label>
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="3"></textarea>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <!-- Comment -->
            <?php $query = "SELECT * FROM `comment` WHERE post_id = ${id}";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $owner = $row["comment_author"];
                $content = $row["comment_content"];
                $date = $row["comment_date"];
            ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img width="64" class="media-object" src="https://soaringgecko.github.io/8K-image-search/images/witch.png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $owner; ?>
                            <small><?php echo $date ?></small>
                        </h4>
                        <?php echo $content ?>

                        <!-- Nested Comment -->

                        <!-- End Nested Comment -->
                    </div>
                </div>

            <?php }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->

        <!-- Blog Categories Well -->
        <?php include("./includes/sidebar.php") ?>

    </div>
    <!-- /.row -->
   
    <hr>
    <?php include("./includes/footer.php") ?>