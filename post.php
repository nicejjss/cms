<?php include("./includes/db.php") ?>
<?php include("./includes/header.php"); ?>
<?php include("./includes/navigation.php") ?>
<?php

//User like post
$name = '';
$uid = 0;
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $query = "SELECT * FROM `user` WHERE name = '$name'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $uid = $row["id"];
}


//get post
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

if (isset($_POST["submit"])) {
    $comauthor = $_POST["author"];
    $comcontent = $_POST["content"];
    switch (true) {
        case (empty($comauthor)):
            echo "<script>alert('Name Not Empty')</script>";
            break;
        case (empty($comcontent)):
            echo "<script>alert('Comment Not Empty')</script>";
            break;
        default:
            $query = "INSERT INTO `comment`(`post_id`, `comment_author`, `comment_date`, `comment_content`) VALUES (${id},'${comauthor}',NOW(),'${comcontent}')";
            $result = mysqli_query($connection, $query);
            if (!$result)
                die("Fail: " . mysqli_error($connection));
            header("Location: " . "post.php?postid=$id");
            break;
    }
    // if ($comcontent) {
    //     $query = "INSERT INTO `comment`(`post_id`, `comment_author`, `comment_date`, `comment_content`) VALUES (${id},'${comauthor}',NOW(),'${comcontent}')";
    //     $result = mysqli_query($connection, $query);
    //     if (!$result)
    //         die("Fail: " . mysqli_error($connection));
    // }
    // header("Location: "."post.php?postid=$id");
}
//Check if user like or not
$like = false;
$query = "SELECT * from user join user_post on user.id = user_post.user_id WHERE user.name='$name' and post_id='$id';";
$result = mysqli_query($connection, $query);
$row = mysqli_num_rows($result);
if ($row > 0) {
    $like = true;
} else {
    $like = false;
}

//Ajax

if (isset($_POST['like'])) {
    //Select Post
    $id = $_POST['id'];
    $userid = $_POST['userid'];

    $selectPost = "Select * from posts where post_id = $id";
    $result = mysqli_query($connection, $selectPost);
    $Postlike = mysqli_fetch_assoc($result)['likes'];

    $existLike = mysqli_query($connection, "SELECT * from user join user_post on user.id = user_post.user_id WHERE user.id='$userid' and post_id='$id';");

    if (mysqli_num_rows($existLike) <= 0) {

        $result = mysqli_query($connection, "UPDATE `posts` SET`likes`=$Postlike+1 WHERE post_id=$id");

        mysqli_query($connection, "INSERT INTO `user_post`(`user_id`, `post_id`) VALUES ('$userid','$id')");
    }
}
if (isset($_POST['unlike'])) {
    //Select Post
    $id = $_POST['id'];
    $userid = $_POST['userid'];

    $selectPost = "Select * from posts where post_id = $id";
    $result = mysqli_query($connection, $selectPost);
    $Postlike = mysqli_fetch_assoc($result)['likes'];

    $existLike = mysqli_query($connection, "SELECT * from user join user_post on user.id = user_post.user_id WHERE user.id='$userid'and post_id='$id';");

    if (mysqli_num_rows($existLike) > 0) {

        $result = mysqli_query($connection, "UPDATE `posts` SET`likes`=$Postlike-1 WHERE post_id=$id");

        mysqli_query($connection, "DELETE FROM `user_post` WHERE post_id = '$id'and user_id = '$userid'");
    }
}

?>
<!-- Navigation -->

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

            <!-- Like-Unlike -->
            <div class="row">
                <p style="padding-right: 12px;" class="pull-right"><span id='like' style="cursor: pointer;" class="like_unlike" onclick="Click()" id="" href="">
                        <!-- <span class="glyphicon glyphicon-thumbs-up" style="margin-right: 5px;"> </span> -->
                        <?php echo $like ? 'Unlike' : 'Like' ?></span></p>

            </div>
            <!-- <div class="row">
                <p style="padding-right: 12px;" class="pull-right"><a id="unlike" href="">
                        <span class="glyphicon glyphicon-thumbs-down" style="margin-right: 5px;"> </span>Unlike</a></p>

            </div> -->




            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form method="POST" action="">
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
            <?php $query = "SELECT * FROM `comment` WHERE post_id = ${id} and approve=1";
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
    <script>
        function Click() {
            var name = '<?php echo isset($_SESSION['name']);?>';
            if(name ==false){
                alert("You Must Log In First");
            }
            else{
            var format ='';
        var p= document.getElementById('like');
        var xhttp = new XMLHttpRequest();
        if(p.innerText=='Like'){
               format ="like=" + 1 + "&id=" + <?php echo $id?> + "&userid=" + <?php echo $uid; ?>;
        }
        else{
            format="unlike=" + 1 + "&id=" + <?php echo $id?> + "&userid=" + <?php echo $uid; ?>;
        }
       xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       if(p.innerText =='' || p.innerText =='Unlike'){
        p.innerText ='Like';
       }
       else{
        p.innerText = 'Unlike';
       }
    }
};
xhttp.open("POST", "post.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// var format ="Hello=123";
xhttp.send(format);
        }}
    </script>