<?php include("./includes/db.php")?>
<?php include("./includes/header.php")?>


  <!-- Navigation -->
   <?php include("./includes/navigation.php")?>

    <!-- Page Content -->
    <div class="container">
      <p>123123</p>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->
            <?php
          $postperpage =5;

         $query="Select * from posts where post_status='publish'";
         $result=mysqli_query($connection,$query);
         $rows_count = mysqli_num_rows($result);
        //  echo $rows_count;
         $page =ceil($rows_count/$postperpage);
        //  echo "<br>".$page;
         $currentpage = 1;
           if(isset($_GET["page"])){
              $currentpage = (int)$_GET["page"];
              if($currentpage > $page){
                $currentpage = $page;
              }
              if($currentpage < 1 ){
                $currentpage=1;
              }
           }
         $index = $currentpage*$postperpage - $postperpage;

               $query="Select * from posts where post_status='publish' LIMIT $index,$postperpage ";
               $result=mysqli_query($connection,$query);
               while($row = mysqli_fetch_assoc($result) ){
                   $postid=$row["post_id"];
                   $posttitle=$row["post_title"];
                   $postcontent= substr($row["post_content"],0,150);
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
             <?php  }
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
        <ul class="pager">
        <?php for($i=1;$i<=$page;$i++){
            if($i == $currentpage){
                echo "<li><a style='background-color: whitesmoke;' href='index.php?page=${i}'>".$i."</a></li>";
            }
            else{
                echo "<li><a href='index.php?page=${i}'>".$i."</a></li>";
            }
          

       }?>
        </ul>
        <a ></a>
      
<?php include("./includes/footer.php")?>
     
