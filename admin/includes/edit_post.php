<?php 
    if(isset($_POST["edit_post"])){
        $id=$_GET["postid"];
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

       if(empty($post_image)){
         $query="Select post_image from posts where post_id= $id";
         $result=mysqli_query($connection,$query);
         $post_image=mysqli_fetch_array($result)["post_image"];
       }
      $query="UPDATE `posts` SET `category_id`='$category',`post_title`='$title',`post_author`='   $author',`post_user`='',`post_date`=now(),`post_image`='$post_image',`post_content`=' $content',`post_tags`='$tags',`post_comment_count`=0,`post_status`='$status',`post_views_count`= 0 WHERE `post_id`='$id'";

      $result=mysqli_query($connection,$query);
       if($result){
        echo "add completed";
        header("location: ./posts.php");
       }
    }



   if(isset($_GET["postid"])){
    $postid=$_GET["postid"];
    $query="SELECT `post_id`, `category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count` FROM `posts` WHERE post_id= $postid";
     
     $result=mysqli_query($connection,$query);
     while($row=mysqli_fetch_assoc($result)){
           $title=$row["post_title"];
           $category=$row["category_id"];
           $author=$row["post_author"];
           $status=$row["post_status"];
           $tags=$row["post_tags"];
           $content=$row["post_content"];
           $img=$row["post_image"];
           ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $title?>">
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
                if($catid == $category){
                    echo " <option selected value='$catid'> $cattitle </option>";
                }
               else{
                echo " <option value='$catid'> $cattitle </option>";
               }
             }
       ?>

  
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $author?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="status" value="<?php echo $status?>">
    </div>
    <div class="form-group" id="postimg">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
        <img style="margin-top: 10px;" width="150px" src="../images/<?php echo $img ?>" alt="" >
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $tags?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="content" id="" cols="30" rows="10">
            <?php echo $content?>
         </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
    </div>
</form>
<?php
     }
    }
?>
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