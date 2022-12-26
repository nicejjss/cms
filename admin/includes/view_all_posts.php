<?php
if (isset($_GET["delete"])) {
    $delete = $_GET["delete"];
    $query = "Delete from posts where post_id=$delete";
    $result = mysqli_query($connection, $query);
}


?>
<?php
if (isset($_POST["checkBoxArray"])) {
    foreach ($_POST["checkBoxArray"] as $a) {
        $bulkoption = $_POST["bulkoption"];
        switch ($bulkoption) {
            case 'publish':
                $query = "UPDATE `posts` SET `post_status`='$bulkoption' WHERE post_id= $a";
                $result = mysqli_query($connection, $query);
                break;
            case 'draft':
                $query = "UPDATE `posts` SET `post_status`='$bulkoption' WHERE post_id= $a";
                $result = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "DELETE FROM `posts` WHERE post_id= $a";
                $result = mysqli_query($connection, $query);
                break;
        }
    }
}
?>

<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <dib style="padding-left: 0;" id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulkoption">
                <option value="">Select Option</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </Select>
        </dib>
        <div class="col-xs-4">
            <input type="submit" name="submit" id="" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="./posts.php?source=add post">Add New</a>
        </div>

        <thead>
            <tr>
                <th><input id="selectAllBoxes" onclick="CheckAll(event)" type="checkbox"></th>
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
            $query = "SELECT *,posts.post_id as id,COUNT(comment.id) as comment_count from posts JOIN categories on categories.cat_id = posts.category_id LEFT JOIN comment on posts.post_id =comment.post_id and comment.approve =1
        GROUP BY posts.post_id";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $postid = $row["id"];
                $postauthor = $row["post_author"];
                $posttitle = $row["post_title"];
                $postcatid = $row["cat_title"];
                $poststatus = $row["post_status"];
                $postimg = $row["post_image"];
                $posttags = $row["post_tags"];
                $postcommentcount = $row["comment_count"];
                $postdate = $row["post_date"];
            ?>
                <tr>
                    <td><input class="checkBoxes" name="checkBoxArray[]" value="<?php echo $postid ?>" type="checkbox"></td>
                    <td><?php echo $postid; ?></td>
                    <td><?php echo $postauthor; ?></td>
                    <td><?php echo $posttitle; ?></td>
                    <td><?php echo $postcatid; ?></td>
                    <td><?php echo $poststatus; ?></td>
                    <td><img width="150" src="../images/<?php echo $postimg; ?>" alt="<?php echo $postimg ?>"></td>
                    <td><?php echo $posttags; ?></td>
                    <td><?php echo $postcommentcount; ?></td>
                    <td><?php echo $postdate; ?></td>
                    <td> <a href="../post.php?postid=<?php echo $postid ?>">View Post</a></td>
                    <td> <a href="./posts.php?delete=<?php echo $postid ?>"><button name="delete-submit" class="btn btn-danger">DELETE</button></a></td>
                    <td> <a href="./posts.php?source=edit post&postid=<?php echo $postid ?>">Edit</a></td>

                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</form>

<script>
    function CheckAll(event) {

       var checkall = document.getElementById("selectAllBoxes");
      if(checkall.checked){
        var inputs = document.getElementsByClassName("checkBoxes");
          for(let i =0;i<inputs.length;i++){
                 inputs[i].checked = true;
          }
      }
      else{
        var inputs = document.getElementsByClassName("checkBoxes");
        for(let i =0;i<inputs.length;i++){
                 inputs[i].checked = false;
          }
      }

    // $(document).ready(function(){
    //     $('#selectAllBoxes').click(function(event){
    //         if(this.checked){
    //             $('.checkBoxes').each(function(){
    //                 this.checked =true;
    //             })
    //         }
    //         else{
    //             $('.checkBoxes').each(function(){
    //                 this.checked =false;
    //             })
    //         }
    //     })
    // })
      }
</script>