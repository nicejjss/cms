<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="input-group">
            <input name="name" type="text" class="form-control" placeholder="user name">
                <input name="password" type="text" class="form-control" placeholder="user password">
                    <button name="submit" class="btn btn-default" style="color: white; background-color: blue;">
                      Submit
                    </button>
            </div>
</form>
        <!-- /.input-group -->
    </div>
    <div class="well">

        <?php
        $query = "SELECT * from categories";
        $result = mysqli_query($connection, $query);
      
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php 
                      while ($row = mysqli_fetch_assoc($result)) {
                        $cattitle = $row["cat_title"];
                     ?>
                    <li><a href="#"> <?php echo $cattitle ?></a>
                    </li>
                    <?php  }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include("./includes/widget.php")?>

</div>