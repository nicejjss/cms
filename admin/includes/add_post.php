<?php 

    if(isset($_POST["create_post"])){
        $title=$_POST["title"];
        $author=$_POST["author"];
        $category=$_POST["category"];

        $post_image=$_FILES["image"]["name"];
        $post_image_temp=$_FILES["image"]["tmp_name"];

        $status=$_POST["status"];
        $tags=$_POST["tags"];
        $content=$_POST["content"];
        $date=date("d-m-Y");

      move_uploaded_file($post_image_temp,"../images/$post_image");

      $query="INSERT INTO `posts`(`category_id`, `post_title`, `post_author`,`post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`,`post_views_count`) VALUES ('${category}','${title}','${author}',now(),'${post_image}','${content}','${tags}',0,'${status}',0)";

      $result=mysqli_query($connection,$query);
       if($result){
        echo "add completed";
        header("location: ./posts.php");
       }
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category">
       <?php
             $query="SELECT * FROM `categories` ";
             $result=mysqli_query($connection,$query);
             while($row= mysqli_fetch_assoc($result)){
                $catid=$row["cat_id"];
                $cattitle=$row["cat_title"];
                echo " <option value='$catid'> $cattitle </option>";
             }
       ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="status">
    </div>
    <div class="form-group" id="postimg">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="content" id="" cols="30" rows="10">
         </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>
<script>
     var postimg=document.getElementById("postimg");
     var img= document.getElementsByName("image")[0];
     img.onchange=function(e){
        if(!document.getElementsByTagName("img")[0]){
       var image= document.createElement("img");
        image.id="img";
        image.src="../images/"+ e.target.files[0].name;;
        image.width="150";
        image.style="margin-top: 10px";
        postimg.appendChild(image);}
        else{
          var image=document.getElementsByTagName("img")[0];
          image.remove();
          image= document.createElement("img");
        image.id="img";
        image.src="../images/"+ e.target.files[0].name;;
        image.width="150";
        image.style="margin-top: 10px";
        postimg.appendChild(image);
        }

        console.log(img.value);
        };
    
</script>