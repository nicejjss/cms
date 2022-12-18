<?php 
     $approve = $_GET["approve"];
     $id = $_GET["comid"];
     if($approve =="true"){
        echo $id."<br>";
        echo $approve;
        $query = "UPDATE `comment` SET `approve`=0 WHERE id= $id";
     }
     else{
        echo $id;
        echo '<br>'.$approve;
        $query = "UPDATE `comment` SET `approve`= 1 WHERE id = ${id}";
     }
   $result= mysqli_query($connection,$query);
   if(!$result){
     die("Fail: ".mysqli_error($connection));
   }
   else
   header("Location: "."comments.php");
?>