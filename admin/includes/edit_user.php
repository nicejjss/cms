<?php 
     $approve = $_GET["admin"];
     $id = $_GET["userid"];
     if($approve =="true"){
        echo $id."<br>";
        echo $approve;
        $query = "UPDATE `user` SET `role`='user' WHERE id= $id";
     }
     else{
        echo $id;
        echo '<br>'.$approve;
        $query = "UPDATE `user` SET `role`= 'admin' WHERE id = ${id}";
     }
   $result= mysqli_query($connection,$query);
   if(!$result){
     die("Fail: ".mysqli_error($connection));
   }
   else
   header("Location: "."users.php");
?>