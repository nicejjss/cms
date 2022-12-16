<?php
   if(isset($_GET["delete"])){
       $delete=$_GET["delete"];
     $query="Delete from posts where post_id=$delete";
     $result=mysqli_query($connection,$query);
   }


?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <!-- <tr>
                     
                                <td>10</td>
                                <td>Nicejjss</td>
                                <td>Cach su dung PHP</td>
                                <td>PHP</td>
                                <td>Status</td>
                                <td>Image</td>
                                <td>Tags</td>
                                <td>Comments</td>
                                <td>10/12/2022</td>
                          
                            </tr> -->
        <?php
        $query = "select * from posts join categories on category_id = categories.cat_id";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $postid = $row["post_id"];
            $postauthor = $row["post_author"];
            $posttitle = $row["post_title"];
            $postcatid = $row["cat_title"];
            $poststatus = $row["post_status"];
            $postimg = $row["post_image"];
            $posttags = $row["post_tags"];
            $postcommentcount = $row["post_comment_count"];
            $postdate = $row["post_date"];
        ?>
            <tr>
                <td><?php echo $postid; ?></td>
                <td><?php echo $postauthor; ?></td>
                <td><?php echo $posttitle; ?></td>
                <td><?php echo $postcatid; ?></td>
                <td><?php echo $poststatus; ?></td>
                <td><img width="150" src="../images/<?php echo $postimg; ?>" alt="<?php echo $postimg ?>"></td>
                <td><?php echo $posttags; ?></td>
                <td><?php echo $postcommentcount; ?></td>
                <td><?php echo $postdate; ?></td>
                <td> <a href="./posts.php?delete=<?php echo $postid ?>"><button name="delete-submit" class="btn btn-danger">DELETE</button></a></td>
                <td> <a href="./posts.php?source=edit post&postid=<?php echo $postid ?>"><button name="delete-submit" class="btn ">Edit</button></a></td>

            </tr>
        <?php }
        ?>
    </tbody>
</table>
