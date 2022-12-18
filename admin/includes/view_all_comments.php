<?php
   if(isset($_GET["delete"])){
       $delete=$_GET["delete"];
     $query="DELETE FROM `comment` WHERE id =$delete";
     $result=mysqli_query($connection,$query);
   }


?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Owner</th>
            <th>Post title</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Status</th>
            <th>Approve</th>
            <th>Delete</th>
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
        $query = "SELECT comment.id,comment_author,posts.post_title,comment_content,comment_date,approve FROM posts INNER JOIN comment ON comment.post_id = posts.post_id;";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $comid = $row["id"];
            $comauthor = $row["comment_author"];
            $comtitle = $row["post_title"];
            $comcatid = $row["comment_content"];
            $comstatus = $row["comment_date"];
            $comsta = $row["approve"];
        ?>
            <tr>
                <td><?php echo $comid; ?></td>
                <td><?php echo $comauthor; ?></td>
                <td><a href="../post.php?postid=<?php echo $comid?>"> <?php echo $comtitle; ?></a></td>
                <td><?php echo $comcatid; ?></td>
                <td><?php echo $comstatus; ?></td>
                <td><?php if($comsta == 1) echo "approve"; else echo "unapprove";?></td>
                <td>
                <?php  if($comsta ==1){
                    echo "<a href='./comments.php?source=edit comment&approve=true&comid=${comid}'>True</a></td>";
                }else{
                    echo "<a href='./comments.php?source=edit comment&approve=false&comid=$comid'>False</a></td>";
                }
                ?>    
                <td> <a href="./comments.php?delete=<?php echo $comid ?>">DELETE</a></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>
